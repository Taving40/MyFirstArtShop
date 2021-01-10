<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

echo $_SESSION['test'];

?>

<?php include_once 'header.php'; ?>

<h2 class="text-center bg-light"> Your cart contains the following items: </h2>


<div class="row">
    <div class="col-sm">
        <table class='table table-striped table-bordered'>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Description</td>
                <td>Type</td>
                <td>Price</td>
                <td>Stock</td>
                <td>In cart</td>
                <td>Remove one</td>
                <td>Remove all</td>
            </tr>

<?php

include_once __DIR__ . "/api/cart/delete_cart_item.php";
include_once __DIR__ . "/api/cart/delete_cart.php";
include_once __DIR__ . "/api/cart/update.php";
include_once __DIR__ . "/api/cart/read_cart.php";
include_once __DIR__ . "/api/product/read_one.php";

$data = json_encode(valid_input(array("user_email" => $_SESSION["email"])));
$cart_products = read_all_cart($data);

// echo "<pre>";

// print_r($cart_products);

// echo "</pre>";

if(isset($cart_products["records"])){

    $products = array("records" => array());

    foreach($cart_products["records"] as $cart_product){
        $data = json_encode(array("id" => $cart_product["product_id"]));
        array_push($products["records"], array(
                                        "product_data" => read_one_product($data),
                                        "cart_data" => $cart_product));
    }

    foreach($products["records"] as $product){ ?>

        <tr>
            <td> <?php echo $product["product_data"]["id"] ?> </td>
            <td> <a href= <?php echo "show_product.php?id=" . $product["product_data"]["id"] ?> >  <?php echo $product["product_data"]["name"] ?> </a> </td>
            <td> <?php echo $product["product_data"]["description"] ?> </td>
            <td> <?php echo $product["product_data"]["type"] ?> </td>
            <td> <?php echo $product["product_data"]["price"] ?> </td>
            <td> <?php echo $product["product_data"]["quantity"] ?> </td>
            <td> <?php echo $product["cart_data"]["quantity"] ?> </td>
            <td> 
                <form method="POST" action="remove_one_product.php">
                <button type="submit" class="btn-secondary" name="id" value= <?php echo '"'. $product["product_data"]["id"] .'"' ?>   > Remove one </button> 
                </form>
            </td>
            <td> 
                <form method="POST" action="remove_all_product.php">
                <button type="submit" class="btn-secondary" name="id" value= <?php echo '"'. $product["product_data"]["id"] .'"' ?>   > Remove all </button> 
                </form>
            </td>
        </tr>
        
    <?php
    }
}
?>

</table>
</div>
</div>

<?php 

if (isset($_SESSION["order_was_ok"]) && $_SESSION["order_was_ok"] != "ok"){?>

<div class="alert alert-dark alert-warning alert-dismissible fade show" role="alert">
  We have removed items from your cart so that your order may match store stock, please re-read through your order and if you are happy with it, press "Place order" once again. Thank you.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php }

if (isset($_SESSION["order_was_ok"]) && $_SESSION["order_was_ok"] == "ok"){?>

    <div class="alert alert-dark alert-warning alert-dismissible fade show" role="alert">
     Your order was proccesed and the store manager has been notified.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    
<?php }

if (isset($_SESSION["order_was_ok_one_store"]) && $_SESSION["order_was_ok_one_store"] == "neok"){?>

    <div class="alert alert-dark alert-warning alert-dismissible fade show" role="alert">
     Your order may only contain items from a single store, as that store will also be responsible for the delivery. Please remove the items from your cart that belong to other stores and order them separately.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    
<?php }

unset($_SESSION["order_was_ok_one_store"]); 
unset($_SESSION["order_was_ok"]); 
unset($_SESSION["order_is_ok"]);

?>

<form method="POST" action="handle_order.php">
    <button type="submit" class="btn-secondary btn-block"> Place Order </button> 
</form>








<?php include_once 'footer.php'; ?>