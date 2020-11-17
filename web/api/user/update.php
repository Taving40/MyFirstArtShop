<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
include_once __DIR__.'/read_one.php';

function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    $data = json_decode($data);

    if(isset($data->new_password)){

        $test_user = array();
        $test_user["email"] = $data->email;
        $test_user["password"] = $data->old_password;
        $test_user = json_encode($test_user);

        if(read_one($test_user)){
            
            $user->password = password_hash($data->new_password, PASSWORD_DEFAULT);
            $user->email = $data->email;

            if($user->update_pass()){
                //200 ok
                //http_response_code(200);
                //echo "user was updated.";
                //echo json_encode(array("message" => "user was updated."));
                return true;
            }
        }

        else{
            //503 service unavailable
            //http_response_code(503);
            //echo "Unable to update user.";
            //echo json_encode(array("message" => "Unable to update user."));

            return false;
        }

    }

    elseif(isset($data->new_name)){
        $test_user = array();
        $test_user["email"] = $data->email;
        $test_user["password"] = $data->password;
        $test_user = json_encode($test_user);

        if(read_one($test_user)){
            
            $user->name =$data->new_name;
            $user->email = $data->email;

            if($user->update_name()){
                //200 ok
                //http_response_code(200);
                //echo "user was updated.";
                //echo json_encode(array("message" => "user was updated."));
                return true;
            }
        }

        else{
            //503 service unavailable
            //http_response_code(503);
            //echo "Unable to update user.";
            //echo json_encode(array("message" => "Unable to update user."));

            return false;
        }

    }
    }

?>