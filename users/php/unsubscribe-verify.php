<?php

require_once __DIR__.'/database-connection.php';
require_once '../config/config.php';

class unsubscribe_verify
{
    private $db;
    private $query;
    private $user_mail;
    private $header;
    private $message;
    private $config;

    public function send_mail_fun($user_mail){
        $this->config = new config();
        $this->user_mail = $user_mail;
        $this->message = '
                <body style=\'background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;\'>
                    <div style=\'width:50%;margin:0 auto;background-color:rgb(248,248,248);padding:10px\'>
                        <h3>Welcome User</h3>
                        <h5>You have unsubscribed for the XKCD email services and did not get any email anymore</h5>
                        <span><a href=\'http://xkcd.mayankkhurmai.in\'>Click to Subscribe again</a></span>
                    </div>
                </body>
            ';
        
        mail($this->user_mail,'Email Unsubscription',$this->message,$this->config->header);
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

        $this->db = new db();
        $this->db = $this->db->database();
        $this->user_mail = trim($this->user_mail);
        $this->user_mail = htmlspecialchars($this->user_mail,ENT_QUOTES);
        $this->user_mail = mysqli_real_escape_string($this->db,$this->user_mail);
        $this->query = $this->db->prepare('SELECT * FROM user_data WHERE otp=1 AND email=?');
        $this->query->bind_param('s',$this->user_mail);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query = $this->db->prepare('UPDATE user_data SET otp=0 WHERE email=?');
            $this->query->bind_param('s',$this->user_mail);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->user_mail);
                echo 'Email Unsubscribed';
            }
            else{
                echo 'Please try Again';
            }
        } 
        else{
            echo 'Email not Found';
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->user_mail);
        unset($this->header);
        unset($this->message);
        unset($this->config);
    }
}

new unsubscribe_verify();

?>