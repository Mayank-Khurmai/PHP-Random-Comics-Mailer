<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header('Location: ../');
    exit();
}

require_once __DIR__.'/database-connection.php';

class update_pass
{
    private $db;
    private $query;
    private $admin_mail;
    private $data;
    private $response;
    private $cpass;
    private $npass;

    public function __construct()
    {
        if(isset($_POST['cpass']) & isset($_POST['npass'])){
            $this->cpass = $_POST['cpass'];
            $this->cpass = base64_decode($this->cpass);
            $this->cpass = md5($this->cpass);
            $this->npass = $_POST['npass'];
            $this->npass = base64_decode($this->npass);
            $this->npass = md5($this->npass);
        }
        else{
            echo 'Please try Again';
            exit();
        }
        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM admin_login WHERE pass='$this->cpass'";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            $this->data = $this->response->fetch_assoc();
            $this->admin_mail = $this->data['email'];
            $this->query = "UPDATE admin_login SET pass='$this->npass' WHERE email='$this->admin_mail'";
            $this->response = $this->db->query($this->query);
            if ($this->db->query($this->query)) {
                echo 'Password Changed';
            } 
            else {
                echo 'Please try Again';
            }
        }
        else{
            echo 'Incorrect Password';
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->admin_mail);
        unset($this->data);
        unset($this->response);
        unset($this->cpass);
        unset($this->npass);
    }
}

new update_pass();

?>