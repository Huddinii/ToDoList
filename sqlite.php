<?php

$User = new User();

include("dbcreate.php");
include("ClassUser.php");
class DBConn
{
    private $db;

    function __construct() {
        $this -> db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
        $this -> db -> enableExceptions(true);
    }
    function __destruct() {
        $this -> db -> close();
    }

    function createUser($username, $mail, $password) {
        global $User;
        // Passwort hashen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL-Statement vorbereiten
        $statement = $this -> db->prepare('INSERT INTO user (username, mail, password)
            VALUES (:uid, :mail, :password)');

        // Werte binden
        $statement->bindValue(':uid', $username);
        $statement->bindValue(':mail', $mail);
        $statement->bindValue(':password', $hashedPassword);


        // Ausführen und Fehler behandeln
        try {
            $statement->execute();
            $User->set_id($username);
            $User->set_email($mail);
            return 'Benutzer erfolgreich erstellt.';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Fehlercode für UNIQUE-Verletzung
                return 'E-Mail oder Benutzername existiert bereits.';
            }
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }

    function getUser($username) {
        
        $statement = $this -> db->prepare('SELECT * FROM "user" WHERE "user_id" = ? AND "password" = ?');
        $statement->bindValue(1, 'admin2');
        $statement->bindValue(2, 'test321');
        $result = $statement->execute();
        if ($result === false) {
            return false;
        } else {
            return $result;
        }
    }

    function loginUser($email, $password) {
        global $User;
        // SQL-Statement vorbereiten, um den Benutzer anhand der E-Mail zu finden
        $statement = $this -> db->prepare('SELECT id, username, email, password FROM user WHERE mail = :email');
        $statement->bindValue(':email', $email);

        try {
            $statement->execute();
            $user = $statement->fetch(); // Benutzerdaten abrufen

            // Überprüfen, ob ein Benutzer mit dieser E-Mail existiert
            if (!$user) {
                return 'E-Mail oder Passwort ist falsch.';
            }

            // Passwort überprüfen
            if (password_verify($password, $user['password'])) {
                // Erfolg: Benutzer gefunden und Passwort korrekt
                // Optional: Session starten oder Token generieren
                $User->set_id($user);
                $User->set_email($email);
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                return "Willkommen, " . htmlspecialchars($user['username']) . "!";
            } else {
                // Passwort ist falsch
                return 'E-Mail oder Passwort ist falsch.';
            }
        } catch (PDOException $e) {
            // Datenbankfehler behandeln
            return 'Datenbankfehler: ' . $e->getMessage();
        }
    }



    function createProject() {

    }

    function createTodo() {

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