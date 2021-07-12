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

        echo "OTP Sent Successfully";
        // $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        // $this->message = "<h3>Hi admin, you have successfully Registered for the XKCD Comics Email Services and get mail in every 5 minutes. </h3><span>To Unsuscribe email Subscription, click <a href='www.google.com'>Unsuscribe</a>";
        // mail($this->admin_mail,"Email Registration",$this->message,$this->header);
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