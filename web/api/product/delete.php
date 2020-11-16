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
  
if($data->id)
    $product->id = $data->id;
  
if($product->delete()){
  
    //200 ok
    http_response_code(200);
    //echo "Product was deleted.";
    echo json_encode(array("message" => "Product was deleted."));
}
  
else{
  
    //503 service unavailable
    http_response_code(503);
    // echo "Unable to delete product.";
    echo json_encode(array("message" => "Unable to delete product."));
}
?>