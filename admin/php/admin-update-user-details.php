<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header("Location: http://localhost/php-Mayank-Khurmai/admin/");
    exit();
}

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $user_mail;
    private $id;
    private $count;

    public function __construct()
    {
        if(isset($_POST['id']) & isset($_POST['email']) & isset($_POST['count']) & isset($_POST['status'])){
            $this->id = $_POST["id"];
            $this->user_mail = $_POST["email"];
            $this->count = $_POST["count"];
            $this->status = $_POST["status"];
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
        $this->query = "UPDATE user_data SET email='$this->user_mail', otp='$this->status', count='$this->count' WHERE id='$this->id'";
        $this->response = $this->db->query($this->query);
        if ($this->db->query($this->query)) {
            $this->db->close();
            echo "Success";
        } 
        else {
            $this->db->close();
            echo "Please try Again";
        }
    }
}

new main();

?>