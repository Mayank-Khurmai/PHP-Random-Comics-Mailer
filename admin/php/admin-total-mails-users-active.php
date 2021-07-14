<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header("Location: http://localhost/php-Mayank-Khurmai/admin/");
    exit();
}


require_once __DIR__."/database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $all_data = [];
    public function __construct()
    {
        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT SUM(count) AS sum, COUNT(id) AS count FROM user_data";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            while($this->data = $this->response->fetch_assoc()){
                array_push($this->all_data,$this->data);
            }
            $this->query = "SELECT COUNT(otp) AS active FROM user_data WHERE otp=1";
            $this->response = $this->db->query($this->query);
            if ($this->response->num_rows != 0) {
                while($this->data = $this->response->fetch_assoc()){
                    array_push($this->all_data,$this->data);
                }
                echo json_encode($this->all_data);
            }
            else{
                echo json_encode($this->all_data);
            }
        }
        else{
            echo json_encode($this->all_data);
        }
        $this->db->close();
    }
}

new main();

?>