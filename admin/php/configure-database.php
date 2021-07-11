<?php

    require_once "./database-connection.php";

    class main{
        private $db;
		private $query;
        public function __construct(){
            $this->db = new db();
            $this->db = $this->db->database();
            if($this->db->query("SELECT * FROM user_data")){
                echo "Table Already Exists";
            }
            else{
                $this->query = "CREATE TABLE user_data(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    email VARCHAR(40) NOT NULL UNIQUE,
                    otp INT(6) DEFAULT 0,
                    count INT(5) DEFAULT 0,
                    date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP
                )";
                if($this->db->query($this->query)){
                    echo "Table Created Successfully";
                }
                else{
                    echo "Failed to Create Table";
                }
            }
            mysqli_close($this->db);
        }
    }

    new main();

    ?>