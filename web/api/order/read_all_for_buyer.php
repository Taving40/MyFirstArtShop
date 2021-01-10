<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';

//receives user_email
function read_all_for_buyer($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);

    if($data){
        $order->user_email = $data;
    }

    $stmt = $order->read_all_for_buyer();
    $num = $stmt->rowCount();

    if($num>0){
        
        $orders_arr = array();

        $orders_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $order_item=array( // face array din ele
            "id" => $id,
            "user_email" => $user_email,
            "status" => $status,
            "address" => $address,
            "eta" => $eta,
            "plata" => $plata
            );
            
            array_push($orders_arr["records"], $order_item);
        }
    
        //http_response_code(200);
        //echo $orders_arr;
        //echo json_encode($orders_arr);
    }
    
    else{
        //http_response_code(404);
        //echo "No orders found.";
        //echo json_encode(
        //    array("message" => "No orders found.")
        //);
        $orders_arr = array();
        array_push($orders_arr, "error");

    }

    return $orders_arr;

}

?>