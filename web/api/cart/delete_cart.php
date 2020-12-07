<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';
//receives cart_id
function delete_cart($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if($data->cart_id)
        $cart->cart_id = $data->cart_id;
    
    if($cart->delete_cart()){
        return true;
    }
    
    else{
        return false;
    }
}
?>