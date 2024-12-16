<?php

include("dbcreate.php");

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
        
        $statement = $this -> db->prepare('INSERT INTO "user" ("username","mail", "password")
            VALUES (:uid, :mail, :password)');
        $statement->bindValue(':uid', $username);
        $statement->bindValue(':mail', $mail);
        $statement->bindValue(':password', $password);
        $statement->execute(); // you can reuse the statement with different values
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

?>