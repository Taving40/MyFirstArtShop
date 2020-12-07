<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/store.php';

//expects full store data 
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $store = new Store($db);
    
    $data = json_decode($data);

    if(!empty($data->id)){
        $store->id = $data->id;
        $store->admin_email = $data->admin_email;
        $store->store_nume = $data->store_nume;
        $store->score = $data->score;
        $store->nr_tranzactii = $data->nr_tranzactii;
    }

    if($store->update()){
        return true;
    }
    
    else{
        return false;
    }
}
?>