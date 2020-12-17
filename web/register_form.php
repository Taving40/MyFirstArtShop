<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/demo.css">
</head>


<body>
<header class="intro"></header>

<main>
<div class="wrapper">
<form class="form-signin" action="register.php" method="POST">       
    <h2 class="form-signin-heading">Please register</h2>
    
    <?php 
    session_start(); 
    if(isset($_SESSION["register"]) && $_SESSION["register"] == "failed"){ ?>

        <h3> Register failed! </h3>

    <?php  $_SESSION = array(); }  ?>

    <input type="email" class="form-control" name="email" placeholder="Email Address" required autofocus />
    <input type="text" class="form-control" name="name" placeholder="Name" required/>   
    <input type="password" class="form-control" name="password" placeholder="Password" required/>
    <!--pattern="^[a-zA-Z0-9]{8,10}$" put this for type="password"--> 
    <p> Please use between 8-10 characters, use both uppercase, lowercase letters and numbers.</p>   
    <a href="login.php">Login, instead.</a>
    <button class="btn btn-lg btn-primary btn-block" type="submit">register</button>   
</form>
</div>
</main>

<footer class="intro"></footer>



</body>
</html>
