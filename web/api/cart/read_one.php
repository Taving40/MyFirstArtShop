<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';
  
function read_one_cart($data){

    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if ($data->user_email && $data->product_id){
        $cart->user_email = $data->user_email;
        $cart->product_id = $data->product_id;
    }
    else
        return false;

    $cart->read_one();
    
    if($cart->quantity){

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