<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';
//expects to receive store_id
function delete_all_from_store($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);
    
    $data = json_decode($data);
    
    if($data->store_id)
        $review->store_id = $data->store_id;
    
    if($review->delete_all_from_store()){
        return true;
    }
    
    else{
        return false;
    }
}
?>