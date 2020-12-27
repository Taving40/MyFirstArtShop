<?php
class Review{
  
    private $conn;
    private $table_name = "reviews";
  
    public $id;
    public $score;
    public $user_email;
    public $store_id;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read_one_store(){
  
        $query = "SELECT 
                    r.id, r.user_email, r.score, r.store_id
                FROM 
                    `" . $this->table_name . "` r
                WHERE r.store_id = ?";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($this->store_id));
      
        return $stmt;
    }

    function read_one(){

        $query = "SELECT 
                    r.id, r.user_email, r.score, r.store_id
                FROM 
                    `" . $this->table_name . "` r
                WHERE r.id = ?";
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->id));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){
            $this->id = $row['id'];
            $this->user_email = $row['user_email'];
            $this->score = $row['score'];
            $this->store_id = $row['store_id'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `user_email`= ?
                    , `score`= ?
                    , `store_id`=?";

        $stmt = $this->conn->prepare($query);
        //echo $query;
        if($stmt->execute(array($this->user_email,
                                $this->score,
                                $this->store_id))){
            return true;
        }
            
        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                    `user_email`= ?
                    , `store_id`= ?
                    , `score`= ?
                WHERE
                    `id` = ?";
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array($this->user_email,
                                $this->score,
                                $this->store_id,
                                $this->id)))
            return true;

        return false;
    }

    function delete_all_from_store(){
  
        $query = "DELETE FROM `" . $this->table_name . 
        "` WHERE `store_id` = ?";
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute(array($this->store_id)))
            return true;

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