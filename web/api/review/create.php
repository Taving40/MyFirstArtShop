<?php

include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';

function create($data){

    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);
    
    $data = json_decode($data);

    if(!empty($data->user_email) && !empty($data->order_id)){

        $review->user_email = $data->user_email;
        $review->order_id = $data->order_id;
        $review->score = $data->score;
        $review->store_id = $data->store_id;

        if($review->create()){
            return true;
        }
    
        else{
            return false;
        }
    }
    
    else{
        return false;
    }

}

?>