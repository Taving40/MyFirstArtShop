<?php


include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';

//expects full product data
function update_product($data){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    

    $data = json_decode($data);

    //set values
    if(!empty($data->id)){

        $product->id = $data->id;
        $product->name = $data->name;
        $product->store_id = $data->store_id;
        $product->price = $data->price;
        $product->description = $data->description;
        $product->quantity = $data->quantity;
        $product->size = $data->size;
        $product->type = $data->type;
    
    }

    if($product->update()){

        return true;
    }

    else{

        return false;
    }
}
?>