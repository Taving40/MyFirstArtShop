<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

include_once __DIR__ . '/api/config/utilities.php';
include_once __DIR__ . '/api/config/mail.php';
include_once __DIR__ . '/api/user/read_one_email.php';

$data = $_POST;
$data = valid_input($data);

if(!read_one_email(json_encode($data))){
    
    $key = getRandomString();

    $_SESSION["data"] = $data;
    $_SESSION["key"] = $key;

    mailer($data["email"], "myfirstartshop@gmail.com", "Art Shop", "Email confirmation", 
    "Please confirm your email with the following code: " . $key . ".");

}

else{
    $_SESSION["register"] = "failed";
    header("Location: register_form.php");
    exit;
}

?>

<html>
<body>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Key</title>
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/demo.css">
</head>

<form class="form-signin" action="register_auth.php" method="POST">  
    <input type="text" class="form-control" name="key" placeholder="Key" required/>   
    <button class="btn btn-lg btn-primary btn-block" type="submit">register</button>
</form>

</body>
</html>