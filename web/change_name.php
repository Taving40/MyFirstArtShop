<html>
<body>
<?php

include_once __DIR__ . '/api/user/update.php';
include_once __DIR__ . '/api/config/utilities.php';

$data = $_POST;

$data = valid_input($data);

$data = json_encode($data);

if(update($data))
    echo "Succesfully changed your name!";
else echo "Name change failed.";

?>
</body>
</html>