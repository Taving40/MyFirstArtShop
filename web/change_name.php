<html>
<body>
<?php

include_once __DIR__ . '/api/user/update.php';
include_once __DIR__ . '/api/config/utilities.php';

session_start();
not_logged_in();

$data = $_POST;

$data['email'] = $_SESSION['email'];

$data = valid_input($data);

$data = json_encode($data);

if(update($data)){
    echo "Succesfully changed your name!";
    $_SESSION['name'] = json_decode($data)->new_name;
}
else echo "Name change failed.";

?>
</body>
</html>