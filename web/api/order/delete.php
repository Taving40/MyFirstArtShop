<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';
  
function delete($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);
    
    $data = json_decode($data);
    
    if($data->id)
        $order->id = $data->id;
    
    if($order->delete()){
        return true;
    }
    
    else{
        return false;
    }
}
?>