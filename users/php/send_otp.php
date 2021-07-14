<?php

require_once __DIR__."/database-connection.php";

class main
{
    private $db;
    private $query;
    private $user_mail;
    private $otp;
    private $new_otp;
    private $header;
    private $message;
    
    public function send_mail_fun($user_mail, $otp){
        $this->user_mail = $user_mail;
        $this->otp = $otp;
        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->message = "<h3>Your OTP for email verification is : <span style='color:red'>".$this->otp."</span></h3>";

        if(mail($this->user_mail,"Email OTP Verification",$this->message,$this->header)){
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
        $this->new_otp = random_int(100000, 999999);
        $this->db = new db();
        $this->db = $this->db->database();
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->query = $this->db->prepare("SELECT otp FROM user_data WHERE email=?");
        $this->query->bind_param('s',$this->user_mail);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query->bind_result($this->otp);
            $this->query->fetch();
            if($this->otp != 1){
                if($this->otp !=0){        
                    $this->send_mail_fun($this->user_mail,$this->otp);
                }
                else{
                    $this->query = $this->db->prepare("UPDATE user_data SET otp=? WHERE email=?");
                    $this->query->bind_param('is',$this->new_otp,$this->user_mail);
                    $this->query->execute();
                    if($this->query->affected_rows!=0){
                        $this->send_mail_fun($this->user_mail,$this->new_otp);
                    }
                    else{
                        echo "Please try Again 1";
                    }
                }
            }   
            else{
                echo "Email is Already Verified";
            }
        }
        else{
            $this->query = $this->db->prepare("INSERT INTO user_data(email,otp) VALUES(?,?)");
            $this->query->bind_param('ss',$this->user_mail,$this->new_otp);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->user_mail,$this->new_otp);
            }
            else{
                echo "Please try Again";
            }
        }
        $this->db->close();
    }
}

new main();

?>