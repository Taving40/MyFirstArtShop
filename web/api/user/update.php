<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
  
$data = json_decode(file_get_contents("php://input"));

//set values
if(!empty($data->name) && !empty($data->email) && !empty($data->password)){

    $user->email = $data->email;
    $user->name = $data->name;
    $user->password = $data->password;
  
}

if($user->update()){
    //200 ok
    http_response_code(200);
    //echo "user was updated.";
    echo json_encode(array("message" => "user was updated."));
}
  

else{
    //503 service unavailable
    http_response_code(503);
    //echo "Unable to update user.";
    echo json_encode(array("message" => "Unable to update user."));
}
?>