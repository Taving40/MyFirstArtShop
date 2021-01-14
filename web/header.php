<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>My First Art Shop</title>
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        
</head>

<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">My First Artshop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="acc_details.php" >Account Details</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Store management
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="store_management.php?mode=products">Products</a>
          <a class="dropdown-item" href="store_management.php?mode=orders"> Orders</a>
          <a class="dropdown-item" href="store_management.php?mode=store_details"> Store details</a>
        </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="cart_details.php" >Cart Details</a>
        </li>
        <li class="nav-item">
           <span class="nav-link" style="padding-left: 15em"> Hello, <?php echo $_SESSION["name"], "!"; ?> </span> 
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" >Log out</a>
        </li>

    </ul>
    <!-- search form will be here -->
</div>
</nav>
<!-- /navbar -->

