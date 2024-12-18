<?php 
class User {
    private $id;
    private $email;
    private $projectid;
    private $teamid;

    function __construct() {
    }   

    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }
    function set_email($email) {
        $this->email = $email;
    }

    function get_email() {
        return $this->email;

    }
    function set_project($project) {
        $this->projectid = $project;
    }
    function get_project() {
        return $this->projectid;
    }
    function set_teamid($teamid) {
        $this->teamid = $teamid;
    }   
    function get_teamid() {
        return $this->teamid;
    }

}
?>