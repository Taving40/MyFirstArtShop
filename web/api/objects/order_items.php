<?php
class Order_items{
  
    private $conn;
    private $table_name = "order_items";
  
    public $id;
    public $product_id;
    public $order_id;
    public $quantity;

    
    public function __construct($db){
        $this->conn = $db;
    }

    function read_all_for_order(){
  
        $query = "SELECT
                    *
                FROM
                    `" . $this->table_name . "` oi
                WHERE oi.order_id = ?
                ORDER BY
                    oi.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array( $this->order_id));
      
        return $stmt;
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `order_id`= ?
                    , `product_id`= ?
                    , `quantity`= ?";

        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute(array($this->order_id,
                                $this->product_id,
                                $this->quantity))){
            return true;
        }
            
        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                    `order_id`= ?
                    , `product_id`= ?
                    , `quantity`= ?
                WHERE
                    `id` = ?";
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute(array($this->order_id,
                                $this->product_id,
                                $this->quantity,
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

    function delete_all_for_order(){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `order_id` = ?";
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute(array($this->order_id)))
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