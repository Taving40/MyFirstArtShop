<?php session_start(); 
include_once __DIR__ . "/api/config/utilities.php";
not_logged_in();?>

<?php

//change if statements and add a order_was_ok and order_is_ok field to session


include_once __DIR__ . "/api/cart/update.php";
include_once __DIR__ . "/api/cart/read_cart.php";
include_once __DIR__ . "/api/product/read_one.php";

$data = json_encode(valid_input(array("user_email" => $_SESSION["email"])));

$cart = read_all_cart($data);

$products = array("records" => array());

$order_was_ok = true;

foreach($cart["records"] as $cart_product){
    $data = json_encode(array("id" => $cart_product["product_id"]));
    array_push($products["records"], array(
                                    "product_data" => read_one_product($data),
                                    "cart_data" => $cart_product));
}

foreach($products["records"] as $product){
    if($product["cart_data"]["quantity"] > $product["product_data"]["quantity"]){
        $order_was_ok = false;
        break;
    }
}

if(!$order_was_ok){ //fix order


    foreach($products["records"] as $product){
        if($product["cart_data"]["quantity"] > $product["product_data"]["quantity"]){
            $product["cart_data"]["quantity"] = $product["product_data"]["quantity"];
            $data = json_encode($product["cart_data"]);
            update($data);
        }
    }

    $_SESSION["order_was_ok"] = "neok";
    header("Location: cart_details.php");
    exit;
}

else{ //process order
    
    $_SESSION["order_was_ok"] = "ok";
    header("Location: cart_details.php");
    exit;
}

?>