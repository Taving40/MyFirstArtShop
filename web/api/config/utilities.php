<?php
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