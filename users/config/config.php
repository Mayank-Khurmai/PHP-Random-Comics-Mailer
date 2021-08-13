<?php

class config{
        public $header;
        public function __construct(){
            $this->header .= 'From: XKCD Comics' ."\n";
            $this->header .= 'Reply-To: mayankkhurmai8@gmail.com' ."\n";
            $this->header .= 'MIME-Version:1.0' ."\n";
            $this->header .= 'Content-Type:text/html;charset=ISO-8859-1' ."\n";
        }
    }
    
?>