<?php 
class User {
    private $id;
    private $email;

    function __construct() {
    }   

    function set_id($id) {
        $this->id = $id;
    }
    function set_email($email) {
        $this->email = $email;
    }

    function get_email() {
        return $this->email;

    }

}
?>