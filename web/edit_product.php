<?php

include_once __DIR__ . '/api/config/utilities.php';

//retrieve information about product
$data = $_POST;
$data = valid_input($data);

session_start();
not_logged_in();
if(user_has_access($_SESSION["email"], $data['product_id'])){
    include_once __DIR__ . '/api/product/update.php';
    include_once __DIR__ . '/api/product/read_one.php';

    //encode it into json
    $pre_update_prod_data = read_one_product(json_encode(array("id" => $data["product_id"])));

    $data["store_id"] = $pre_update_prod_data["store_id"];
    $data["id"] = $data["product_id"];
    //$data["name"] = $pre_update_prod_data["name"];

    $data = json_encode($data);

    print_r($data);

    //update product
    update_product($data);
}

header("Location: store_management.php?mode=products");
exit;


?>