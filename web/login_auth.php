<?php session_start();

include_once __DIR__ . '/api/user/read_one.php';
include_once __DIR__ . '/api/config/utilities.php';

$data = $_POST;

$data = valid_input($data);

$data = json_encode($data);

if($name = read_one($data)){
    $data = json_decode($data);
    $_SESSION["email"] = $data->email;
    $_SESSION["name"] = $name;
    $_SESSION["password"] = $data->password; //just for testing
    $_SESSION["login"] = "succesful";
    header("Location: home.php");
    exit;
}

else{
    $_SESSION["login"] = "failed";
    header("Location: login.php");
    exit;
} 

?>
