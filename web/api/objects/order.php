<?php
class Order{
  
    private $conn;
    private $table_name = "order";
  
    public $id;
    public $user_email;
    public $status;
    public $responsabil_id;
    public $address;
    public $eta;
    public $plata;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read_all_for_buyer(){
  
        $query = "SELECT
                    o.id, o.user_email, o.status, o.responsabil_id, o.address, o.eta, o.plata
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
                    o.id, o.user_email, o.status, o.responsabil_id, o.address, o.eta, o.plata
                FROM
                    `" . $this->table_name . "` o
                WHERE o.responsabil_id = ?
                ORDER BY
                    o.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($this->responsabil_id));
      
        return $stmt;
    }

    function read_one(){

        $query = "SELECT 
                    o.id, o.user_email, o.status, o.responsabil_id, o.address, o.eta, o.plata
                FROM 
                    `" . $this->table_name . "` o
                WHERE o.id = ?";
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->id));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){
            //echo $row['user_email'];
            //echo 0;
            $this->id = $row['id'];
            $this->user_email = $row['user_email'];
            $this->status = $row['status'];
            $this->responsabil_id = $row['responsabil_id'];
            $this->address = $row['address'];
            $this->eta = $row['eta'];
            $this->plata = $row['plata'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `user_email`= ?
                    , `status`= ?
                    , `responsabil_id`= ?
                    , `address`= ?
                    , `eta`= ?
                    , `plata`= ?";
        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute(array($this->user_email,
                                $this->status,
                                $this->responsabil_id,
                                $this->address,
                                $this->eta,
                                $this->plata))){
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
                    , `address`= ?
                    , `eta`= ?
                    , `plata`= ?
                WHERE
                    `id` = ?";
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array($this->user_email,
                                $this->status,
                                $this->responsabil_id,
                                $this->address,
                                $this->eta,
                                $this->plata,
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

    
}
?>