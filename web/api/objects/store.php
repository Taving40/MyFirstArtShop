<?php
class Store{
  
    private $conn;
    private $table_name = "stores";
  
    public $id;
    public $admin_email;
    public $store_nume;
    public $score;
    public $nr_tranzactii;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
  
        $query = "SELECT 
                    s.id, s.admin_email, s.store_nume, s.score, s.nr_tranzactii
                FROM 
                    `" . $this->table_name . "` s
                ORDER by s.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        return $stmt;
    }

    function read_one(){

        $query = "SELECT 
                    s.id, s.admin_email, s.store_nume, s.score, s.nr_tranzactii
                FROM 
                    `" . $this->table_name . "` s
                WHERE s.id = ?";
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->id));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){
            $this->id = $row['id'];
            $this->admin_email = $row['admin_email'];
            $this->store_nume = $row['store_nume'];
            $this->score = $row['score'];
            $this->nr_tranzactii = $row['nr_tranzactii'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `admin_email`= ?
                    , `store_nume`= ?
                    , `score`= ?
                    , `nr_tranzactii`= ?";

        $stmt = $this->conn->prepare($query);
        echo $query;
        if($stmt->execute(array($this->admin_email,
                                $this->store_nume,
                                $this->score,
                                $this->nr_tranzactii))){
            return true;
        }
        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                    `admin_email`= ?
                    , `store_nume`= ?
                    , `score`= ?
                    , `nr_tranzactii`= ?
                WHERE
                    `id` = ?";
      
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array($this->admin_email,
                                $this->store_nume,
                                $this->score,
                                $this->nr_tranzactii,
                                $this->id))){
            return true;
        }

        return false;
    }

    function delete(){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `id` = ?";
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute(array($this->id)))
            return true;

        return false;
    }
    
}
?>