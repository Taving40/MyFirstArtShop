<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/product.php';
  

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
  
if ($_GET['id'])
    $product->id = $_GET['id'];
else
    die();
$product->readOne();
  
if($product->name){

    $product_arr = array(
        "id" => $product->id,
        "name" => $product->name,
        "store_id" => $product->store_id,
        "price" => $product->price,
        "description" => $product->description,
        "quantity" => $product->quantity,
        "size" => $product->size,
        "type" => $product->type
    );
  
    //200 OK
    http_response_code(200);
    echo json_encode($product_arr);
}
  
else{
    http_response_code(404);
    //echo "Product does not exist.";
    echo json_encode(array("message" => "Product does not exist."));
}
?>