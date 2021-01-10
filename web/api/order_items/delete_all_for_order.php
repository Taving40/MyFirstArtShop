<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order_items.php';
  
function delete_all_for_order($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $order = new Order_items($db);
    
    $data = json_decode($data);
    
    if($data->order_id)
        $order->order_id = $data->order_id;
    
    if($order->delete_all_for_order()){
        return true;
    }
    
    else{
        return false;
    }
}
?>