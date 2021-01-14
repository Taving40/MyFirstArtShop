<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";
not_logged_in();

include_once 'header.php'; 

include_once __DIR__ . "/api/config/utilities.php";
include_once __DIR__ . "/api/product/read_one.php";

$data = $_GET;
$data = valid_input($data);
$data = json_encode($data);

$product = read_one_product($data);

// foreach($product as $field){
//     echo $field, "<br>";
// }

?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title"> <?php echo $product["name"] ?> </h5>
    <p class="card-text"> <?php echo $product["description"] ?> </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"> In-stock quantity: <?php echo $product["quantity"];?> </li>
    <li class="list-group-item">This <?php echo $product["type"]?> is: <?php echo $product["size"];?></li>
    <li class="list-group-item">Product sold by: <?php echo $product["store_name"];?></li>
    <li class="list-group-item">With a reputability of <?php echo $product["store_score"];?> stars</li>
  </ul>
  <div class="card-body">
    <form method="POST" action="add_product_to_cart.php">

    <?php if($product["quantity"] > 0) { ?>
      <button type="submit" class="btn-secondary" name="product_id" value= <?php echo '"'. $product["id"] .'"' ?>   > Add to cart </button> 
    <?php } ?>

  </form>
  </div>
</div>
<?php include_once "footer.php"; ?>