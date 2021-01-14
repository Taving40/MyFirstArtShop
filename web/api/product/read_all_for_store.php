<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';

//expects store_id

function read_all_for_store($data){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $data = json_decode($data);

    if($data->store_id)
        $product->store_id = $data->store_id;
    else return false;

    $stmt = $product->read_all_for_store();
    $num = $stmt->rowCount();
    if($num>0){
        
        $products_arr = array();

        $products_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $product_item=array( // face array din ele
                "id" => $id,
                "name" => $name,
                "store_id" => $store_id,
                "price" => $price,
                "description" => $description,
                "quantity" => $quantity,
                "size" => $size,
                "type" => $type,
                "store_name" => $store_nume,
                "store_score" => $score
            );
            
            array_push($products_arr["records"], $product_item);
        }
    
    }
    
    else{
        $products_arr = array();
        array_push($products_arr, "error");
    }

    return $products_arr;

}

?>