<?php

session_start();
if(!isset($_SESSION['xkcd_admin']))
{
    header('Location: ../');
    exit();
}

require_once __DIR__.'/database-connection.php';

class remove_user
{
    private $db;
    private $query;
    private $id;

    public function __construct()
    {
        if(isset($_POST['id'])){
            $this->id = $_POST['id'];
        }
        else{
            echo 'Failed';
            exit();
        }

        $this->db = new db();
        $this->db = $this->db->database();
        $this->id = trim($this->id);
        $this->id = htmlspecialchars($this->id,ENT_QUOTES);
        $this->id = mysqli_real_escape_string($this->db,$this->id);
        $this->query = $this->db->prepare('DELETE FROM user_data WHERE id=?');
        $this->query->bind_param('i',$this->id);
        $this->query->execute();
        if($this->query->affected_rows!=0){
            echo 'Success';
        }
        else{
            echo 'Failed';
        }
        $this->db->close();
    }

    public function __destruct()
    {
        unset($this->db);
        unset($this->query);
        unset($this->id);
    }
}

new remove_user();

?>