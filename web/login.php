<html>
<body>

<?php

include_once __DIR__ . '/api/user/read_one.php';

$data = json_encode($_POST);

if(read_one($data))
    echo "Login Succesful!";
else echo "Login failed.";

echo $data;

?>

</body>
</html>