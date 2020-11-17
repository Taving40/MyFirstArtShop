<?php session_start(); ?>

<html>
<body>

<?php

include_once __DIR__ . '/api/user/create.php';
include_once __DIR__ . '/api/config/utilities.php';


$key2 = $_POST["key"];

$data = $_SESSION["data"];
$key = $_SESSION["key"];

$data = json_encode($data);

if($key2 == $key){
    if(create($data))
        echo "Register Succesful!";
    else echo "Register failed.";
}
?>

</body>
</html>