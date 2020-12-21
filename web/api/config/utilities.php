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