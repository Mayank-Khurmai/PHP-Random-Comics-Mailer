<?php

require_once __DIR__."/database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $data;
    private $user_mail;
    private $send_mail;
    private $count;
    private $header;
    private $comic_desc;
    private $message;
    private $header_array;
    private $url_location;
    private $url_content;
    private $boundary;
    private $msg_body;

    public function send_mail_fun($user_mail){
        $this->send_mail = $user_mail;
        $this->boundary = md5("random");

        // Fetching and Sanitizing content from xkcd
        $this->header_array = get_headers("https://c.xkcd.com/random/comic",1);   // fetch all the headers sent by the server in the response of an HTTP request and non-negative integer give it as associative array                              
        $this->url_location = $this->header_array['Location'][1]; 
        $this->url = $this->url_location.'/info.0.json'; // path to your JSON        
        $this->url_content = file_get_contents($this->url); // put the contents of the file into a variable
        $this->url_content = json_decode($this->url_content);


        $this->header = "From: XKCD Comics \nReply-To: xkcd@xkcd.com \nMIME-Version:1.0 \nContent-Type:multipart/mixed;charset=ISO-8859-1;boundary = $this->boundary \n";

        // Fetching the Image from image URL
        $this->img_content = file_get_contents($this->url_content->img); 
        $this->img_encoded_content = base64_encode($this->img_content);

        //Adding Display Content
        $this->comic_desc = str_replace(array('(', ')', 'alt', '<','>', '"..."', '...'), '', $this->url_content->transcript);
        $this->comic_desc = str_replace(array('#'), "<br>",$this->comic_desc);
        $this->comic_desc = str_replace(array('[[','{{'), "<br><b>",$this->comic_desc);
        $this->comic_desc = str_replace(array(']]','}}'), "<br></b>",$this->comic_desc);
        $this->message = "
            <body style='background-color:rgb(238,238,238);padding-top:0px;padding-bottom:10px;text-align:center;border:2px solid #36454F;'>
                <div style='padding:8px;margin:0px auto;background-color:rgb(248,248,248);'>
                    <h2>".$this->url_content->title."</h2>
                </div>
                <img src='".$this->url_content->img."' alt='".$this->url_content->alt."'>
                <div style='padding:5px;margin:5px auto;'>
                    <p style='text-align:justify'>".$this->comic_desc."</p>
                </div>
                <div style='width:100%;text-align:center;padding-top:10px;'>
                    <span><a href='www.google.com'>Click to Unsubscribe</a></span>
                </div>
            </body>
            ";     
        $this->msg_body = "--$this->boundary\n";
        $this->msg_body .= "Content-Type: text/html; charset=ISO-8859-1\n";
        $this->msg_body .= "Content-Transfer-Encoding: base64\n";
        $this->msg_body .= chunk_split(base64_encode($this->message));



        // Adding the encoded image as attachment
        $this->msg_body .="--$this->boundary\n";
        $this->msg_body .="Content-Type: image/*; name=".$this->url_content->num."\n";
        $this->msg_body .="Content-Disposition: attachment; filename=".$this->url_content->num.".png\n";
        $this->msg_body .="Content-Transfer-Encoding: base64\n";
        $this->msg_body .="X-Attachment-Id: ".rand(1000, 99999)."\n";
        $this->msg_body .= $this->img_encoded_content;

        // Final function to send mail using SMTP
        mail($this->send_mail,"#".$this->url_content->num." - ".$this->url_content->title,$this->msg_body,$this->header);
    }

    public function __construct()
    {
        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM user_data WHERE otp=1";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            while($this->data = $this->response->fetch_assoc()){
                $this->count = $this->data['count']+1;
                $this->user_mail= $this->data['email'];
                $this->db->query("UPDATE user_data SET count='$this->count' WHERE email='$this->user_mail'");
                $this->send_mail_fun($this->user_mail);
            }
        }
        $this->db->close();
    }

    public function __destruct()
    {
        // echo "Currently used memory : ";
        // echo memory_get_usage()/1024;
   
        // echo "<br>Peak used memory : ";
        // echo memory_get_peak_usage()/1024;
    
        unset($this->db);
        unset($this->query);
        unset($this->response);
        unset($this->data);
        unset($this->user_mail);
        unset($this->send_mail);
        unset($this->count);
        unset($this->header);
        unset($this->comic_desc);
        unset($this->message);
        unset($this->header_array);
        unset($this->url_location);
        unset($this->url_content);
        unset($this->boundary);
        unset($this->msg_body);
        unset($this->img_content);
        unset($this->img_encoded_content);
    }

}

new main();

?>