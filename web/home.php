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
