<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/store.php';
  
function read_one_name($data){

    $database = new Database();
    $db = $database->getConnection();
    $store = new Store($db);
    
    $data = json_decode($data);

    if ($data->name)
        $store->store_nume = $data->name;
    else
        return false;

    $store->read_one_name();
    
    if($store->admin_email){

        $store_arr = array(
            "id" => $store->id,
            "admin_email" => $store->admin_email,
            "store_nume" => $store->store_nume,
            "score" => $store->score,
            "nr_tranzactii" => $store->nr_tranzactii
        );
    
        return $store_arr;
    }
    
    else{
        return false;
    }
}
?>