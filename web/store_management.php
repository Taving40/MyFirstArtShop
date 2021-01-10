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

<?php }
else{ //display store products and store orders
    //copy from home and adapt to be only for one store
    include_once __DIR__ . "/api/product/read.php";


}

include_once 'footer.php';?>