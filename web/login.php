<html>
<body>

<?php

include_once __DIR__ . '/api/user/read_one.php';
include_once __DIR__ . '/api/config/utilities.php';

$data = $_POST;

$data = valid_input($data);

$data = json_encode($data);

if(read_one($data))
    echo "Login Succesful!";
else echo "Login failed.";

?>

</body>
</html>