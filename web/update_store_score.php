<?php
include_once __DIR__ . "/api/config/utilities.php";

session_start();
not_logged_in();

$data = $_SESSION;
$data = valid_input($data);



include_once __DIR__ . "/api/review/read_one_store.php";

$store_reviews = read_all_for_one_store(json_encode(array("store_id" => $data["store_id"])));

$number_of_reviews = count($store_reviews);

include_once __DIR__ . "/api/store/read_one.php";

$store = read_one(json_encode(array("id" => $data["store_id"])));
$old_store_score = $store["score"];

$new_store_score = round(($old_store_score + $data["score"])/$number_of_reviews);
$store["score"] = $new_store_score;

include_once __DIR__ . "/api/store/update.php";

update(json_encode($store));

unset($_SESSION["store_id"]);
unset($_SESSION["score"]);
// redirect after tidying up
header("Location: acc_details.php");
exit;



?>