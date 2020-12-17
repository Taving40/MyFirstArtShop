<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/demo.css">
</head>


<body>
<header class="intro"></header>

<main>
  <div class="wrapper">
  <form class="form-signin" action="login_auth.php" method="POST">       
      <h2 class="form-signin-heading">Please login</h2>

      <?php 
      session_start(); 
      if(isset($_SESSION["register"]) && $_SESSION["register"] == "succesful"){ ?>

          <h3> Register succesful! </h3> <br>

      <?php  }  ?>

      <?php 
      if(isset($_SESSION["login"]) && $_SESSION["login"] == "failed"){ ?>

          <h3> Login failed, try again! </h3>

      <?php  /*$_SESSION = array();*/ }   ?>

      <input type="email" class="form-control" name="email" placeholder="Email Address" required autofocus/>
      <input type="password" class="form-control" name="password" placeholder="Password" required/>      
      <a href="register_form.php">Register now!</a>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
  </form>
  </div>
</main>

<footer class="intro"></footer>

</body>
</html>
