<?php
  
include_once dirname(__DIR__).'/config/database.php';
include_once dirname(__DIR__).'/objects/store.php';

function read(){

    $database = new Database();
    $db = $database->getConnection();
    $store = new Store($db);

    $stmt = $store->read();
    $num = $stmt->rowCount();

    if($num>0){
        
        $stores_arr = array();

        $stores_arr["records"]=array();
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row); // creeaza variabile locale dupa elemente

            $store_item=array( // face array din ele
            "id" => $id,
            "admin_email" => $admin_email,
            "store_nume" => $store_nume,
            "score" => $score,
            "nr_tranzactii" => $nr_tranzactii
            );
            
            array_push($stores_arr["records"], $store_item);
        }
    
    }
    
    else{
        $stores_arr = array();
        array_push($stores_arr, "error");
    }

    return $stores_arr;

}

?>