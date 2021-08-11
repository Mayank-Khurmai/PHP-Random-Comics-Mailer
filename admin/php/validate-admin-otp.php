<?php

require_once __DIR__.'/database-connection.php';

class validate_admin_otp
{
    private $db;
    private $query;
    private $admin_mail;
    private $admin_pass;
    private $admin_otp;
    private $c_date;
    private $m_date;

    public function __construct()
    {
        if (isset($_POST['email']) & isset($_POST['pass']) & isset($_POST['otp'])) {
            $this->admin_mail = $_POST['email'];
            $this->admin_mail = base64_decode($this->admin_mail);
            $this->admin_pass = $_POST['pass'];
            $this->admin_pass = base64_decode($this->admin_pass);
            $this->admin_pass = md5($this->admin_pass);
            $this->admin_otp = $_POST['otp'];
            $this->admin_otp = base64_decode($this->admin_otp);
            $this->admin_otp = md5($this->admin_otp);      
            date_default_timezone_set('Asia/Kolkata');       
        } 
        else {
            echo 'Please try Again';
            exit();
        }
        if (!filter_var($this->admin_mail, FILTER_VALIDATE_EMAIL)) {
            echo 'Please try Again';
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->admin_mail = trim($this->admin_mail);
        $this->admin_mail = htmlspecialchars($this->admin_mail,ENT_QUOTES);
        $this->admin_mail = mysqli_real_escape_string($this->db,$this->admin_mail);
        $this->query = $this->db->prepare('SELECT modified_date FROM admin_login WHERE pass=? AND email=? AND otp=?');
        $this->query->bind_param('sss',$this->admin_pass,$this->admin_mail,$this->admin_otp);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query->bind_result($this->m_date);
            $this->query->fetch();
            $this->c_date =date('Y-m-d H:i:s');
            if(strtotime($this->c_date) - strtotime($this->m_date)<120){
                echo 'OTP Verified';   
                session_start();
				$_SESSION['xkcd_admin'] = $this->admin_otp;
            }
            else{
                echo 'OTP Expired';
            }
        } 
        else{
            echo 'Failed';
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->admin_mail);
        unset($this->admin_pass);
        unset($this->admin_otp);
        unset($this->c_date);
        unset($this->m_date);
    }
}

new validate_admin_otp();


?>