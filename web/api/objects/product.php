<?php
class Product{
  
    private $conn;
    private $table_name = "products";
  
    public $id;
    public $name;
    //to remove hardcoded 1, get with query from users join stores
    public $store_id = 1;
    public $price;
    public $description;
    public $quantity;
    public $size;
    public $type;
    
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
  
        $query = "SELECT
                    p.id, p.name, p.store_id, p.price, p.description, p.quantity, 
                    p.size, p.type, s.`store_nume`, s.`score`
                FROM
                    `" . $this->table_name . "` p, `stores` s
                WHERE 
                    p.store_id = s.id
                ORDER BY
                    p.id ASC";
      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      
        return $stmt;
    }

    function readOne(){
  
        // query to read single record
        $query = "SELECT
                    p.id, p.name, p.store_id, p.price, p.description, p.quantity, p.size, p.type
                FROM
                    " . $this->table_name . " p
                WHERE p.id = ". $this->id;
      

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        // set values to object properties
        if($row != false){
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->size = $row['size'];
            $this->type = $row['type'];
            $this->store_id = $row['store_id'];
            $this->quantity = $row['quantity'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `name`='". $this->name .
                    "', `store_id`=". $this->store_id .
                    ", `price`=". $this->price .
                    ", `description`='". $this->description .
                    "', `quantity`=". $this->quantity .
                    ", `size`='". $this->size .
                    "', `type`='". $this->type . "'";

        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute())
            return true;

        //echo json_encode(array("message" => $query));

        return false;
    }

    function update(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                `name`='". $this->name .
                    "', `store_id`=". $this->store_id .
                    ", `price`=". $this->price .
                    ", `description`='". $this->description .
                    "', `quantity`=". $this->quantity .
                    ", `size`='". $this->size .
                    "', `type`='". $this->type . "'". "
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