<?php
include("sqlconn.php");

class RequestHandler {
     private $Connection;

    public function __construct($action, $params) {
        $this->Connection = SQLConn::getInstance();
        switch ($action) {
            case 'login':
                $result = $this ->Connection->login($params['username'], $params['password'] );
                echo $result;
                if ($result == false) {
                    header('location: index.php');
                } else {
                    header('Location: login.php');
                    echo $result;
                }
                break;
            case 'logout': 
                $this -> Connection -> logout();
                header('location: index.php');
                break;
            case 'register':
                $result = $this ->Connection->register($params['username'], $params['mail'] ,$params['password']);
                if ($result === null) {
                    header('Location: index.php');
                    exit;
                } else {
                    $errorMsg = urlencode($result);
                    header("Location: register.php?loginFailed=1&errorMsg=$errorMsg");
                    exit;
                }
                break;
            case 'newProject':
                $this ->Connection->createProject($params['projectname']);
                header('location: index.php');
                break;
            case 'deleteTodo':
                break;
            case 'DeleteProject':
                $this -> Connection->deleteProject($params['pname']);
                header('Location: index.php');
                break;    
            case 'gotologin': 
                header('location: login.php');
                break;
            case'ChangeProject':
                $this -> Connection->setProject($params['projectId']);
                header('Location: index.php');
                break;
            case 'CreateTodo':
                $result = $this ->Connection->createTodo( $params['priority'], $params['name'], $params['desctiption']??'',$params['enddate']??'' );
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