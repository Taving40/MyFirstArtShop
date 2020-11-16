<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
  

$data = json_decode(file_get_contents("php://input"));

//set values
if(!empty($data->name) && !empty($data->price) && !empty($data->description) && !empty($data->quantity) && !empty($data->size) && !empty($data->type)){

    $product->id = $data->id;
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->quantity = $data->quantity;
    $product->size = $data->size;
    $product->type = $data->type;
  
}

if($product->update()){
    //200 ok
    http_response_code(200);
    //echo "Product was updated.";
    echo json_encode(array("message" => "Product was updated."));
}
  
// if unable to update the product, tell the user
else{
    //503 service unavailable
    http_response_code(503);
    //echo "Unable to update product.";
    echo json_encode(array("message" => "Unable to update product."));
}
?>