<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/review.php';

//receives store_id
function read_all_for_one_store($data){

    $database = new Database();
    $db = $database->getConnection();
    $review = new Review($db);

    $data = json_decode($data);

    if($data->store_id){
        $review->store_id = $data->store_id;
    }

    $stmt = $review->read_one_store();
    $num = $stmt->rowCount();

    if($num>0){
        
        $reviews_arr = array();

        $reviews_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $review_item=array( // face array din ele
            "id" => $id,
            "user_email" => $user_email,
            "score" => $score,
            "store_id" => $store_id
            );
            
            array_push($reviews_arr["records"], $review_item);
        }
    }
    
    else{

        $reviews_arr = array();
        array_push($reviews_arr, "error");

    }

    return $reviews_arr;

}

?>