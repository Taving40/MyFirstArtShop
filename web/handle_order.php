<?php session_start(); 
include_once __DIR__ . "/api/config/utilities.php";
not_logged_in();?>

<?php


include_once __DIR__ . "/api/cart/update.php";
include_once __DIR__ . "/api/cart/read_cart.php";
include_once __DIR__ . "/api/product/read_one.php";

$data = json_encode(valid_input(array("user_email" => $_SESSION["email"])));

$cart = read_all_cart($data);

$products = array("records" => array());

$order_was_ok = true;

foreach($cart["records"] as $cart_product){
    $data = json_encode(array("id" => $cart_product["product_id"]));
    array_push($products["records"], array(
                                    "product_data" => read_one_product($data),
                                    "cart_data" => $cart_product));
}

foreach($products["records"] as $product){
    if($product["cart_data"]["quantity"] > $product["product_data"]["quantity"]){
        $order_was_ok = false;
        break;
    }
}

$temp_store_id = $products['records'][0]["product_data"]["store_id"];

foreach($products["records"] as $product){
    if($product["product_data"]["store_id"] != $temp_store_id){
        $order_was_ok_one_store = false;
        break;
    }
}

if(!$order_was_ok){ //fix order
    

    foreach($products["records"] as $product){
        if($product["cart_data"]["quantity"] > $product["product_data"]["quantity"]){
            $product["cart_data"]["quantity"] = $product["product_data"]["quantity"];
            $data = json_encode($product["cart_data"]);
            update($data);
        }
    }

    $_SESSION["order_was_ok"] = "neok";
    header("Location: cart_details.php");
    exit;
}

//only items from ONE SHOP may be ordered at one time
elseif(!$order_was_ok_one_store){

    $_SESSION["order_was_ok_one_store"] = "neok";
    $_SESSION['test'] = $temp_store_id;
    header("Location: cart_details.php");
    exit;
}

else{ //process order
    
    include_once __DIR__ . "/api/order_items/create.php";
    include_once __DIR__ . "/api/order/create.php";
    //first create an order 

    $data = json_encode(array("user_email" => $_SESSION['email'],
                              "status" => 'in_transit',
                              "responsabil_id" => $products["records"][0]["product_data"]["store_id"]));

    // $data->user_email = $data->user_email;
    // $data->status = $data->status;
    // $data->responsabil_id = $data->responsabil_id;


    //then create the order items associated to it

    // foreach($products["records"] as $product){
    //     $data = json_encode(array("order_id" => ceva,
    //                               "product_id" => $product["product_data"]["id"],
    //                               "quantity" => $product["cart_data"]["quantity"]));
    //     create_order_item($data);
    // }

    $_SESSION["order_was_ok"] = "ok";
    header("Location: cart_details.php");
    exit;
}

?>