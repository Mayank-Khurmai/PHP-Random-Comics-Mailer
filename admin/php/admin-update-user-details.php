<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header('Location: ../');
    exit();
}

require_once __DIR__.'/database-connection.php';

class update_user_details
{
    private $db;
    private $query;
    private $user_mail;
    private $user_id;
    private $count;
    private $status;

    public function __construct()
    {
        if(isset($_POST['id']) & isset($_POST['email']) & isset($_POST['count']) & isset($_POST['status'])){
            $this->user_id = $_POST['id'];
            $this->user_mail = $_POST['email'];
            $this->count = $_POST['count'];
            $this->status = $_POST['status'];
        }
        else{
            echo 'Please try Again';
            exit();
        }
        if (!filter_var($this->user_mail, FILTER_VALIDATE_EMAIL)) {
            echo 'Please try Again';
            exit();
        }
        $this->db = new db();
        $this->db = $this->db->database();
        $this->user_id = trim($this->user_id);
        $this->user_id = htmlspecialchars($this->user_id,ENT_QUOTES);
        $this->user_id = mysqli_real_escape_string($this->db,$this->user_id);
        $this->user_mail = trim($this->user_mail);
        $this->user_mail = htmlspecialchars($this->user_mail,ENT_QUOTES);
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->count = trim($this->count);
        $this->count = htmlspecialchars($this->count,ENT_QUOTES);
        $this->count = mysqli_real_escape_string($this->db,$this->count);
        $this->status = trim($this->status);
        $this->status = htmlspecialchars($this->status,ENT_QUOTES);
        $this->status = mysqli_real_escape_string($this->db,$this->status);
        $this->query = $this->db->prepare('UPDATE user_data SET email=?, otp=?, count=? WHERE id=?');
        $this->query->bind_param('siii',$this->user_mail,$this->status,$this->count,$this->user_id);
        $this->query->execute();
        if($this->query->affected_rows!=0){
            echo 'Success';
        }
        else{
            echo 'Please try Again';
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->user_mail);
        unset($this->user_id);
        unset($this->count);
        unset($this->status);
    }
}

new update_user_details();

?>