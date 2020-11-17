<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
include_once dirname(__DIR__).'/config/utilities.php';
  
function create($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    $data = json_decode($data);

    if(!empty($data->email) && !empty($data->name) && !empty($data->password)){

        $user->email = $data->email;
        $user->name = $data->name;
        $user->password = password_hash($data->password, PASSWORD_DEFAULT);

        if($user->create()){
    
            //http_response_code(201);
            //echo "user was created.";
            //echo json_encode(array("message" => "user was created."));

            return true;
        }
    
        else{
            //503 - service unavailable
            //http_response_code(503);
            //echo json_encode(array("message" => "Unable to create user."));

            return false;
        }
    }
    
    else{
    
        //400 bad request
        //http_response_code(400);
        //echo "Unable to create user. Data is incomplete.";
        //echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
        return false;
    }

}
?>