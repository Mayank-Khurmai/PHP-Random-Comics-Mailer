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
        $this->query = "SELECT * FROM user_data WHERE email ='$this->user_mail'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
                echo "Email is Already Added";
        } 
        else{
            $this->query = "INSERT INTO user_data(email,otp) VALUES('$this->user_mail',1)";
            if ($this->db->query($this->query)) {
                echo "Added Successfully";
            } 
            else {
                echo "Please try Again";
            }
        }
    }
}

new main();

?>