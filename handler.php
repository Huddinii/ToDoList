<?php
include("sqlconn.php");

class RequestHandler {
     private $Connection;

    public function __construct($action, $params) {
        $this->Connection = New SQLConn();
        switch ($action) {
            case 'login':
                $this ->Connection->login($params['username'], $params['password'] );
                header('location: index.php');
                break;
            case 'logout': 
                $this -> Connection -> logout();
                header('location: index.php');
                break;
            case 'register':
                $this ->Connection->register($params['username'], $params['mail'] ,$params['password']);
                header('location: index.php');
                break;
            case 'newProject':
                $this ->Connection->createProject($params['projectname']);
                header('location: index.php');
                break;
            case 'deleteTodo':
                break;
            case 'deleteProject':
                break;    
            case 'gotologin': 
                header('location: login.php');
                break;
            case'ChangeProject':
                header('Location: index.php');
                break;
            case 'createTodo':
                $this ->Connection->createTodo( $params['prio'], $params['name'], $params['desctiption'],$params['position'],$params['enddate'] );
                header('location: index.php');
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