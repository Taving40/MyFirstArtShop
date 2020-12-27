<?php

include_once __DIR__ . "/api/user/read_one.php";

$data = json_encode(array("email" => ""));

$anca = read_one($data);



?>