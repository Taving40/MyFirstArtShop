<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order_items.php';

//expects full order_item data
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order_items($db);
    
    $data = json_decode($data);

    if(!empty($data->id)){

        $order->order_id = $data->order_id;
        $order->product_id = $data->product_id;
        $order->quantity = $data->quantity;
    
    }

    if($order->update()){
        return true;
    }
    
    else{
        return false;
    }
}
?>