<html>

<a href="index.php?link=asdfa"> asdgasdgf </a>

<?php

if (isset($_GET["link"]))
echo $_GET["link"];


// REVIEW TESTING

// Delete
// include_once __DIR__ . '/api/review/delete.php';
// $data = json_encode(array('id' => 1));
// echo delete($data);

// Delete_All_From_Store
// include_once __DIR__ . '/api/review/delete_all_from_store.php';
// $data = json_encode(array('store_id' => 1));
// echo delete_all_from_store($data);


// Update
// include_once __DIR__ . '/api/review/update.php';
// $data = json_encode(array('user_email' => 'taving40@gmail.com',
//                             'store_id' => 1,
//                             'id' => 1,
//                             'score' => 0));
// echo update($data);

// Read_One
// include_once __DIR__ . '/api/review/read_one.php';
// $results = read_one(1);
// foreach($results as $column){
//     echo $column, '<br>';
// }

// Read_One_Store (all reviews for one store)
// include_once __DIR__ . '/api/review/read_one_store.php';
// $results = read_one_store(1);
// echo gettype($results);
// foreach($results["records"] as $store){
//     foreach($store as $column){
//         echo $column, "<br>";
//     }
//     echo "<br><br>";
// }

// Create
// include_once __DIR__ . '/api/review/create.php';
// $data = json_encode(array('user_email' => 'taving40@gmail.com',
//                             'store_id' => 1,
//                             'score' => 10));
// echo create($data);



// STORE TESTING

// Delete
// include_once __DIR__ . '/api/store/delete.php';
// $data = json_encode(array('id' => 1));
// echo delete($data);

// Read
// include_once __DIR__ . '/api/store/read.php';
// $results = read();
// echo gettype($results);
// foreach($results["records"] as $store){
//     foreach($store as $column){
//         echo $column, "<br>";
//     }
//     echo "<br><br>";
// }

// Read_One
// include_once __DIR__ . '/api/store/read_one.php';
// $data = json_encode(array('id' => 11));
// $results = read_one($data);
// foreach($results as $column){
//     echo $column, '<br>';
// }

// Update
// include_once __DIR__ . '/api/store/update.php';
// $data = json_encode(array('admin_email' => 'taving40@gmail.com',
//                             'store_nume' => 'Help inc.',
//                             'score' => 0,
//                             'nr_tranzactii' => 1,
//                             'id' => 11));
// echo update($data);

// Create
// include_once __DIR__ . '/api/store/create.php';
// $data = json_encode(array('admin_email' => 'taving40@gmail.com',
//                             'store_nume' => 'Help inc.',
//                             'score' => 0,
//                             'nr_tranzactii' => 0));
// echo create($data);



// CART TESTING

// Delete_Cart_Item
// include_once __DIR__ . '/api/cart/delete_cart_item.php';
// $data = json_encode(array('id' => 1));
// echo delete_cart_item($data);

// Delete_Cart
// include_once __DIR__ . '/api/cart/delete_cart.php';
// $data = json_encode(array('cart_id' => 1));
// echo delete_cart($data);

// Read_Cart
// include_once __DIR__ . '/api/cart/read_cart.php';
// $data = 1;
// $results = read_cart($data);
// echo gettype($results);
// foreach($results["records"] as $cart_item){
//     foreach($cart_item as $column){
//         echo $column, "<br>";
//     }
//     echo "<br><br>";
// }

// Update
// include_once __DIR__ . '/api/cart/update.php';
// $data = json_encode(array('user_email' => 'taving40@gmail.com',
//                             'product_id' => 1,
//                             'cart_id' => 1,
//                             'quantity' => 9005,
//                             'id' => 51));
// echo update($data);

// Read_One
// include_once __DIR__ . '/api/cart/read_one.php';
// $data = json_encode(array('id' => 51));
// $results = read_one($data);
// foreach($results as $column){
//     echo $column, '<br>';
// }

// Create
// include_once __DIR__ . '/api/cart/create.php';
// $data = json_encode(array('user_email' => 'taving40@gmail.com',
//                             'product_id' => 2,
//                             'cart_id' => 1,
//                             'quantity' => 3));
// echo create($data);



// ORDER TESTING
// delete
// include_once __DIR__ . '/api/order/update.php';
// $data = json_encode(array('id' => 761));
// echo delete($data);
// update
// include_once __DIR__ . '/api/order/update.php';
// $data = json_encode(array(  'user_email' => 'taving40@gmail.com',
//                             'status' => 'in_transit',
//                             'responsabil_id' => 1,
//                             'address' => 'asdgasdfgsd',
//                             'eta' => '2021-05-05',
//                             'plata' => 'online',
//                             'id' => 761));
// update($data);
                        
// Create
// include_once __DIR__ . '/api/order/create.php';
// $data = json_encode(array('user_email' => 'taving40@gmail.com',
//                             'status' => 'in_transit',
//                             'responsabil_id' => 1,
//                             'address' => 'asdgasdfgsd',
//                             'eta' => '2021-05-05',
//                             'plata' => 'online'));
// create($data);

// read_all_for_store
// include_once __DIR__ . '/api/order/read_all_for_store.php';
// $data = 1;
// $results = read_all_for_store($data);
// echo gettype($results);
// foreach($results["records"] as $order){
//     foreach($order as $column){
//         echo $column, "<br>";
//     }
//     echo "<br><br>";
// }

// read_all_for_buyer
// include_once __DIR__ . '/api/order/read_all_for_buyer.php';
// $data = 'taving40@gmail.com';
// $results = read_all_for_buyer($data);
// echo gettype($results);
// foreach($results["records"] as $order){
//     foreach($order as $column){
//         echo $column, "<br>";
//     }
//     echo "<br><br>";
// }

// read
// include_once __DIR__ . '/api/order/read_one.php';
// $data = json_encode(array("id" => 11));
// $results = read_one($data);
// echo gettype($results);
// foreach($results as $coloana){
//     echo $coloana, "<br>";
// }

?>

</html>