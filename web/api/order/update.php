<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';

//expects full order data
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);
    
    $data = json_decode($data);

    if(!empty($data->id)){

        $order->id = $data->id;
        $order->user_email = $data->user_email;
        $order->status = $data->status;
        $order->address = $data->address;
        $order->eta = $data->eta;
        $order->plata = $data->plata;
    
    }

    if($order->update()){
        return true;
    }
    
    else{
        return false;
    }
}
?>