<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';
  
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);
    
    $data = json_decode($data);

    if ($data->id)
        $order->id = $data->id;
    else
        return false;

    $order->read_one();
    
    if($order->user_email){

        $order_arr = array(
            "id" => $order->id,
            "user_email" => $order->user_email,
            "status" => $order->status,
            "responsabil_id" => $order->responsabil_id,
            "address" => $order->address,
            "eta" => $order->eta,
            "plata" => $order->plata
        );
    
        //200 OK
        // http_response_code(200);
        // echo json_encode($order_arr);
        return $order_arr;
    }
    
    else{
        //http_response_code(404);
        //echo "order does not exist.";
        //echo json_encode(array("message" => "order does not exist."));
        return false;
    }
}
?>