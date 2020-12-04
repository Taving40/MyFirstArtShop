<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';
  
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    
    if ($data['id'])
        $product->id = $data['id'];
    else
        return false;
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
        // http_response_code(200);
        // echo json_encode($product_arr);
        return $product_arr;
    }
    
    else{
        //http_response_code(404);
        //echo "Product does not exist.";
        //echo json_encode(array("message" => "Product does not exist."));

        return false;
    }
}
?>