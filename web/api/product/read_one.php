<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';
  
function read_one_product($data){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    
    $data = json_decode($data);

    if ($data->id)
        $product->id = $data->id;
    else
        return false;
    $temp_arr = $product->readOne();
    
    if($product->name){

        $product_arr = array(
            "id" => $product->id,
            "name" => $product->name,
            "store_id" => $product->store_id,
            "price" => $product->price,
            "description" => $product->description,
            "quantity" => $product->quantity,
            "size" => $product->size,
            "type" => $product->type,
            "store_name" => $temp_arr["store_name"],
            "store_score" => $temp_arr["score"]
        );
    
        return $product_arr;
    }
    
    else{

        return false;
    }
}
?>