<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/order_items.php';

//receives order_id
function read_all_for_order($data){

    $database = new Database();
    $db = $database->getConnection();
    $order = new Order_items($db);

    $data = json_decode($data);

    if($data->order_id){
        $order->order_id = $data;
    }

    $stmt = $order->read_all_for_order();
    $num = $stmt->rowCount();

    if($num>0){
        
        $orders_arr = array();

        $orders_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $order_item=array( // face array din ele
            "id" => $id,
            "order_id" => $order_id,
            "product_id" => $product_id,
            "quantity" => $quantity
            );
            
            array_push($orders_arr["records"], $order_item);
        }
    

    }
    
    else{

        $orders_arr = array();
        array_push($orders_arr, "error");

    }

    return $orders_arr;

}

?>