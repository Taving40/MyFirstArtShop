<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/product.php';

function read(){

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $stmt = $product->read();
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
                "type" => $type
            );
            
            array_push($products_arr["records"], $product_item);
        }
    
        //http_response_code(200);
        //echo $products_arr;
        //echo json_encode($products_arr);
    }
    
    else{
        //http_response_code(404);
        //echo "No products found.";
        //echo json_encode(
        //    array("message" => "No products found.")
        //);
        $products_arr = array();
        array_push($products_arr, "error");

    }

    return $products_arr;

}

?>