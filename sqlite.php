<?php


$db = new SQLite3('test.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
$db -> enableExceptions(true);
$db -> query('CREATE TABLE IF NOT EXISTS "user" (
"id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
"user_id" VARCHAR NOT NULL UNIQUE,
"password" VARCHAR
)');



$statement = $db->prepare('INSERT INTO "user" ("user_id", "password")
    VALUES (:uid, :password)');
$statement->bindValue(':uid', 'admin2');
$statement->bindValue(':password', 'test321');
$statement->execute(); // you can reuse the statement with different values


$statement = $db->prepare('SELECT * FROM "user" WHERE "user_id" = ? AND "password" = ?');
$statement->bindValue(1, 'admin2');
$statement->bindValue(2, 'test321');
$result = $statement->execute();


echo("Get the 1st row as an associative array:\n");
print_r($result->fetchArray(SQLITE3_ASSOC));
echo("\n");

echo("Get the next row as a numeric array:\n");
print_r($result->fetchArray(SQLITE3_NUM));
echo("\n");

$result->finalize();

$db->close();

?>