<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
include_once __DIR__.'/read_one.php';

function delete($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    $data = json_decode($data);
    
    $test_user = array();
    $test_user["email"] = $data->email;
    $test_user["password"] = $data->password;
    $test_user = json_encode($test_user);

    if(read_one($test_user)){

    $user->email = $data->email;
    
    if($user->delete()){
    
        //200 ok
        //http_response_code(200);
        //echo "user was deleted.";
        //echo json_encode(array("message" => "user was deleted."));
        return true;
    }

    }
    else{
    
        //503 service unavailable
        //http_response_code(503);
        // echo "Unable to delete user.";
        //echo json_encode(array("message" => "Unable to delete user."));
        return false;
    }
}
?>