<html>
<body>
<?php

include_once __DIR__ . '/api/store/update.php';
include_once __DIR__ . '/api/config/utilities.php';
include_once __DIR__ . '/api/store/read_one_name.php';
include_once __DIR__ . '/api/store/read_all_for_user.php';

session_start();
not_logged_in();

$data = $_POST;

$data = valid_input($data);

$user_stores = read_all_for_user(json_encode(array("email" => $_SESSION["email"])));

$user_stores_names = array();

if(isset($user_stores[0])){
    header("Location: store_management.php?mode=store_details");
    exit;
}
foreach($user_stores["records"] as $user_store){
    array_push($user_stores_names, strtolower($user_store["store_nume"]));
}

if(!in_array(strtolower($data["old_name"]), $user_stores_names)){
    header("Location: store_management.php?mode=store_details");
    exit;
}   

$store = read_one_name(json_encode(array("name" => $data["old_name"])));

$store["store_nume"] = $data["new_name"];

if(update(json_encode($store))){
    echo "Succesfully changed your store's name!";
}
else echo "Name change failed.";

?>
</body>
</html>