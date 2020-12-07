<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/cart.php';

//receives cart_id
function read_cart($data){

    $database = new Database();
    $db = $database->getConnection();
    $cart = new Cart($db);

    if($data){
        $cart->cart_id = $data;
    }

    $stmt = $cart->read_cart();
    $num = $stmt->rowCount();
    if($num>0){
        
        $carts_arr = array();

        $carts_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $cart_item=array( // face array din ele
            "id" => $id,
            "user_email" => $user_email,
            "cart_id" => $cart_id,
            "product_id" => $product_id,
            "quantity" => $quantity
            );
            
            array_push($carts_arr["records"], $cart_item);
        }
    
    }
    
    else{
        $carts_arr = array();
        array_push($carts_arr, "error");
    }

    return $carts_arr;

}

?>