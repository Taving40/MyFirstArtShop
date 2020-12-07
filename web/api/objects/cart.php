<?php
class Cart{
  
    private $conn;
    private $table_name = "carts";
  
    public $id;
    public $cart_id;
    public $user_email;
    public $product_id;
    public $quantity;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read_cart(){
  
        $query = "SELECT 
                    c.id, c.user_email, c.cart_id, c.product_id, c.quantity
                FROM 
                    `" . $this->table_name . "` c
                WHERE c.cart_id = ". $this->cart_id;
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        return $stmt;
    }

    function read_one(){

        $query = "SELECT 
                    c.id, c.user_email, c.product_id, c.quantity
                FROM 
                    `" . $this->table_name . "` c
                WHERE c.id = ". $this->id;
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != false){
            $this->id = $row['id'];
            $this->user_email = $row['user_email'];
            $this->product_id = $row['product_id'];
            $this->quantity = $row['quantity'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `user_email`='". $this->user_email .
                    "', `product_id`=". $this->product_id .
                    ", `cart_id`=". $this->cart_id .
                    ", `quantity`=". $this->quantity;
        $stmt = $this->conn->prepare($query);
        echo $query;
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
                    "', `cart_id`=". $this->cart_id .
                    ", `product_id`=". $this->product_id .
                    ", `quantity`=". $this->quantity . "
                WHERE
                    `id` = ".$this->id;
      
        $stmt = $this->conn->prepare($query);

        if($stmt->execute())
            return true;

        return false;
    }

    function delete_cart(){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `cart_id` = ". $this->cart_id;
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute())
            return true;

        return false;
    }

    function delete_cart_item(){
  
        $query = "DELETE FROM `" . $this->table_name . "` WHERE `id` = ". $this->id;
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute())
            return true;

        return false;
    }

    
}
?>