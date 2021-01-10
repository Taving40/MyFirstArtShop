<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order_items.php';
  
function delete($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $order = new Order_items($db);
    
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