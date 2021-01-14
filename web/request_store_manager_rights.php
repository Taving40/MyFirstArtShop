<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";
include_once __DIR__ . "/api/config/mail.php";
include_once __DIR__ . "/api/user/is_manager.php";

not_logged_in();

if(is_manager(json_encode(array("email" =>$_SESSION["email"])))){
    header("Location: acc_details.php");
    exit;
}

$_SESSION["reqeusted_store_manager_rights"] = true;

mailer("myfirstartshop@gmail.com", "myfirstartshop@gmail.com", "Art Shop", "User requested store manager rights", 
"User with the following email has requested store manager rights: " . $_SESSION["email"]);

header("Location: acc_details.php");
exit;


?>
