<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';
//receives user_email
function delete_cart($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);

    if($data->user_email)
        $cart->user_email = $data->user_email;
    
    if($cart->delete_cart()){
        return true;
    }
    
    else{
        return false;
    }
}
?>