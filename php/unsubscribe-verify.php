<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $user_mail;

    public function __construct()
    {
        if(isset($_POST['email'])){
            $this->user_mail = $_POST["email"];
        }
        else{
            echo "Please try Again";
            exit();
        }
        if (!filter_var($this->user_mail, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid Email";
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM user_data WHERE otp=1 AND email='$this->user_mail'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->query = "UPDATE user_data SET otp=0 WHERE email = '$this->user_mail'";
            if ($this->db->query($this->query)) {
                $this->db->close();
                echo "Email Unsubscribed";
            } 
            else {
                $this->db->close();
                echo "Please try Again";
            }
        } 
        else{
            $this->db->close();
            echo "Email not Found";
        }
    }
}

new main();

?>