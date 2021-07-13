<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
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
        $this->query = "SELECT * FROM admin_login WHERE email='$this->admin_mail' AND otp='$this->admin_hash_otp'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->data = $this->response->fetch_assoc();
            $this->m_date = $this->data['modified_date'];
            $this->c_date =date("Y-m-d H:i:s");
            if(strtotime($this->c_date) - strtotime($this->m_date)>120){
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