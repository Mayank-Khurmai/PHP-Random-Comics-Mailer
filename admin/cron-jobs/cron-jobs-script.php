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

    public function send_mail_fun($user_mail){
        $this->send_mail = $user_mail;
        $this->header_array = get_headers("https://c.xkcd.com/random/comic",1);   // fetch all the headers sent by the server in the response of an HTTP request and non-negative integer give it as associative array                              
        $this->url_location = $this->header_array['Location'][1]; 
        $this->url = $this->url_location.'/info.0.json'; // path to your JSON        
        $this->url_content = file_get_contents($this->url); // put the contents of the file into a variable
        $this->url_content = json_decode($this->url_content);
        $this->header = "From: XKCD Comics <noreply@mayank.com> \nMIME-Version:1.0 \nContent-Type:text/html;charset=ISO-8859-1 \n";
        $this->comic_desc = str_replace(array('(', ')', 'alt', '<','>', '"..."', '...'), '', $this->url_content->transcript);
        $this->comic_desc = str_replace(array('#'), "<br>",$this->comic_desc);
        $this->comic_desc = str_replace(array('[[','{{'), "<br><b>",$this->comic_desc);
        $this->comic_desc = str_replace(array(']]','}}'), "<br></b>",$this->comic_desc);
        $this->message = "
            <body style='background-color:rgb(238,238,238);padding-top:0px;padding-bottom:10px;text-align:center;'>
                <div style='padding:8px;margin:5px auto;background-color:rgb(248,248,248);'>
                    <h2>".$this->url_content->title."</h2>
                </div>
                <img src='".$this->url_content->img."' alt='".$this->url_content->alt."'>
                <div style='padding:5px;margin:5px auto;background-color:rgb(248,248,248);'>
                    <p style='text-align:justify'>".$this->comic_desc."</p>
                </div>
                <div style='width:100%;text-align:center;padding-top:10px;'>
                    <span><a href='www.google.com'>Click to Unsubscribe</a></span>
                </div>
            </body>
            ";
        mail($this->send_mail,"#".$this->url_content->num." - ".$this->url_content->title,$this->message,$this->header);
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
}

new main();

?>