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
                WHERE o.user_email = '" .$this->user_email. "'
                ORDER BY
                    o.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        return $stmt;
    }

    function read_all_for_store(){
  
        $query = "SELECT
                    o.id, o.user_email, o.status, o.responsabil_id, o.address, o.eta, o.plata
                FROM
                    `" . $this->table_name . "` o
                WHERE o.responsabil_id = " .$this->responsabil_id. "
                ORDER BY
                    o.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        return $stmt;
    }

    function read_one(){

        $query = "SELECT 
                    o.id, o.user_email, o.status, o.responsabil_id, o.address, o.eta, o.plata
                FROM 
                    `" . $this->table_name . "` o
                WHERE o.id = ". $this->id;
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
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
                    `user_email`='". $this->user_email .
                    "', `status`='". $this->status .
                    "', `responsabil_id`=". $this->responsabil_id .
                    ", `address`='". $this->address .
                    "', `eta`='". $this->eta .
                    "', `plata`='". $this->plata . "'";
        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute()){
            return true;
        }
            
        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                `user_email`='". $this->user_email .
                    "', `status`='". $this->status .
                    "', `responsabil_id`=". $this->responsabil_id .
                    ", `address`='". $this->address .
                    "', `eta`='". $this->eta .
                    "', `plata`='". $this->plata . "'" . "
                WHERE
                    `id` = ".$this->id;
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute())
            return true;

        return false;
    }

    function delete(){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `id` = ". $this->id;
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute())
            return true;

        return false;
    }

    
}
?>