'<?php

class db{
		private $db;
		public function database(){
			$this->db = new mysqli('localhost','root','','xkcd');
			if(!$this->db->connect_error)
			{
				return $this->db;
			}
            else{
                die('Database Connection Error');
            }
		}
    }
    
?>