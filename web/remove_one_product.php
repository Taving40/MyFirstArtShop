<?php

session_start();

include_once __DIR__ . '/api/config/utilities.php';
include_once __DIR__ . '/api/cart/create.php';
include_once __DIR__ . '/api/cart/read_one.php';
include_once __DIR__ . '/api/cart/update.php';
include_once __DIR__ . '/api/cart/delete_cart_item.php';

$temp = array("id" => $_POST["id"]);
$temp = valid_input($temp); 

$data = json_encode(array("user_email" => $_SESSION["email"],
                          "product_id" => $temp["id"])); 

$product_check = read_one_cart($data);

//print_r($product_check);
if($product_check != false){
    if($product_check["quantity"] == 1){
        $data = json_encode(array("id" => $product_check["id"]));
        $check = delete_cart_item($data);
    }
    elseif($product_check["quantity"] > 1){
        $data = $product_check;
        $data["quantity"] -= 1;
        $check = update(json_encode($data));
    }
}


header("Location: cart_details.php");
exit;

?>