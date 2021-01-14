<?php

include_once __DIR__ . "/api/config/utilities.php";

session_start();
not_logged_in();


$data = $_POST;

$data = valid_input($data);

include_once __DIR__ . "/api/store/read_for_name.php";

$store_data = json_encode(array("name" => $data["store_name"]));

$store_data = read_for_name($store_data);

echo gettype($store_data);

if($store_data["admin_email"] != $_SESSION["email"]){

    header("Location: store_management.php");
    exit;
}

$data["store_id"] = $store_data["id"];

include_once __DIR__ . "/api/product/create.php";

$data = json_encode($data);
create_product($data);

header("Location: store_management.php");
exit;



?>