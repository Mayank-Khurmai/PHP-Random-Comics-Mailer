<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $user_mail;
    private $otp;
    private $data;
    private $header;
    private $message;
    
    public function send_mail_fun($user_mail, $otp){
        $this->user_mail = $user_mail;
        $this->otp = $otp;
        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->message = "<h3>Your OTP for email verification is : <span style='color:red'>".$this->otp."</span></h3>";

        if(mail("mayankkhurmai8@gmail.com","Email OTP Verification",$this->message,$this->header)){
            echo "OTP Sent Successfully";
        }
        else{
            echo "Please try Again";
        }
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
        $this->otp = random_int(100000, 999999);
        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM user_data WHERE email ='$this->user_mail'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->data = $this->response->fetch_assoc();
            if($this->data['otp'] != 0){
                $this->otp = $this->data['otp'];                
                $this->send_mail_fun($this->user_mail,$this->otp);
            }   
            else{
                echo "Email is Already Verified";
            }
        } 
        else{
            $this->query = "INSERT INTO user_data(email, otp) VALUES('$this->user_mail','$this->otp')";
            if ($this->db->query($this->query)) {
                $this->send_mail_fun($this->user_mail,$this->otp);
            } 
            else {
                echo "Please try Again";
            }
        }
    }
}

new main();

?>