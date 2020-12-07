<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';


function create($data){

    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if(!empty($data->user_email)){

        $cart->cart_id = $data->cart_id;
        $cart->user_email = $data->user_email;
        $cart->product_id = $data->product_id;
        $cart->quantity = $data->quantity;

        if($cart->create()){
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