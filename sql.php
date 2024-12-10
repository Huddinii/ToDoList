<?php
require 'vendor/autoload.php';
use Libsql\Database;

$db = new Database(
   url: getenv('TURSO_URL'),
   authToken: getenv('TURSO_AUTH_TOKEN'),
);

$conn = $db->connect();
function getUser($username, $password) {
   global $conn;
   $result = $conn->query('SELECT * FROM user WHERE username = :username and password = :password', [":username" => $username, ":password" => $password]);
   printf('', $result);
}

$db->close();

?>
