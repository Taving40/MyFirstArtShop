<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

?>

<?php include_once 'header.php';?>

<div class="card" >
  <div class="card-body">
    <h5 class="card-title">Hello, <?php echo $_SESSION["name"]; ?></h5>
    <p class="card-text">Here is your account information:</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Email: <?php echo $_SESSION["email"]; ?></li>
    <li class="list-group-item">Name: <?php echo $_SESSION["name"]; ?></li>
  </ul>
  <div class="card-body">



<!-- Name change pop-up -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_name">
  Change name
</button>

<!-- Modal -->
<div class="modal fade" id="change_name" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_name_title">Change your name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper">
  <form class="form-signin" action="change_name.php" method="POST">       
      <h4 class="form-signin-heading">Please enter your password and the name you wish to change to.</h4>
      <br>
      <input type="password" class="form-control" name="password" placeholder="Password" required />   
      <br>
      <input type="text" class="form-control" name="new_name" placeholder="New name" required />  
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change name</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





    <!-- Password change pop-up -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_password">
  Change password
</button>

<!-- Modal -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_password_title">Change your password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper"> 
  <form class="form-signin" action="change_password.php" method="POST">       
      <h4 class="form-signin-heading">Please enter both your old and new password.</h4>
      <br>
      <input type="password" class="form-control" name="old_password" placeholder="Old password" required />   
      <br>
      <input type="password" class="form-control" name="new_password" placeholder="New password" required />  
      <!--pattern="^[a-zA-Z0-9]{8,10}$" put this for type="password"--> 
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change password</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Delete acc pop-up -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete_acc">
  Delete Account
</button>

<!-- Modal -->
<div class="modal fade" id="delete_acc" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_acc_title">Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper">
  <form class="form-signin" action="delete_acc.php" method="POST">       
      <h2 class="form-signin-heading">Please enter your account information</h2>
      <input type="password" class="form-control" name="password" placeholder="Password" required />   
      <input type="text" class="form-control" name="delete" placeholder="DELETE" required pattern="DELETE"/>  
      <p>Please fill in "DELETE" in the above field if you are sure you'd like to delete your account.</p>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Delete account</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php if(!isset($_SESSION["reqeusted_store_manager_rights"])){ ?>
<form method="POST" action="request_store_manager_rights.php">
<button type="submit" class="btn btn-primary" >
  Request store 
</button>
</form>
<?php } ?>


  </div>
</div>

<?php if(isset($_SESSION["reqeusted_store_manager_rights"])){ ?>
<div class="alert alert-success">An email has been sent requesting store manager rights for this account, please wait while we process your request.</div>
<?php } ?>

<h2 class="text-left"> ORDER LIST: </h2>



<?php

  include_once __DIR__ . "/api/order/read_all_for_buyer.php";
  include_once __DIR__ . "/api/order_items/read_all_for_order.php";
  include_once __DIR__ . "/api/store/read_one.php";
  include_once __DIR__ . "/api/product/read_one.php";

  $orders = read_all_for_buyer(json_encode(array("email" => $_SESSION["email"])));

  if(!isset($orders[0]))
  foreach($orders["records"] as $order){

    $data = json_encode(array("order_id" => $order["id"]));

        $order_items = read_all_for_order($data);

        $store_name = read_one(json_encode(array("id" => $order["responsabil_id"])))["store_nume"];


        ?>

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order for <?php echo $store_name; ?></h5>
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
            
            <?php 
            
            //find if order has review
            include_once __DIR__ . "/api/review/read_one_order.php";

            $data_review = read_one_order(json_encode(array("order_id" => $order["id"])));
            
            if($order["status"] != "in_transit" && !$data_review)
            
            {?>

            <form method="POST" action="handle_review.php">

            <select name="score">
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            <option value="6"> 6 </option>
            <option value="7"> 7 </option>
            <option value="8"> 8 </option>
            <option value="9"> 9 </option>
            <option value="10"> 10 </option>
            </select>

            <button type="submit" class="btn-secondary" name="order_id" value= <?php echo '"'. $order["id"] .'"' ?>   > Rate store </button> 
            </form>

            <?php } ?>
        </div>
        </div>

        <?php



  }



?>
<?php include_once 'footer.php';?>