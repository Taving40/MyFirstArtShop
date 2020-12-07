<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';
//receives "id" (of cart_item basically)
function delete_cart_item($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);
    
    $data = json_decode($data);
    
    if($data->id)
        $cart->id = $data->id;
    
    if($cart->delete_cart_item()){
        return true;
    }
    
    else{
        return false;
    }
}
?>