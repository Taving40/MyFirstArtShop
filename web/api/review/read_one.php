<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';
//expects to receive id (of individual review)
function read_one($data){

    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);

    $data = json_decode($data);
    if ($data->id)
        $review->id = $data->id;
    else
        return false;

    $review->read_one();
    
    if($review->user_email){

        $review_arr = array(
            "id" => $review->id,
            "user_email" => $review->user_email,
            "order_id" => $review->order_id,
            "score" => $review->score,
            "store_id" => $review->store_id
        );

        return $review_arr;
    }
    
    else{
        return false;
    }
}
?>