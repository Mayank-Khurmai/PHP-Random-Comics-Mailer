<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $user_mail;
    private $otp;

    public function __construct()
    {
        if(isset($_POST['email']) & isset($_POST['otp'])){
            $this->user_mail = $_POST["email"];
            $this->otp = $_POST["otp"];
        }
        else{
            echo "Please try Again";
            exit();
        }
        if (!filter_var($this->user_mail, FILTER_VALIDATE_EMAIL)) {
            echo "Please try Again";
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM user_data WHERE email='$this->user_mail' AND otp='$this->otp'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->query = "UPDATE user_data SET otp=0 WHERE email = '$this->user_mail'";
            if ($this->db->query($this->query)) {
                echo "Email Verified";
            } 
            else {
                echo "Please try Again";
            }
        } 
        else{
            echo "Invalid OTP";
        }
    }
}

new main();