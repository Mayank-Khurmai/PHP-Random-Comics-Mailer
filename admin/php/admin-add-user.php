<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header('Location: ../');
    exit();
}

require_once __DIR__.'/database-connection.php';

class add_user
{
    private $db;
    private $query;
    private $user_mail;

    public function __construct()
    {
        if(isset($_POST['email'])){
            $this->user_mail = $_POST['email'];
        }
        else{
            echo 'Please try Again';
            exit();
        }
        if (!filter_var($this->user_mail, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid Email';
            exit(); 
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->user_mail = trim($this->user_mail);
        $this->user_mail = htmlspecialchars($this->user_mail,ENT_QUOTES);
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->query = $this->db->prepare('SELECT * FROM user_data WHERE email =?');
        $this->query->bind_param('s',$this->user_mail);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            echo 'Email is Already Added';
        } 
        else{
            $this->query = $this->db->prepare('INSERT INTO user_data(email,otp) VALUES(?,1)');
            $this->query->bind_param('s',$this->user_mail);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                echo 'Added Successfully';
            }
            else{
                echo 'Please try Again';
            }
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->user_mail);
    }
}

new add_user();

?>