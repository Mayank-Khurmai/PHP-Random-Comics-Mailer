<?php

require_once __DIR__."/database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $user_mail;
    private $header;
    private $message;

    public function send_mail_fun($user_mail){
        $this->user_mail = $user_mail;
        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->message = "<h3>Hi User, you you will not receive any email XKCD Comics more.</h3><span>If you want to subscribe again, the click on <a href='www.google.com'>subscribe</a></span>";
        mail($this->user_mail,"Email Unsubscription",$this->message,$this->header);
    }


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
                $this->send_mail_fun($this->user_mail);
                echo "Email Unsubscribed";
            } 
            else {
                echo "Please try Again";
            }
            $this->db->close();
        } 
        else{
            $this->db->close();
            echo "Email not Found";
        }
    }
}

new main();

?>