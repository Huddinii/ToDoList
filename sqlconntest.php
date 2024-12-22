<?php
include("sqlconn.php");

$sqlconn = SQLConn::getInstance();
$sqlconn -> login('test323', "test323");
$result = $sqlconn -> getProjects();
var_dump($result);

?>