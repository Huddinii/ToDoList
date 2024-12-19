<?php

include("sqlconn.php");

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $method = $_POST['method'];
    $username = $_POST['username'];
    $mail = $_POST['email'];
    $password = $_POST['password'];
    $message;
    if ($method == 'register') {
        if (empty($username) || empty($mail) || empty($password)) {
            $message = 'Es müssen alle Felder befüllt werden';
        // } else if (LengthException::check($username, $mail, $password)) {
            echo $message;

        }
    } else if ($method == 'login') {

    }
}
?>