<?php

session_start();

include_once __DIR__ . '/api/config/utilities.php';
include_once __DIR__ . '/api/product/read_one.php';
include_once __DIR__ . '/api/cart/create.php';
include_once __DIR__ . '/api/cart/read_one.php';
include_once __DIR__ . '/api/cart/update.php';

$data = array("id" => $_POST["product_id"]);
$data = valid_input($data); //prevents sql injections
$data = json_encode($data);

$product_to_add = read_one_product($data);

//check to see if product already in cart
$data = json_encode(array("user_email" => $_SESSION["email"],
                          "product_id" => $product_to_add["id"])); 

$product_check = read_one_cart($data);

if($product_check){
    //update with quantity+1
    $product_check["quantity"] += 1;
    update(json_encode($product_check));
    echo 2;
}

//elseif product not in cart, add it
else{
    $data = json_encode(array("user_email" => $_SESSION["email"],
                          "product_id" => $product_to_add["id"],
                          "quantity" => 1)); 

    create($data);
}

header("Location: home.php");
exit;

?>
