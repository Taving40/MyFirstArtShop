<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/user.php';
include_once dirname(__DIR__).'/objects/store.php';  

function is_manager($data){

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $store = new Store($db);
    $stmt = $store->read();

    $data = json_decode($data);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row); // creeaza variabile locale dupa elemente

        if($admin_email == $data->email)
            return true;
    }

    return false;
    

}
?>