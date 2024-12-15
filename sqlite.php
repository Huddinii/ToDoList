<?php
include("dbconnect.php");

function createUser($username, $mail, $password) {
    global $db;
    $statement = $db->prepare('INSERT INTO "user" ("username","mail", "password")
        VALUES (:uid, :mail, :password)');
    $statement->bindValue(':uid', $username);
    $statement->bindValue(':mail', $mail);
    $statement->bindValue(':password', $password);
    $statement->execute(); // you can reuse the statement with different values
}

function getUser($username) {
    global $db;
    $statement = $db->prepare('SELECT * FROM "user" WHERE "user_id" = ? AND "password" = ?');
    $statement->bindValue(1, 'admin2');
    $statement->bindValue(2, 'test321');
    $result = $statement->execute();
    if ($result === false) {
        return false;
    } else {
        return $result;
    }
}

echo("Get the 1st row as an associative array:\n");
print_r($result->fetchArray(SQLITE3_ASSOC));
echo("\n");

echo("Get the next row as a numeric array:\n");
print_r($result->fetchArray(SQLITE3_NUM));
echo("\n");

$result->finalize();

$db->close();

?>