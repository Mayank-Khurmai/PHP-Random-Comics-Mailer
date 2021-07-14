<?php

require_once __DIR__."/database-connection.php";

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
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->otp = mysqli_real_escape_string($this->db,$this->otp);
        $this->query = $this->db->prepare("SELECT * FROM user_data WHERE email=? AND otp=?");
        $this->query->bind_param('si',$this->user_mail,$this->otp);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query = $this->db->prepare("UPDATE user_data SET otp=1 WHERE email=?");
            $this->query->bind_param('s',$this->user_mail);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->user_mail);
                echo "Email Verified";
            }
            else{
                echo "Please try Again";
            }
        } 
        else{
            echo "Invalid OTP";
        }
        $this->db->close();
    }
}

new main();

?>