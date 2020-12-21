<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

?>

<?php include_once 'header.php'; ?>

<div class="container mt-5">    
<h2> Available Products </h2> 
<hr>
<h4> Filter products: </h2>
<br>

<form method="POST" action="home.php">
<div class="btn-group">
<button type="submit" class="btn-default" name="filter" value="name"> Alphabetical </button> 
<button type="submit" class="btn-default" name="filter" value="price"> Least to most expensive </button> 
<button type="submit" class="btn-default" name="filter" value="rev_price"> Most to least expensive </button> 
<button type="submit" class="btn-default" name="filter" value="type"> Product types </button> 
<button type="submit" class="btn-default" name="filter" value="quantity">Least to most available </button>
<button type="submit" class="btn-default" name="filter" value="rev_quantity"> Most to least available </button> 
<button type="submit" class="btn-default" name="filter" value="store_score"> Store reputability </button> 
</div>
</form>


<hr>

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
                <td>Store</td>
                <td>Store Score</td>
                <td>Add to cart</td>
            </tr>


<?php

include_once __DIR__ . '/api/product/read.php';

$products = read();

if (!array_key_exists("error", $products)){ 

    $sorter = new Nested_arr_uasort();
    $sorter->arr_of_arrs = $products["records"];
    if(isset($_POST["filter"])){
        $data = $_POST;
        $data = valid_input($data);
        $sorter->inner_arr_field = $data["filter"];
    }
        
    else
        $sorter->inner_arr_field = "name";
    $products = $sorter->get_sorted_arr();

    foreach($products as $product){ ?>

        <tr>
            <td> <?php echo $product["id"] ?> </td>
            <td> <a href= <?php echo "show_product.php?id=" . $product["id"] ?> >  <?php echo $product["name"] ?> </a> </td>
            <td> <?php echo $product["description"] ?> </td>
            <td> <?php echo $product["type"] ?> </td>
            <td> <?php echo $product["price"] ?> </td>
            <td> <?php echo $product["quantity"] ?> </td>
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
