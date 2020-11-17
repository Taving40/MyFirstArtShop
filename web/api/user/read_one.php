<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
  
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $data = json_decode($data);

    $user->email = $data->email;

    $user->readOne();

    //echo ($data->name == $user->name);
    
    if($user->email && password_verify($data->password, $user->password)){

        // $user_arr = array(
        //     "email" => $user->email,
        //     "name" => $user->name,
        //     "password" => $user->password
        // );
    
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