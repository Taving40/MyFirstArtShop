<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';
  
function read_last($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);
    
    $data = json_decode($data);

    if ($data->user_email)
        $order->user_email = $data->user_email;
    else
        return false;

    $order->read_last();
    
    if($order->user_email){

        $order_arr = array(
            "id" => $order->id,
            "user_email" => $order->user_email,
            "status" => $order->status,
            "responsabil_id" => $order->responsabil_id
        );
    

        return $order_arr;
    }
    
    else{

        return false;
    }
}
?>