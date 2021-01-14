<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

?>

<?php include_once 'header.php';


//search if user has store
include_once __DIR__ . "/api/user/is_manager.php";
$data = json_encode(valid_input(array("email" => $_SESSION["email"])));

if(!is_manager($data)){ ?>

<h2>You do not currently manage a store, please go to <a href="acc_details.php"> Account Details </a> and press the "Create Store" button if you wish to sell your products. An email will be sent and someone will process your request.</h2>


<?php exit; ?>

<?php }

$data = $_GET;
$data = valid_input($data);


if(isset($data["mode"]) && $data["mode"] == "products"){ 
    //display store products

    ?>

<div class="row">
    <div class="col-sm">
        <table class='table table-striped table-bordered'>
            <tr>
                <td>#</td>
                <td>Store</td>
                <td>Name</td>
                <td>Description</td>
                <td>Type</td>
                <td>Size</td>
                <td>Price</td>
                <td>Stock</td>
                
                <td>Edit Product</td>
                <td>Delete Product</td>
            </tr>


            <?php

            //obtain list of all products store_manager is responsible for

            include_once __DIR__ . "/api/product/read_all_for_store.php";
            include_once __DIR__ . "/api/store/read_all_for_user.php";
        
        
        
            $data = json_encode(array("email" => $_SESSION["email"]));
        
            $stores = read_all_for_user($data);
        
            $ids_to_consider = array();
        
            foreach($stores["records"] as $store){
                array_push($ids_to_consider, $store["id"]);
            }
        
            $products = array();
        
            foreach($ids_to_consider as $store_id){
                $data = json_encode(array("store_id" => $store_id));
        
                $one_store_products = read_all_for_store($data);
        
                if (isset($one_store_products["records"]))
                $products = array_merge($products, $one_store_products["records"]);
            }
            

            //obtain list of store names, to display them as a dropdown

            $store_names = array();

            foreach($products as $product){
                array_push($store_names, $product["store_name"]);
            }

            $store_names = array_unique($store_names);

            ?>







            <tr>
                <form method="POST" action="add_product_to_store.php">
                <td> 
                    
                </td>
                <td>
                    <select name="store_name">
                    <?php 
                        //select all stores affiliated with user and generate a drop down list for them
                        //then check in add_product if user is store_manager for that store
                        foreach($store_names as $store_name){
                            ?>
                            <option value="<?php echo $store_name; ?>"><?php echo $store_name; ?> </option>
                            <?php
                        }
                    ?>
                </td>
                <td>
                    <input type="text" id="name" name="name" required pattern=".*">
                </td>
                <td> 
                    <input type="text" id="description" name="description" required pattern=".*">
                </td>
                <td> 
                <select name="type">
                    <option value="painting"> painting </option>
                    <option value="craft"> craft </option>
                    <option value="sculpture"> sculpture </option>
                </td>
                <td> 
                <select name="size">
                    <option value="small" > small </option>
                    <option value="medium" > medium </option>
                    <option value="large" > large </option>
                </td>
                <td> 
                    <input type="number" id="price" name="price" min="1" required pattern=".*">    
                </td>
                <td> 
                    <input type="number" id="quantity" name="quantity" min="0" required pattern=".*">
                </td>
                <td>
                <button type="submit" class="btn-secondary" name="" value=""> Add Product </button> 
                </td>
                </form>
            </tr>

    <?php

    if(isset($products[0])) 
    foreach($products as $product){ ?>

        <tr>
            <td> <?php echo $product["id"] ?> </td>
            <td> <?php echo $product["store_name"] ?> </td>
            <form method="POST" action="edit_product.php">
            <td> 
                <input type="text" id="name" name="name" value="<?php echo $product["name"] ?>">
            </td>
            
            
            <td> 
                <input type="text" id="description" name="description" value="<?php echo $product["description"] ?>">
            </td>
            <td> 
                <select name="type">
                <option value="painting" <?php if($product["type"] == "painting") echo "selected";?>> painting </option>
                <option value="craft" <?php if($product["type"] == "craft") echo "selected";?>> craft </option>
                <option value="sculpture" <?php if($product["type"] == "sculpture") echo "selected";?>> sculpture </option>
            </td>
            <td> 
                <select name="size">
                <option value="small" <?php if($product["size"] == "small") echo "selected";?>> small </option>
                <option value="medium" <?php if($product["size"] == "medium") echo "selected";?>> medium </option>
                <option value="large" <?php if($product["size"] == "large") echo "selected";?>> large </option>
            </td>
            <td> 
                <input type="number" id="price" name="price" min="1" value="<?php echo $product["price"] ?>">    
            </td>
            <td> 
                <input type="number" id="quantity" name="quantity" min="0" value="<?php echo $product["quantity"] ?>">
            </td>
            <td> 
                <button type="submit" class="btn-secondary" name="product_id" value= <?php echo '"'. $product["id"] .'"' ?>   > Edit Product </button> 
            </td>
            </form>
            <td> 
                <form method="POST" action="delete_product.php">
                <button type="submit" class="btn-secondary" name="product_id" value= <?php echo '"'. $product["id"] .'"' ?>   > Delete Product </button>     
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

elseif (isset($data["mode"]) && $data["mode"] == "orders") {

    include_once __DIR__ . "/api/store/read_all_for_user.php";
        
    $data = json_encode(array("email" => $_SESSION["email"]));

    $stores = read_all_for_user($data);

    $ids_to_consider = array();

    foreach($stores["records"] as $store){
        array_push($ids_to_consider, $store["id"]);
    }


    include_once __DIR__ . "/api/order/read_all_for_store.php";
    
    $orders = array();

    foreach($ids_to_consider as $id){
        $data = json_encode(array("responsabil_id" => $id));

        $data = read_all_for_store($data);

        if(!isset($data[0])){
            $orders = array_merge($orders, $data["records"]);
        }
        
    }

    include_once __DIR__ . "/api/order_items/read_all_for_order.php";
    include_once __DIR__ . "/api/store/read_one.php";
    include_once __DIR__ . "/api/product/read_one.php";
    foreach($orders as $order){

        //select order items associated with current order

        $data = json_encode(array("order_id" => $order["id"]));

        $order_items = read_all_for_order($data);

        $store_name = read_one(json_encode(array("id" => $order["responsabil_id"])))["store_nume"];


        ?>

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order for <?php echo $store_name; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">by <?php echo $order["user_email"]; ?></h6>
            <p class="card-text">Status:  <?php echo $order["status"]; ?></p> 
            <p class="card-text">Order items: </p> 
                <ul>
                    <?php
                        if(!isset($order_items[0]))
                        foreach($order_items["records"] as $item){
                            $product_name = read_one_product(json_encode(array("id" => $item["product_id"])))["name"];

                            ?>
                                <li> <?php echo $product_name . ",  x" .  $item["quantity"];?></li>
                            <?php
                        }
                    ?>
                </ul>
            
            <?php if($order["status"] == "in_transit"){?>
            <div class="btn-group">
            <form method="POST" action="fail_order.php">
            <button type="submit" class="btn-secondary btn-danger" name="order_id" value= <?php echo '"'. $order["id"] .'"' ?>   > Set as failed </button> 
            </form>
            <form method="POST" action="success_order.php">
            <button type="submit" class="btn-secondary btn-success" name="order_id" value= <?php echo '"'. $order["id"] .'"' ?>   > Set as successfully completed </button> 
            </form>
            </div>
            <?php } ?>
        </div>
        </div>

        <?php
    }

    

    
}

elseif($_GET["mode"] == "store_details"){

    //change name form


    //delete form
    ?>
    <!-- Delete store pop-up -->
<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#delete_store">
  Delete Store
</button>

<!-- Modal -->
<div class="modal fade" id="delete_store" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_store_title">Delete Store</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper">
  <form class="form-signin" action="delete_store.php" method="POST">       
      <h2 class="form-signin-heading">Please enter your account information</h2>
      <input type="text" class="form-control" name="name" placeholder="Store name*" required /> 
      <p> *not case sensitive </p>

      <input type="text" class="form-control" name="delete" placeholder="DELETE" required pattern="DELETE"/>  
      <p>Please fill in "DELETE" in the above field if you are sure you'd like to delete your store.</p>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Delete store</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Name change pop-up -->
<button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#change_name">
  Change store name
</button>

<!-- Modal -->
<div class="modal fade" id="change_name" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_name_title">Change store name</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper">
  <form class="form-signin" action="change_store_name.php" method="POST">       
      <h2 class="form-signin-heading">Please enter your account information</h2>
      <input type="text" class="form-control" name="old_name" placeholder="Old name*" required /> 
      <p> *not case sensitive </p>

      <input type="text" class="form-control" name="new_name" placeholder="New name" required /> 

      <button class="btn btn-lg btn-primary btn-block" type="submit">Change store name</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <?php
}

else{

    ?>
    Please choose to view either products or orders from the navbar.
    <?php

}



include_once 'footer.php';?>