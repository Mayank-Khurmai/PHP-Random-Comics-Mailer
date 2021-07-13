<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $data;
    private $admin_mail;
    private $admin_pass;
    private $admin_otp;
    private $c_date;
    private $m_date;

    public function __construct()
    {
        if (isset($_POST['email']) & isset($_POST['pass']) & isset($_POST['otp'])) {
            $this->admin_mail = $_POST["email"];
            $this->admin_mail = base64_decode($this->admin_mail);
            $this->admin_pass = $_POST["pass"];
            $this->admin_pass = base64_decode($this->admin_pass);
            $this->admin_pass = md5($this->admin_pass);
            $this->admin_otp = $_POST["otp"];
            $this->admin_otp = base64_decode($this->admin_otp);
            $this->admin_otp = md5($this->admin_otp);      
            date_default_timezone_set('Asia/Kolkata');       
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
        $this->query = "SELECT * FROM admin_login WHERE pass='$this->admin_pass' AND email='$this->admin_mail' AND otp='$this->admin_otp'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->data = $this->response->fetch_assoc();
            $this->m_date = $this->data['modified_date'];
            $this->c_date =date("Y-m-d H:i:s");
            if(strtotime($this->c_date) - strtotime($this->m_date)<120){
                echo "OTP Verified";   
                session_start();
				$_SESSION['xkcd_admin'] = $this->admin_hash_otp;
                $this->db->close();
                header("Location: http://localhost/php-Mayank-Khurmai/admin/php/admin-home.php");
                exit();
            }
            else{
                echo "OTP Expired";
                $this->db->close();
            }
        }
        else{   
            echo "Failed";
            $this->db->close();
        }
    }
}

new main();


?>