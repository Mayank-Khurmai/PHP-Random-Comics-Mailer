<?php

require_once __DIR__.'/database-connection.php';

    class config_db{
        private $db;
		private $query;
        public function __construct(){
            $this->db = new db();
            $this->db = $this->db->database();
            if($this->db->query('SELECT * FROM user_data')){
                echo 'Table for users already exists';
            }
            else{
                $this->query = 'CREATE TABLE user_data(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    email VARCHAR(40) NOT NULL UNIQUE,
                    otp INT(6) DEFAULT 0,
                    count INT(5) DEFAULT 0,
                    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
                )';
                if($this->db->query($this->query)){
                    echo 'Table for users created successfully';
                }
                else{
                    echo 'Failed to create users table';
                }
            }


            if($this->db->query('SELECT * FROM admin_login')){
                echo '<br>Table for admin already exists';
                $this->db->close();
            }
            else{
                $this->query = 'CREATE TABLE admin_login(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    email VARCHAR(40),
                    pass VARCHAR(35),
                    otp VARCHAR(35),
                    modified_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )';
                if($this->db->query($this->query)){
                    echo '<br>Admin table created successfully';
                }
                else{
                    echo '<br>Failed to create admin table';
                }
            }

            $this->db->close();
        }
    }

    new config_db();

    ?>