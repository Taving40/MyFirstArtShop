<?php

include_once __DIR__ . "/api/config/utilities.php";

session_start();
not_logged_in();

$data = $_POST;

$data = valid_input($data);

//check if score is valid
if($data["score"] < 1 || $data["score"] > 10){
    header("Location: acc_details.php");
    exit;
}

//check if user has assigned order and order isnt reviewed already

include_once __DIR__ . "/api/review/read_one_order.php";

$data_review = read_one_order(json_encode(array("order_id" => $data["order_id"])));
if($data_review){
    header("Location: acc_details.php");
    exit;
}

include_once __DIR__ . "/api/order/read_one.php";

$data_order = read_one(json_encode(array("id" => $data["order_id"])));
if($data_order["user_email"] != $_SESSION["email"]){
    header("Location: acc_details.php");
    exit;
}


//create review

include_once __DIR__ . "/api/review/create.php";

$data_review = json_encode(array("order_id" =>  $data["order_id"],
                                 "user_email" =>  $_SESSION["email"],
                                 "store_id" =>  $data_order["responsabil_id"],
                                 "score" =>  $data["score"]));

create($data_review);

//update store score

$_SESSION["store_id"] = $data_order["responsabil_id"];
$_SESSION["score"] = $data["score"];

header("Location: update_store_score.php");
exit;






?>