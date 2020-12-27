<?php
include_once __DIR__ . "/api/config/utilities.php";
include_once __DIR__ . "/api/cart/delete_cart.php";

session_start();
not_logged_in();

$data = json_encode(array("user_email" => $_SESSION["email"]));

if (ini_get("session.use_cookies")) { 
    $params = session_get_cookie_params(); 
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"] 
    ); 
} 
session_destroy();
header("Location: login.php");
exit;

?>