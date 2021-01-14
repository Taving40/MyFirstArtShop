<?php

include_once __DIR__ . '/api/config/utilities.php';

$data = $_POST;

$data = valid_input($data);

session_start();
not_logged_in();
if(user_has_access($_SESSION["email"], $data['product_id'])){
    include_once __DIR__ . '/api/product/delete.php';

    $data = json_encode(array("id" => $data['product_id']));

    delete($data);
}



header("Location: store_management.php?mode=products");
exit;


?>