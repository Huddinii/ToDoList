<?php

include("ClassUser.php");
include("dbcreate.php");



class SQLConn
{
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

    function createUser($username, $mail, $password) {
        // Passwort hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL-Statement vorbereiten
        $statement = $this -> db->prepare('INSERT INTO user (username, mail, password) VALUES (:username, :mail, :password)');

        // Werte binden
        $statement->bindValue(':username', $username);
        $statement->bindValue(':mail', $mail);
        $statement->bindValue(':password', $hashedPassword);


        // Ausführen und Fehler behandeln
        try {
            $statement->execute();
            $ID = $this -> db->lastInsertRowID();
            $selectStatement= $this -> db -> prepare('SELECT * FROM user WHERE id = :ID');
            $selectStatement->bindValue(':ID', $ID);
            $result=$selectStatement->execute();
            $insertedUSer = $result->fetchArray(SQLITE3_ASSOC);
            $this->host->login($insertedUSer['id'],$insertedUSer['username'],$insertedUSer['mail']);
            header("Location: index.php");
            return 'Benutzer erfolgreich erstellt.';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Fehlercode für UNIQUE-Verletzung
                echo('Fehlschlag');
                return 'E-Mail oder Benutzername existiert bereits.';
            }
            echo('Fehlschlag 2');
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function loginUser($logintoken, $password) {
        // SQL-Statement vorbereiten, um den Benutzer anhand der E-Mail zu finden
        $statement = $this -> db->prepare('SELECT id, username, mail, password FROM user WHERE mail = :logintoken OR username = :logintoken' );
        $statement->bindValue(':logintoken', $logintoken);

        try {
            $result = $statement->execute();
            $loginattempt = $result->fetchArray(SQLITE3_ASSOC); // Benutzerdaten abrufen

            // Überprüfen, ob ein Benutzer mit dieser E-Mail existiert
            if (!$loginattempt) {
                return 'E-Mail oder Username ist falsch.';
            }

            // Passwort überprüfen
            if (password_verify($password, $loginattempt['password'])) {
                // Erfolg: Benutzer gefunden und Passwort korrekt
                // Optional: Session starten oder Token generieren
                $this -> host ->login( $loginattempt['id'],$loginattempt['username'],$loginattempt['mail'] );
                header("Location: index.php");
                return "Willkommen, " . htmlspecialchars($loginattempt['username']) . "!";
            } else {
                // Passwort ist falsch
                header("location: login.php");
                return 'E-Mail oder Passwort ist falsch.';
            }
        } catch (PDOException $e) {
            // Datenbankfehler behandeln
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createProject($pname) {
        global $User;
        $statement_project = $this -> db->prepare('INSERT INTO project ( name )
            VALUES (:pid, :name)');
        $statement_project->bindValue(':name', $pname);
        try {
            $statement_project->execute();
            $ProjectID = $this-> db -> lastInsertRowID();
            if (!$ProjectID) {
                return 'Anlegen Fehlgeschlagen';
            }
            //USER_PROJECT TABELLEN INSERT
            $User->set_project($pid = $ProjectID);
            $statement_user_project = $this -> db->prepare('INSERT INTO user_project ( user_id, project_id ) 
            VALUES (:uid, :pid)');
            $statement_user_project->bindValue( ':uid', $User->get_id() );
            $statement_user_project->bindValue( ':pid', $ProjectID );
            $statement_user_project->execute();
            //TEAM_USER TABELLEN INSERT
            if ($User->get_teamid() !== false) {
            $statement_team_project = $this -> db->prepare('INSERT INTO team_project ( team_id, project_id ) 
            VALUES (:tid, :pid)');
            $statement_team_project->bindValue( ':tid', $User->get_teamid());
            $statement_team_project->bindValue( ':pid', $ProjectID );
            $statement_team_project->execute();
            header("location: index.php");
            }

        } catch (PDOException $e) {
            // Datenbankfehler behandeln
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createTodo($priority, $name, $description, $position, $enddate = null) {
        global $User;
        $statement = $this -> db -> prepare('INSERT INTO todo (priority, name, description, enddate, position, project_id)
        VALUE ( :priority, :name, :description, :enddate, :position :project_id)');
        $statement ->bindValue(':priority', $priority);
        $statement ->bindValue(':name', $name);
        $statement ->bindValue(':description', $description);
        $statement ->bindValue(':enddate', $enddate);
        $statement ->bindValue(':position', $position);
        $statement ->bindValue(':project_id', $User->get_project() );
        try {
            $statement -> execute();
        } catch (PDOException $e) {
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function createTeam($name) {
        global $User;
        $statement = $this -> db -> prepare('INSERT INTO team (name)
        VALUE( :name )');
        $statement ->bindValue(':name', $name);
        try {
            $statement -> execute();
        }catch (PDOException $e) {
            return ''. $e->getMessage();
        }
        $TeamID = $this -> db -> lastInsertRowID();
        $User->set_teamid($TeamID);
        $role = 'Creator';
        $statment_user_team = $this -> db -> prepare('INSERT INTO user_team (user_id, team_id, role)
        VALUE ( :user_id, :team_id, :role )');
        $statment_user_team -> bindValue(':user_id', $User->get_id() );
        $statment_user_team -> bindValue(':team_id', $TeamID);
        $statment_user_team -> bindValue(':role' ,$role);

        $statment_user_team -> execute();
    }

    function getTeams() {
        global $User;
        $statement_user_team = $this -> db -> prepare('SELECT * FROM user_team ut  RIGHT JOIN team t WHERE ut.user_id = :uid');
        $statement_user_team ->bindValue(':uid', $User->get_id() );
        try {
            $result = $statement_user_team -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getProjectsTeam() {
        global $User;
        $statement_project = $this -> db -> prepare('SELECT * FROM team_project tp RIGHT JOIN project p WHERE tp_team_id = :tid');
        $statement_project -> bindValue(':tid', $User->get_teamid() );
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
        global $User;
        $statement_project = $this -> db -> prepare('SELECT * FROM team_project tp RIGHT JOIN user u WHERE tp_user_id = :uid');
        $statement_project -> bindValue(':uid', $User->get_id() );
        try {
            $result = $statement_project -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function getTodos() {
        global $User;
        $statement = $this -> db -> prepare('SELECT * FROM todo WHERE project_id = :ProjectID');
        $statement ->bindValue(':ProjectID', $User->get_project() );
        try {
        $result = $statement -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }



}
// echo("Get the 1st row as an associative array:\n");
// print_r($result->fetchArray(SQLITE3_ASSOC));
// echo("\n");

// echo("Get the next row as a numeric array:\n");
// print_r($result->fetchArray(SQLITE3_NUM));
// echo("\n");

// $result->finalize();

// $db->close();