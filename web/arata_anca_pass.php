<?php

session_start();

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

include_once __DIR__ . "/api/user/read_one.php";

// $data = json_encode(array("email" => "anca_email"));

// $anca = read_one($data);

echo "Buna ziua si bine v am gasit, parola dumneavoastra este: ", $_SESSION["password"];


?>