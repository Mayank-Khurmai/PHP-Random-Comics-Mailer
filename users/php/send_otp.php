<?php

require_once __DIR__.'/database-connection.php';
require_once '../config/config.php';

class send_otp
{
    private $db;
    private $query;
    private $user_mail;
    private $otp;
    private $new_otp;
    private $header;
    private $message;
    private $config;
    
    public function send_mail_fun($user_mail, $otp){
        $this->config = new config();
        $this->user_mail = $user_mail;
        $this->otp = $otp;
        $this->message = '
            <body style=\'background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;\'>
                <div style=\'width:50%;margin:0 auto;background-color:rgb(248,248,248);padding:10px\'>
                    <h3>Your OTP for email verification is</h3>
                    <h1>'.$this->otp.'</h1>
                </div>
            </body>
        ';

        echo $this->message;
        if(mail($this->user_mail,'Email Subscription',$this->message,$this->config->header)){
            echo 'OTP Sent Successfully';
        }
        else{
            echo 'Please try Again';
        }
    }

    public function __construct()
    {
        if(isset($_POST['email'])){
            $this->user_mail = $_POST['email'];
        }
        else{
            echo 'Please try Again';
            exit();
        }
        if (!filter_var($this->user_mail, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid Email';
            exit();
        }
        $this->new_otp = random_int(100000, 999999);
        $this->db = new db();
        $this->db = $this->db->database();
        $this->user_mail = trim($this->user_mail);
        $this->user_mail = htmlspecialchars($this->user_mail,ENT_QUOTES);
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->query = $this->db->prepare('SELECT otp FROM user_data WHERE email=?');
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
                    $this->query = $this->db->prepare('UPDATE user_data SET otp=? WHERE email=?');
                    $this->query->bind_param('is',$this->new_otp,$this->user_mail);
                    $this->query->execute();
                    if($this->query->affected_rows!=0){
                        $this->send_mail_fun($this->user_mail,$this->new_otp);
                    }
                    else{
                        echo 'Please try Again';
                    }
                }
            }   
            else{
                echo 'Email is Already Verified';
            }
        }
        else{
            $this->query = $this->db->prepare('INSERT INTO user_data(email,otp) VALUES(?,?)');
            $this->query->bind_param('ss',$this->user_mail,$this->new_otp);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->user_mail,$this->new_otp);
            }
            else{
                echo 'Please try Again';
            }
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->user_mail);
        unset($this->otp);
        unset($this->new_otp);
        unset($this->header);
        unset($this->message);
        unset($this->config);
    }
}

new send_otp();

?>