<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';
  
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
  
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->name) && !empty($data->price) && !empty($data->description) && !empty($data->quantity) && !empty($data->size) && !empty($data->type)){

    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->quantity = $data->quantity;
    $product->size = $data->size;
    $product->type = $data->type;
    $product->store_id = $data->store_id;
  
    //creare produs
    if($product->create()){
  
        http_response_code(201);
        //echo "Product was created.";
        echo json_encode(array("message" => "Product was created."));
    }
  
    else{
        //503 - service unavailable
        http_response_code(503);
        // echo "Unable to create product.";
        // echo $product->name;
        // echo '\n';
        // echo $product->price;
        // echo '\n';
        // echo $product->description;
        // echo '\n';
        // echo $product->quantity;
        // echo '\n';
        // echo $product->size;
        // echo '\n';
        // echo $product->type;
        echo json_encode(array("message" => "Unable to create product."));
    }
}
  
else{
  
    //400 bad request
    http_response_code(400);
    //echo "Unable to create product. Data is incomplete.";
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>