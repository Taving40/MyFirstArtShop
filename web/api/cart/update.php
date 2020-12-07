<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';

//expects full cart data (updates one product in the cart)
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if(!empty($data->id)){
        $cart->id = $data->id;
        $cart->user_email = $data->user_email;
        $cart->cart_id = $data->cart_id;
        $cart->product_id = $data->product_id;
        $cart->quantity = $data->quantity;
    }

    if($cart->update()){
        return true;
    }
    
    else{
        return false;
    }
}
?>