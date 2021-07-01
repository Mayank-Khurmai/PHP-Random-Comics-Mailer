<?php

    require_once "./database-connection.php";

    class main{
        private $db;
		private $query;
        public function __construct(){

            $otp = random_int(100000, 999999);
            echo $otp;
        }
    }

    new main();

    ?>