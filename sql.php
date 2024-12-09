<?php

use Libsql\Database;

$db = new Database(
   url: getenv('TURSO_URL'),
   authToken: getenv('TURSO_AUTH_TOKEN'),
);


function getUser($username, $password) {
   global $db;
   $result = $db->query('SELECT * FROM user WHERE username = :username and password = :password', [":username" => $username, ":password" => $password]);
   printf('', $result);
}

$db->close();

?>
