<?php session_start(); 

if (!isset($_SESSION["login"]) || $_SESSION["login"] == "failed") {
    ?>
    <alert class="alert">
    <?php
    echo "Please log in first or register an account!!";
    ?>
    </alert>
    <?php
    exit;
}

?>

<?php include_once 'header.php'; ?>

<div class="container mt-5">    
<h2> Available Products </h2> 
<div class="row">
    <div class="col-sm">
        <table class='table table-striped table-bordered'>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Description</td>
                <td>Type</td>
                <td>Price</td>
                <td>Store</td>
                <td>Store Score</td>
                <td>Add to cart</td>
            </tr>


<?php

include_once __DIR__ . '/api/product/read.php';

$products = read();

if (!array_key_exists("error", $products)){ 

    foreach($products["records"] as $product){ ?>

        <tr>
            <td> <?php echo $product["id"] ?> </td>
            <td> <?php echo $product["name"] ?> </td>
            <td> <?php echo $product["description"] ?> </td>
            <td> <?php echo $product["type"] ?> </td>
            <td> <?php echo $product["price"] ?> </td>
            <td> <?php echo $product["store_name"] ?> </td>
            <td> <?php echo $product["store_score"] ?> </td>
            <td> 
                <form method="POST" action="add_product_to_cart.php">
                <button type="submit" class="btn-default" name="product_id" value= <?php echo '"'. $product["id"] .'"' ?>   > Add to cart </button> 
                </form>
            </td>
        </tr>
        
    <?php
    }
    ?>

    </table>
    </div>
    </div>

    <?php
}



else { ?>
    
   <h3> No products found. </h3>

<?php } 


include_once 'footer.php'; ?>
