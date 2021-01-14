<html>
<body>
<?php

include_once __DIR__ . '/api/user/delete.php';
include_once __DIR__ . '/api/config/utilities.php';

session_start();
not_logged_in();

$data = $_POST;

$data["email"] = $_SESSION["email"];

$data = valid_input($data);

$data = json_encode($data);

if(delete($data)){
    echo "Account deleted.";
    
    if (ini_get("session.use_cookies")) { 
        $params = session_get_cookie_params(); 
        setcookie(session_name(), '', time() - 42000, 
            $params["path"], $params["domain"], 
            $params["secure"], $params["httponly"] 
        ); 
    } 
    session_destroy();
}

else echo "Account deletion failed.";

?>
</body>
</html>