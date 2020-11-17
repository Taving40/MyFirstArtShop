<html>
<body>
<?php

include_once __DIR__ . '/api/user/delete.php';
include_once __DIR__ . '/api/config/utilities.php';

$data = $_POST;

$data = valid_input($data);

$data = json_encode($data);

if(delete($data))
    echo "Account deleted.";
else echo "Account deletion failed.";

?>
</body>
</html>