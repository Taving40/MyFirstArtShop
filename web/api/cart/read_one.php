<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';
  
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if ($data->id)
        $cart->id = $data->id;
    else
        return false;

    $cart->read_one();
    
    if($cart->user_email){

        $cart_arr = array(
            "id" => $cart->id,
            "user_email" => $cart->user_email,
            "product_id" => $cart->product_id,
            "quantity" => $cart->quantity
        );
    
        return $cart_arr;
    }
    
    else{
        return false;
    }
}
?>