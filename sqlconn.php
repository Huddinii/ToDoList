<?php

include("ClassUser.php");
include("dbcreate.php");



class SQLConn
{
    private static $instance = null;
    private $db;
    private $host;

    function __construct() {
        $this -> db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
        $this -> db -> enableExceptions(true);
        $this -> host = new User();
    }
    function __destruct() {
        $this -> db -> close();
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new SQLConn();
        }
        return self::$instance;
    }

    function register($username, $mail, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if e-mail address is well-formed
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      return 'Keine Valide E-Mail';
    }


        $selectStatement= $this -> db -> prepare('SELECT * FROM user WHERE username = :username or mail = :mail');
        $selectStatement->bindValue(':username', $username);
        $selectStatement->bindValue(':mail', $mail);
        $result=$selectStatement->execute();
        if ($result-> fetchArray(SQLITE3_ASSOC)==false) {

            $statement = $this -> db->prepare('INSERT INTO user (username, mail, password) VALUES (:username, :mail, :password)');

            $statement->bindValue(':username', $username);
            $statement->bindValue(':mail', $mail);
            $statement->bindValue(':password', $hashedPassword);

            $statement->execute();
            $ID = $this -> db->lastInsertRowID();
            $this->host->login($ID,$username,$mail);
            $this -> createProject('Mein Projekt');
            return;

        } else {
            return 'E-Mail oder Benutzername existiert bereits.';
        }
    }

    function login($logintoken, $password) {
        $statement = $this -> db->prepare('SELECT id, username, mail, password FROM user WHERE mail = :logintoken OR username = :logintoken' );
        $statement->bindValue(':logintoken', $logintoken);

        try {
            $result = $statement->execute();
            $loginattempt = $result->fetchArray(SQLITE3_ASSOC);
            if (!$loginattempt) {
                return 'E-Mail oder Username ist falsch.';
            }
            if (password_verify($password, $loginattempt['password'])) {
                $this -> host ->login( $loginattempt['id'],$loginattempt['username'],$loginattempt['mail'] );
                $statement = $this -> db -> prepare( "SELECT project_id FROM user_project WHERE user_id = :uid");
                $statement->bindValue(":uid", $loginattempt["id"]);
                $result = $statement-> execute();
                if ($firstRes = $result->fetchArray(SQLITE3_ASSOC)) {
                    $this -> host ->setProject($firstRes['project_id']);
                }
                return;
            } else {
                return 'E-Mail oder Passwort ist falsch.';
            }
        } catch (PDOException $e) {
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createProject($pname) {
        $statement_project = $this -> db->prepare('INSERT INTO project ( name )
            VALUES (:name)');
        $statement_project->bindValue(':name', $pname);
        try {
            $statement_project->execute();
            $ProjectID = $this-> db -> lastInsertRowID();
            if (!$ProjectID) {
                return 'Anlegen Fehlgeschlagen';
            }
            $this -> host -> setProject($ProjectID);
            $statement_user_project = $this -> db->prepare('INSERT INTO user_project ( user_id, project_id ) 
            VALUES (:uid, :pid)');
            $statement_user_project->bindValue( ':uid', $this -> host -> getId() );
            $statement_user_project->bindValue( ':pid', $ProjectID );
            $statement_user_project->execute();

            if ($this-> host -> getTeamid() !== false) {
                $statement_team_project = $this -> db->prepare('INSERT INTO team_project ( team_id, project_id ) 
                VALUES (:tid, :pid)');
                $statement_team_project->bindValue( ':tid', $this-> host ->getTeamid());
                $statement_team_project->bindValue( ':pid', $ProjectID );
                $statement_team_project->execute();
            }

        } catch (PDOException $e) {
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createTodo($priority, $name, $description, $enddate = null) {
        $statement = $this -> db -> prepare("SELECT MAX(position) FROM todo WHERE priority = :priority");
        $statement ->bindValue(":priority", $priority) ;
        $result = $statement -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $position = $row['MAX(position)'] + 1;
        $statement = $this -> db -> prepare('INSERT INTO todo (priority, name, description, enddate, position, project_id)
        VALUES ( :priority, :name, :description, :enddate, :position, :project_id)');
        $statement ->bindValue(':priority', $priority);
        $statement ->bindValue(':name', $name);
        $statement ->bindValue(':description', $description);
        $statement ->bindValue(':enddate', $enddate);
        $statement ->bindValue(':position', $position);
        $statement ->bindValue(':project_id', $this-> host ->getProject() );
        try {
            $statement -> execute();
            return 'success';
        } catch (PDOException $e) {
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createTeam($name) {
        $statement = $this -> db -> prepare('INSERT INTO team (name)
        VALUE( :name )');
        $statement ->bindValue(':name', $name);
        try {
            $statement -> execute();
        }catch (PDOException $e) {
            return ''. $e->getMessage();
        }
        $TeamID = $this -> db -> lastInsertRowID();
        $this-> host ->setTeamid($TeamID);
        $role = 'Creator';
        $statment_user_team = $this -> db -> prepare('INSERT INTO user_team (user_id, team_id, role)
        VALUE ( :user_id, :team_id, :role )');
        $statment_user_team -> bindValue(':user_id', $this -> host ->getId() );
        $statment_user_team -> bindValue(':team_id', $TeamID);
        $statment_user_team -> bindValue(':role' ,$role);

        $statment_user_team -> execute();
    }

    function getTeams() {
        $statement_user_team = $this -> db -> prepare('SELECT * FROM user_team ut  RIGHT JOIN team t WHERE ut.user_id = :uid');
        $statement_user_team ->bindValue(':uid', $this -> host -> getId() );
        try {
            $result = $statement_user_team -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getProjectsTeam() {
        $statement_project = $this -> db -> prepare('SELECT * FROM team_project tp RIGHT JOIN project p WHERE tp_team_id = :tid');
        $statement_project -> bindValue(':tid', $this -> host ->getTeamid() );
        try {
            $result = $statement_project -> execute();
            while ($row = $result -> fetchArray(SQLITE3_ASSOC) != false) {
                return $row;
            }
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getProjectsUser() {
        $statement_project = $this -> db -> prepare('SELECT * FROM team_project tp RIGHT JOIN user u WHERE tp_user_id = :uid');
        $statement_project -> bindValue(':uid', $this -> host ->getId() );
        try {
            $result = $statement_project -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getProjects() {
        $statement = $this -> db -> prepare('SELECT project.id, project.name FROM project JOIN user_project ON user_project.project_id = project.id WHERE user_id = :uid');
        $statement -> bindValue(':uid', $this -> host ->getId());
        try {
            $result = $statement -> execute();
            $items = [];
            while (($row = $result -> fetchArray(SQLITE3_ASSOC)) != false) {
                $items[] = $row;
            }
            return $items;
        }catch (PDOException $e) {
            return ''. $e->getMessage();
        }
    }
    
    function deleteTodo($id) {
        $statement = $this -> db -> prepare('DELETE FROM todo WHERE id = :id');
        $statement -> bindValue(':id', $id);
        try {
            $statement->execute();
            return;
        }catch (PDOException $e) {
            return ''. $e->getMessage();
        }
    }

    function deleteProject($name) {
        $statement = $this -> db -> prepare('DELETE FROM project WHERE name = :pname');
        $statement -> bindValue(':pname', $name);
        try {
            $statement -> execute();
            return;
        } catch (PDOException $e) {
            return ''. $e->getMessage();
        }
    }

    function getTodos($prio) {
        $statement = $this -> db -> prepare('SELECT * FROM todo WHERE project_id = :ProjectID AND priority = :priority ORDER BY position');
        $statement ->bindValue(':ProjectID', $this -> host ->getProject() );
        $statement ->bindValue(':priority', $prio );
        try {
            $result = $statement -> execute();
            $items = [];
            while (($row = $result -> fetchArray(SQLITE3_ASSOC)) != false) {
                $items[] = $row;
            }
            return $items;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function updatePosition($id, $newposition, $prio) {
        $statement = $this -> db -> prepare('SELECT position FROM todo WHERE id = :id');
        $statement -> bindValue(':id', $id);
        $result = $statement -> execute();
        $row = $result -> fetchArray(SQLITE3_ASSOC);
        $oldposition = $row['position'];

        if ($newposition > $oldposition) {
            $query = "UPDATE todo SET position = position - 1 WHERE priority = :priority AND position > ? AND position <= ?";
            $statement = $this -> db->prepare($query);
            $statement ->bindValue(":priority", $prio);
            $statement->bindValue(1, $oldposition);
            $statement->bindValue(2, $newposition);
            $statement->execute();
        }
        // Move tasks up (shift positions up if the new position is lower)
        else {
            $query = "UPDATE todo SET position = position + 1 WHERE priority = :priority AND position < ? AND position >= ?";
            $statement = $this -> db->prepare($query);
            $statement->bindValue(":priority", $prio);
            $statement->bindValue(1, $oldposition);
            $statement->bindValue(2, $newposition);
            $statement->execute();
        }

        // Finally, update the task's position
        $query = "UPDATE todo SET position = :pos, priority = :priority WHERE id = :id";
        $statement = $this -> db->prepare($query);
        $statement->bindValue(':pos', $newposition);
        $statement->bindValue(':priority', $prio);
        $statement->bindValue(':id', $id);  // The ID of the todo being moved
        $statement->execute();
    }

    function setProject($id) {
        $this -> host -> setProject($id);
    }

    function getcurrentProject(){
        $statement = $this -> db -> prepare('SELECT project.name FROM project WHERE project.id = :pid');
        $statement -> bindValue(':pid', $this -> host ->getProject());
        try {
            $result = $statement -> execute();
            while (($row = $result -> fetchArray(SQLITE3_ASSOC)) != false) {
                return $row;
            }
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getHostProject() {
        return $this -> host -> getProject();
    }

    function logout() {
        $this -> host -> logout();
    }
}