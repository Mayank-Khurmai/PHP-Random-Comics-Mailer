<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $user_mail;
    private $otp;
    private $header;
    private $message;

    public function send_mail_fun($user_mail){
        $this->user_mail = $user_mail;
        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->message = "<h3>Hi User, you have successfully Registered for the XKCD Comics Email Services and get mail in every 5 minutes. </h3><span>To Unsuscribe email Subscription, click <a href='www.google.com'>Unsuscribe</a>";
        mail($this->user_mail,"Email Registration",$this->message,$this->header);
    }

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
            $this->query = "UPDATE user_data SET otp=1 WHERE email='$this->user_mail'";
            if ($this->db->query($this->query)) {
                $this->db->close();
                $this->send_mail_fun($this->user_mail);
                echo "Email Verified";
            } 
            else {
                $this->db->close();
                echo "Please try Again";
            }
        } 
        else{
            $this->db->close();
            echo "Invalid OTP";
        }
    }
}

new main();

?>