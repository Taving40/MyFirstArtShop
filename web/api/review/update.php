<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';

//expects full review data
function update($data){

    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);
    
    $data = json_decode($data);

    if(!empty($data->id)){

        $review->id = $data->id;
        $review->user_email = $data->user_email;
        $review->score = $data->score;
        $review->store_id = $data->store_id;
    
    }

    if($review->update()){
        return true;
    }
    
    else{
        return false;
    }
}
?>