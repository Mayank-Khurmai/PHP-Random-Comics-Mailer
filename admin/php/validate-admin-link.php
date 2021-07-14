<?php

require_once __DIR__."/database-connection.php";

class main
{
    private $db;
    private $query;
    private $admin_mail;
    private $admin_hash_otp;
    private $m_date;
    private $c_date;

    public function __construct()
    {
        if (isset($_GET['email']) & isset($_GET['otp'])) {
            $this->admin_mail = $_GET["email"];
            $this->admin_hash_otp = $_GET["otp"];      
            date_default_timezone_set('Asia/Kolkata');   
        } 
        else {
            header("Location: http://localhost/php-Mayank-Khurmai/admin/");
            exit();
        }
        if (!filter_var($this->admin_mail, FILTER_VALIDATE_EMAIL)) {
            header("Location: http://localhost/php-Mayank-Khurmai/admin/");
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->admin_mail = mysqli_real_escape_string($this->db,$this->admin_mail);
        $this->admin_hash_otp = mysqli_real_escape_string($this->db,$this->admin_hash_otp);
        $this->query = $this->db->prepare("SELECT modified_date FROM admin_login WHERE email=? AND otp=?");
        $this->query->bind_param('ss',$this->admin_mail,$this->admin_hash_otp);
        $this->query->execute();
        $this->query->store_result();
        if ($this->query->num_rows != 0) {
            $this->query->bind_result($this->m_date);
            $this->query->fetch();
            $this->c_date =date("Y-m-d H:i:s");
            if(strtotime($this->c_date) - strtotime($this->m_date)<120){
                session_start();
                $_SESSION['xkcd_admin'] = $this->admin_hash_otp;
                $this->db->close();
                header("Location: http://localhost/php-Mayank-Khurmai/admin/php/admin-home.php");
                exit();
            }
            else{
                $this->db->close();
                header("Location: http://localhost/php-Mayank-Khurmai/admin/");
                exit();
            }
        } 
        else{
            $this->db->close();
            header("Location: http://localhost/php-Mayank-Khurmai/admin/");
            exit();
        }
    }
}

new main();


?>