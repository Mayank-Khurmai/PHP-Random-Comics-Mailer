<?php


require_once __DIR__.'/database-connection.php';

class validate_admin
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

        $this->header .= 'From: XKCD Comics' ."\n";
        $this->header .= 'Reply-To: mayankkhurmai8@gmail.com' ."\n";
        $this->header .= 'MIME-Version:1.0' ."\n";
        $this->header .= 'Content-Type:text/html;charset=ISO-8859-1' ."\n";
        $this->message = '
            <body style=\'background-color:rgb(238,238,238);padding-top:10px;padding-bottom:10px;text-align:center;\'>
                <div style=\'width:50%;margin:0 auto;background-color:rgb(248,248,248);padding:10px\'>
                    <h3>Your OTP is valid only for 2 minutes</h3>
                    <h1>".$this->admin_otp."</h1>
                    <h4>OR</h4>
                    <a href=\'http://xkcd.mayankkhurmai.in/admin/php/validate-admin-link.php?email='.$this->admin_mail.'&otp='.$this->admin_hash_otp.'\'><button style=\'border-radius:10px;cursor:pointer\'><h3 style=\'cursor:pointer\'>Click here to verify your OTP</h3></button></a>
                </div>
            </body>
        ';
        
        if(mail($this->admin_mail,'Admin panel OTP verification',$this->message,$this->header)){
            echo 'OTP Sent Successfully';
        }
        else{
            echo 'Please try Again';
        }
    }

    public function __construct()
    {
        if (isset($_POST['email']) & isset($_POST['pass'])) {
            $this->admin_mail = $_POST['email'];
            $this->admin_mail = base64_decode($this->admin_mail);
            $this->admin_pass = $_POST['pass'];
            $this->admin_pass = base64_decode($this->admin_pass);
            $this->admin_pass = md5($this->admin_pass);
            $this->admin_otp = random_int(100000, 999999);
            $this->admin_hash_otp = md5($this->admin_otp);            
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
        $this->query = 'SELECT * FROM admin_login';
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows == 0) {
            $this->query = $this->db->prepare('INSERT INTO admin_login(email,pass,otp) VALUES(?,?,?)');
            $this->query->bind_param('sss',$this->admin_mail,$this->admin_pass,$this->admin_hash_otp);
            $this->query->execute();
            if($this->query->affected_rows!=0){
                $this->send_mail_fun($this->admin_mail,$this->admin_otp,$this->admin_hash_otp);
            }
            else{
                echo 'Please try Again';
            }
        }
        else{
            $this->query = $this->db->prepare('SELECT * FROM admin_login WHERE email=? AND pass=?');
            $this->query->bind_param('ss',$this->admin_mail,$this->admin_pass);
            $this->query->execute();
            $this->query->store_result();
            if ($this->query->num_rows != 0) {
                $this->query = $this->db->prepare('UPDATE admin_login SET otp=? WHERE email=? AND pass=?');
                $this->query->bind_param('sss',$this->admin_hash_otp,$this->admin_mail,$this->admin_pass);
                $this->query->execute();
                if($this->query->affected_rows!=0){
                    $this->send_mail_fun($this->admin_mail,$this->admin_otp,$this->admin_hash_otp);
                }
                else{
                    echo 'Please try Again';
                }
            } 
            else{
                echo 'Invalid Credentials';
            }
        }
        $this->db->close();
    }
}

new validate_admin();


?>