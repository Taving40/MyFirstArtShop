<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';


function create($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);
    
    $data = json_decode($data);

    if(!empty($data->user_email)){

        $order->user_email = $data->user_email;
        $order->status = $data->status;
        $order->responsabil_id = $data->responsabil_id;
        $order->address = $data->address;
        $order->eta = $data->eta;
        $order->plata = $data->plata;

        if($order->create()){
            return true;
        }
    
        else{
            return false;
        }
    }
    
    else{
        return false;
    }

}

?>