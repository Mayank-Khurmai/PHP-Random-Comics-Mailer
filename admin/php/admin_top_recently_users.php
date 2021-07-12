<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $response;
    private $top_users=[];
    private $recently_added=[];
    private $all_data=[];
    public function __construct()
    {
        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "SELECT * FROM user_data ORDER BY count DESC LIMIT 5";
        $this->response = $this->db->query($this->query);
        if ($this->response->num_rows != 0) {
            while($this->data = $this->response->fetch_assoc()){
                array_push($this->top_users,$this->data);
            }
            array_push($this->all_data,$this->top_users);
            $this->query = "SELECT * FROM user_data ORDER BY date DESC LIMIT 5";
            $this->response = $this->db->query($this->query);
            if ($this->response->num_rows != 0) {
                while($this->data = $this->response->fetch_assoc()){
                    array_push($this->recently_added,$this->data);
                }
                array_push($this->all_data,$this->recently_added);
                echo json_encode($this->all_data);
            }
            else{
                echo json_encode($this->all_data);
            }
            $this->db->close();
        }
        else{
            echo json_encode($this->all_data);
            $this->db->close();
        }
    }
}

new main();

?>