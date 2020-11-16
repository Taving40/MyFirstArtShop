<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
  
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
  
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->name) && !empty($data->password)){

    $user->email = $data->email;
    $user->name = $data->name;
    $user->password = $data->password;

  
    //creare produs
    if($user->create()){
  
        http_response_code(201);
        //echo "user was created.";
        echo json_encode(array("message" => "user was created."));
    }
  
    else{
        //503 - service unavailable
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create user."));
    }
}
  
else{
  
    //400 bad request
    http_response_code(400);
    //echo "Unable to create user. Data is incomplete.";
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>