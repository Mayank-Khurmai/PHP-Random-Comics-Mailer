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
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->query = $this->db->prepare("SELECT * FROM user_data WHERE otp=1 AND email=?");
        $this->query->bind_param('s',$this->user_mail);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query = $this->db->prepare("UPDATE user_data SET otp=0 WHERE email=?");
            $this->query->bind_param('s',$this->user_mail);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->user_mail);
                echo "Email Unsubscribed";
            }
            else{
                echo "Please try Again 1";
            }
        } 
        else{
            echo "Email not Found";
        }
        $this->db->close();
    }
}

new main();

?>