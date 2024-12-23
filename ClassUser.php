<?php 
class User {
    private $id;
    private $username;
    private $email;
    private $teamid;

    function __construct() {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    function login ($id, $username, $email) {
        $_SESSION['uid'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    function logout(){
        session_destroy();
        $_SESSION=[];
        $this -> id = null;
        $this -> username = null;
        $this -> email = null;
        $this -> teamid = null;
    }

    function getId() {
        return $_SESSION['uid'];
    }

    function getUsername() {
        return $this -> username;
    }

    function getEmail() {
        return $this->email;
    }

    function setProject($project) {
        $_SESSION['projectid'] = $project;
    }

    function getProject() {
        return $_SESSION['projectid'];
    }

    function setTeamid($teamid) {
        $this->teamid = $teamid;
    }

    function getTeamid() {
        return $this->teamid;
    }

}
?>