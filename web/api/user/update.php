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

                return true;
            }
        }

        else{

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

                return true;
            }
        }

        else{

            return false;
        }

    }
    }

?>