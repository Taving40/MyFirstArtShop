<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/store.php';
//receives user email
function delete_all_for_user($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $store = new Store($db);
    
    $data = json_decode($data);
    
    if($data->email)
        $store->admin_email = $data->email;
    
    if($store->delete_all_for_user()){
        return true;
    }
    
    else{
        return false;
    }
}
?>