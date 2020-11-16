<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/product.php';
  
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
  
    // afisare pe site
    http_response_code(200);
    //echo $products_arr;
    echo json_encode($products_arr);
}
  
else{
    http_response_code(404);
    //echo "No products found.";
    echo json_encode(
        array("message" => "No products found.")
    );
}