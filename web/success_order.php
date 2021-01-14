<?php

include_once __DIR__ . "/api/config/utilities.php";
include_once __DIR__ . "/api/config/mail.php";

session_start();
not_logged_in();

$data = $_POST;

$data = valid_input($data);

include_once __DIR__ . "/api/order/update.php";
include_once __DIR__ . "/api/order/read_one.php";

$data = read_one(json_encode(array("id" => $data["order_id"])));

//check if order is in_transit else exit;
if (!user_has_access_order($_SESSION["email"], $data["id"]) || $data["status"] != "in_transit"){
    header("Location: store_management.php?mode=orders");
    exit;
    // echo 1;
}

$data["status"] = "succesful";

update(json_encode($data));


include_once __DIR__ . "/api/order_items/read_all_for_order.php";
include_once __DIR__ . "/api/product/read_one.php";

$order_items = read_all_for_order(json_encode(array("order_id" => $data["id"])));

$items_string = "\n\n";

foreach($order_items["records"] as $order_item){

    $product = read_one_product(json_encode(array("id" => $order_item["product_id"])));

    $items_string = $items_string . $product["name"] . "  x" . $order_item["quantity"] . "\n\n";

}

mailer($data["user_email"], 'myfirstartshop@gmail.com', "Art Shop", "Order succesfully completed", 
"Your order for the following items has been successfully completed: " . $items_string);

header("Location: store_management.php?mode=orders");
exit;

?>