<?php
class User{
  
    private $conn;
    private $table_name = "users";
  
    public $email;
    public $name;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    function readOne(){
  
        $query = "SELECT
                    u.email, u.name, u.password
                FROM
                    `" . $this->table_name . "` u
                WHERE u.email = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute(array($this->email));
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
        if($row != false){
            $this->email = $row['email'];
            $this->name = $row['name'];
            $this->password = $row['password'];
        }
    }

    function create(){
  
        $query = "INSERT INTO
                    `" . $this->table_name . "`
                SET
                    `name`= ?
                    , `email`= ?
                    , `password`= ?";
                    
        $stmt = $this->conn->prepare($query);
    
        if($stmt->execute(array($this->name,
                                $this->email,
                                $this->password))) {
            return true;
        }

        //echo json_encode(array("message" => $query));

        return false;
    }

    function update_pass(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                `password`= ?
                WHERE
                    `email` = ?";
      
        $stmt = $this->conn->prepare($query);
        
        //echo json_encode(array("message" => $query));

        if($stmt->execute(array($this->password,
                                $this->email,))) {
            return true;
        }

        return false;
    }

    function update_name(){
  
        $query = "UPDATE
                    `" . $this->table_name . "`
                SET
                    `name`= ?
                WHERE
                    `email` = ?";
      
        $stmt = $this->conn->prepare($query);
        
        //echo json_encode(array("message" => $query));

        if($stmt->execute(array($this->name, 
                                $this->email)))
            return true;

        return false;
    }

    function delete(){
  
        $query = "DELETE FROM `" . $this->table_name . "` 
                    WHERE `email` = ?";
    
        $stmt = $this->conn->prepare($query);
      
        if($stmt->execute(array($this->email)))
            return true;

        return false;
    }

    
}
?>