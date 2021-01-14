<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order.php';

//receives responsabil_id
function read_all_for_store($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order($db);

    $data = json_decode($data);

    if($data->responsabil_id){
        $order->responsabil_id = $data->responsabil_id;
    }

    $stmt = $order->read_all_for_store();
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
            "responsabil_id" => $responsabil_id
            );
            
            array_push($orders_arr["records"], $order_item);
        }
    
    }
    
    else{

        $orders_arr = array();
        array_push($orders_arr, "no orders found");

    }

    return $orders_arr;

}

?>