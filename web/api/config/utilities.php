<?php

//inner_arr_field has to be field name of inbricated arrays
class Nested_arr_uasort{
    public $inner_arr_field;
    public $arr_of_arrs;

    function arr_cmp($a, $b){
        if($a[$this->inner_arr_field] < $b[$this->inner_arr_field])
            return -1;
        elseif($a[$this->inner_arr_field] > $b[$this->inner_arr_field])
            return 1;
        return 0;
    }

    function arr_cmp_rev($a, $b){
    if($a[$this->inner_arr_field] < $b[$this->inner_arr_field])
        return 1;
    elseif($a[$this->inner_arr_field] > $b[$this->inner_arr_field])
        return -1;
    return 0;
    }

    function get_sorted_arr(){
        $name = "";
        if (substr($this->inner_arr_field, 0, 3) == "rev"){
            $name = "arr_cmp_rev";
            $this->inner_arr_field = substr($this->inner_arr_field, 4);
        }
        else 
            $name = "arr_cmp";
        //echo substr($this->inner_arr_field, 0, 3);
        uasort($this->arr_of_arrs, array($this, $name));
        return $this->arr_of_arrs;
    }
}

function not_logged_in(){
    if (!isset($_SESSION["login"]) || $_SESSION["login"] == "failed") {
        ?>
        <alert class="alert">
        <?php
        echo "Please log in first or register an account!!";
        ?>
        </alert>
        <?php
        exit;
    }

}

function user_has_access_order($user_email, $order_id){

    include_once dirname(__DIR__, 2) . "/api/store/read_all_for_user.php";
    include_once dirname(__DIR__, 2) . "/api/order/read_one.php";
    include_once dirname(__DIR__, 2) . "/api/order/read_all_for_store.php";


    $data = json_encode(array("email" => $user_email));

    $stores = read_all_for_user($data);

    $store_ids_to_consider = array();

    foreach($stores["records"] as $store){
        array_push($store_ids_to_consider, $store["id"]);
    }

    $has_access = false;

    foreach($store_ids_to_consider as $store_id){
        $data = read_all_for_store(json_encode(array("responsabil_id" => $store_id)));
        //print_r($data);
        if(!isset($data[0]))
        foreach($data["records"] as $store_order){
            if($store_order["id"] == $order_id)
                $has_access = true;
        }
    }

    return $has_access;


}

function get_store($store_id){
    include_once dirname(__DIR__, 2) . "/api/store/read_one.php";

    return read_one(json_encode(array("id" => $store_id)));
}

function user_has_access($user_email, $product_id){

    include_once dirname(__DIR__, 2) . "/api/product/read_all_for_store.php";
    include_once dirname(__DIR__, 2) . "/api/store/read_all_for_user.php";

    $data = json_encode(array("email" => $user_email));

    $stores = read_all_for_user($data);

    $store_ids_to_consider = array();

    foreach($stores["records"] as $store){
        array_push($store_ids_to_consider, $store["id"]);
    }

    $products = array();

    foreach($store_ids_to_consider as $store_id){
        $data = json_encode(array("store_id" => $store_id));

        $one_store_products = read_all_for_store($data);

        if(isset($one_store_products["records"]))
        $products = array_merge($products, $one_store_products["records"]);
    }

    $has_access = false;

    if(isset($products[0]))
    foreach($products as $product){
        if($product["id"] == $product_id){
            $has_access = true;
            break;
        }
    }

    return $has_access;


}

function valid_input($data){
    
    foreach($data as $field){
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
    }

    return $data;
}

function getRandomString() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < 10; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}

// function better_crypt($input, $rounds = 7)
//   {
//     $salt = "";
//     $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
//     for($i=0; $i < 22; $i++) {
//       $salt .= $salt_chars[array_rand($salt_chars)];
//     }
//     return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
//   }

?>