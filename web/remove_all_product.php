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

if($product_check != false){
    $data = json_encode(array("id" => $product_check["id"]));
    $check = delete_cart_item($data);
}

header("Location: cart_details.php");
exit;

?>