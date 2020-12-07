<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/store.php';
//receives store id
function delete($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $store = new Store($db);
    
    $data = json_decode($data);
    
    if($data->id)
        $store->id = $data->id;
    
    if($store->delete()){
        return true;
    }
    
    else{
        return false;
    }
}
?>