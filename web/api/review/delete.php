<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';
  
function delete($data){
        
    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);
    
    $data = json_decode($data);
    
    if($data->id)
        $review->id = $data->id;
    
    if($review->delete()){
        return true;
    }
    
    else{
        return false;
    }
}
?>