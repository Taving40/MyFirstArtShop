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
    
    if($user->email && password_verify($data->password, $user->password)){

        return $user->name;
    }
    
    else{

        return false;
    }
}
?>