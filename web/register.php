<?php session_start(); ?>

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

<?php


include_once __DIR__ . '/api/config/utilities.php';
include_once __DIR__ . '/api/config/mail.php';


$data = $_POST;

$data = valid_input($data);

$key = getRandomString();

$_SESSION["data"] = $data;
$_SESSION["key"] = $key;

mailer($data["email"], "myfirstartshop@gmail.com", "Art Shop", "Email confirmation", 
"Please confirm your email with the following code: " . $key . ".");

?>

<form class="form-signin" action="register_auth.php" method="POST">  
    <input type="text" class="form-control" name="key" placeholder="Key" required/>   
    <button class="btn btn-lg btn-primary btn-block" type="submit">register</button>
</form>

</body>
</html>