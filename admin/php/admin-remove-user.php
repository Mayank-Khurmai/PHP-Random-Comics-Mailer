<?php

require_once "./database-connection.php";

class main
{
    private $db;
    private $query;
    private $id;

    public function __construct()
    {
        if(isset($_POST['id'])){
            $this->id = $_POST["id"];
        }
        else{
            echo "Failed";
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->query = "DELETE FROM user_data WHERE id = '$this->id'";
        if($this->db->query($this->query))
        {
            echo "Success";
            $this->db->close();
        }
        else
        {
            echo "Failed";
            $this->db->close();
        }
    }
}

new main();

?>