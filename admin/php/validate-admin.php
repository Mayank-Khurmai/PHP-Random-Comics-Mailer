<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $admin_mail;
    private $admin_pass;
    private $admin_otp;
    private $admin_hash_otp;
    private $header;
    private $message;

    public function send_mail_fun($admin_mail,$admin_otp,$admin_hash_otp){
        $this->admin_mail = $admin_mail;
        $this->admin_otp = $admin_otp;
        $this->admin_hash_otp = $admin_hash_otp;

        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->message = "<h4>Hi admin, your OTP is valid only for 2 minute </h4><h3>Your OTP for email verification is : <span style='color:red;font-weight:bold'>".$this->admin_otp."</span></h3>";
        if(mail($this->admin_mail,"Admin panel OTP verification",$this->message,$this->header)){
            echo "OTP Sent Successfully";
        }
        else{
            echo "Please try Again";
        }
    }

    public function __construct()
    {
        if (isset($_POST['email']) & isset($_POST['pass'])) {
            $this->admin_mail = $_POST["email"];
            $this->admin_mail = base64_decode($this->admin_mail);
            $this->admin_pass = $_POST["pass"];
            $this->admin_pass = base64_decode($this->admin_pass);
            $this->admin_pass = md5($this->admin_pass);
            $this->admin_otp = random_int(100000, 999999);
            $this->admin_hash_otp = md5($this->admin_otp);            
        } 
        else {
            echo "Please try Again";
            exit();
        }
        if (!filter_var($this->admin_mail, FILTER_VALIDATE_EMAIL)) {
            echo "Please try Again";
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM admin_login";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows == 0) {
            $this->query = "INSERT INTO admin_login(email,pass,otp) VALUES('$this->admin_mail','$this->admin_pass','$this->admin_hash_otp')";
            if ($this->db->query($this->query)) {
                $this->send_mail_fun($this->admin_mail,$this->admin_otp,$this->admin_hash_otp);
            }
            else {
                echo "Please try Again";
            }
        } else {
            $this->query = "SELECT * FROM admin_login WHERE email='$this->admin_mail' AND pass='$this->admin_pass'";
            $this->response = $this->db->query($this->query);
            if ($this->response->num_rows != 0) {
                $this->query = "UPDATE admin_login SET otp='$this->admin_hash_otp' WHERE email='$this->admin_mail' AND pass='$this->admin_pass'";
                if ($this->db->query($this->query)) {
                    $this->send_mail_fun($this->admin_mail,$this->admin_otp,$this->admin_hash_otp);
                } 
                else {
                    echo "Please try Again";
                }
            }
            else {
                echo "Invalid Credentials";
            }
        }
    }
}

new main();


?>