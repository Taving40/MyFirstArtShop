<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/user.php';
  
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    //$data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;

    $user->readOne();
    
    if($user->email){

        $user_arr = array(
            "email" => $user->email,
            "name" => $user->name,
            "password" => $user->password
        );
    
        //200 OK
        //http_response_code(200);
        //echo json_encode($user_arr);

        return true;
    }
    
    else{
        //http_response_code(404);
        //echo "user does not exist.";
        //echo json_encode(array("message" => "user does not exist."));

        return false;
    }
}
?>