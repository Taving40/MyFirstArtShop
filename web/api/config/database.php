<?php
class Database{
  
    //mysql://bd4b968ec139ff:b7014218@us-cdbr-east-02.cleardb.com/heroku_c4c7ba1ff350632?reconnect=true

    private $host = "us-cdbr-east-02.cleardb.com";
    private $db_name = "heroku_c4c7ba1ff350632";
    private $username = "bd4b968ec139ff";
    private $password = "b7014218";
    public $conn;
  
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            //$this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>