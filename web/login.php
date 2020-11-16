<html>
<body>

asdfasdfasdf

<?php

echo 1;
include_once 'api/user/read_one.php';

$data = json_encode($_POST);

if(read_one($data))
    echo "Login Succesful!";
else echo "Login failed.";

?>

</body>
</html>