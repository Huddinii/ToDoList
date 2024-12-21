<?php
include("sqlconn.php");

class RequestHandler {
     private $Connection;

    public function __construct($action, $params) {
        $this->Connection = New SQLConn();
        switch ($action) {
            case 'login':
                $this ->Connection->login($params['username'], $params['password'] );
                break;
            case 'logout': 
                header('location: index.php');
                $this -> Connection -> logout();
                break;
            case 'register':
                $this ->Connection->register($params['username'], $params['mail'] ,$params['password']);
                    break;
            case 'newProject':
                $this ->Connection->createProject($params['projectname']);
                break;
            case 'deleteTodo':
                break;
            case 'deleteProject':
                break;    
            case 'gotologin': 
                header('location: login.php');
                break;
            default:
                echo "Unbekannte Aktion: $action";
        }
    }
}

    $action = $_POST['method'] ?? 'default';
    $params = $_POST;
    
    // Handler aufrufen
    $handler = new RequestHandler($action, $params);
?>