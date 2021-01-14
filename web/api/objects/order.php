<?php
class Order{
  
    private $conn;
    private $table_name = "order";
  
    public $id;
    public $user_email;
    public $status;
    public $responsabil_id;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read_all_for_buyer(){
  
        $query = "SELECT
                    *
                FROM
                    `" . $this->table_name . "` o
                WHERE o.user_email = ?
                ORDER BY
                    o.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array( $this->user_email));
      
        return $stmt;
    }

    function read_all_for_store(){
  
        $query = "SELECT
                    *
                FROM
                    `" . $this->table_name . "` o
                WHERE o.responsabil_id = ?
                ORDER BY
                    o.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($this->responsabil_id));
      
        return $stmt;
    }

    function read_last(){

        $query = "SELECT 
                    *
                FROM 
                    `" . $this->table_name . "` o
                WHERE o.id = (select max(id) from `order`)
                AND o.user_email = ?";
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->user_email));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){
            //echo $row['user_email'];
            //echo 0;
            $this->id = $row['id'];
            $this->user_email = $row['user_email'];
            $this->status = $row['status'];
            $this->responsabil_id = $row['responsabil_id'];

        }
    }

    function read_one(){

        $query = "SELECT 
                    *
                FROM 
                    `" . $this->table_name . "` o
                WHERE o.id = ?";
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->id));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){

            $this->id = $row['id'];
            $this->user_email = $row['user_email'];
            $this->status = $row['status'];
            $this->responsabil_id = $row['responsabil_id'];

        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `user_email`= ?
                    , `status`= ?
                    , `responsabil_id`= ?";
        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute(array($this->user_email,
                                $this->status,
                                $this->responsabil_id))){
            return true;
        }
            
        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                    `user_email`= ?
                    , `status`= ?
                    , `responsabil_id`= ?
                WHERE
                    `id` = ?";
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array($this->user_email,
                                $this->status,
                                $this->responsabil_id,
                                $this->id)))
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

    function delete_all_for_store($store_id){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `store_id` = ?";
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute(array($store_id)))
            return true;

        return false;
    }

    
}
?>