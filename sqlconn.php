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

    function register($username, $mail, $password) {
        // Passwort hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $selectStatement= $this -> db -> prepare('SELECT * FROM user WHERE username = :username or mail = :mail');
        $selectStatement->bindValue(':username', $username);
        $selectStatement->bindValue(':mail', $mail);
        $result=$selectStatement->execute();

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
            $this->host->login($ID,$username,$mail);
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

    function login($logintoken, $password) {
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
            $this -> host -> setProject($pid = $ProjectID);
            $statement_user_project = $this -> db->prepare('INSERT INTO user_project ( user_id, project_id ) 
            VALUES (:uid, :pid)');
            $statement_user_project->bindValue( ':uid', $this -> host -> getId() );
            $statement_user_project->bindValue( ':pid', $ProjectID );
            $statement_user_project->execute();
            //TEAM_USER TABELLEN INSERT
            if ($this-> host -> getTeamid() !== false) {
            $statement_team_project = $this -> db->prepare('INSERT INTO team_project ( team_id, project_id ) 
            VALUES (:tid, :pid)');
            $statement_team_project->bindValue( ':tid', $this-> host ->getTeamid());
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
        $statement = $this -> db -> prepare('INSERT INTO todo (priority, name, description, enddate, position, project_id)
        VALUE ( :priority, :name, :description, :enddate, :position :project_id)');
        $statement ->bindValue(':priority', $priority);
        $statement ->bindValue(':name', $name);
        $statement ->bindValue(':description', $description);
        $statement ->bindValue(':enddate', $enddate);
        $statement ->bindValue(':position', $position);
        $statement ->bindValue(':project_id', $this-> host ->getProject() );
        try {
            $statement -> execute();
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

    function getTodos() {
        $statement = $this -> db -> prepare('SELECT * FROM todo WHERE project_id = :ProjectID');
        $statement ->bindValue(':ProjectID', $this -> host ->getProject() );
        try {
        $result = $statement -> execute();
            return $result;
        }catch (PDOException $e) {
            return 'Datenbankfehler'. $e->getMessage();
        }
    }

    function logout() {
        $this -> host -> logout();
    }
}