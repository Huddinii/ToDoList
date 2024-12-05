<?php

use Libsql\Database;

$db = new Database(
   url: getenv('TURSO_URL'),
   authToken: getenv('TURSO_AUTH_TOKEN'),
);


?>
