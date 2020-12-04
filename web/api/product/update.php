<?php


include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';

//expects full product data
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    

    $data = json_decode($data);

    //set values
    if(!empty($data->id)){

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
        //http_response_code(200);
        //echo "Product was updated.";
        //echo json_encode(array("message" => "Product was updated."));
        return false;
    }
    
    // if unable to update the product, tell the user
    else{
        //503 service unavailable
        //http_response_code(503);
        //echo "Unable to update product.";
        //echo json_encode(array("message" => "Unable to update product."));
        return true;
    }
}
?>