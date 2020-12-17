<?php session_start(); 

include_once __DIR__ . '/api/user/create.php';
include_once __DIR__ . '/api/config/utilities.php';

$key2 = $_POST["key"];
$data = $_SESSION["data"];
$key = $_SESSION["key"];

$data = json_encode($data);

if($key2 == $key){
    if(create($data)){
        $_SESSION["register"] = "succesful";
        header("Location: login.php");
        exit;
    }
    else{
        $_SESSION["register"] = "failed";
        header("Location: register_form.php");
        exit;
    }
}
?>
