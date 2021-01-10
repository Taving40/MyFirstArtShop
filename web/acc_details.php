<?php session_start(); 

include_once __DIR__ . "/api/config/utilities.php";

not_logged_in();

?>

<?php include_once 'header.php';?>

<div class="card" >
  <div class="card-body">
    <h5 class="card-title">Hello, <?php echo $_SESSION["name"]; ?></h5>
    <p class="card-text">Here is your account information:</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Email: <?php echo $_SESSION["email"]; ?></li>
    <li class="list-group-item">Name: <?php echo $_SESSION["name"]; ?></li>
  </ul>
  <div class="card-body">



<!-- Name change pop-up -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_name">
  Change name
</button>

<!-- Modal -->
<div class="modal fade" id="change_name" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_name_title">Change your name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper">
  <form class="form-signin" action="change_name.php" method="POST">       
      <h4 class="form-signin-heading">Please enter your password and the name you wish to change to.</h4>
      <br>
      <input type="password" class="form-control" name="password" placeholder="Password" required />   
      <br>
      <input type="text" class="form-control" name="new_name" placeholder="New name" required />  
      <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change name</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





    <!-- Password change pop-up -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change_password">
  Change password
</button>

<!-- Modal -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_passwordTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change_password_title">Change your password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">

      <div class="wrapper"> 
  <form class="form-signin" action="change_password.php" method="POST">       
      <h4 class="form-signin-heading">Please enter both your old and new password.</h4>
      <br>
      <input type="password" class="form-control" name="old_password" placeholder="Old password" required />   
      <br>
      <input type="password" class="form-control" name="new_password" placeholder="New password" required />  
      <!--pattern="^[a-zA-Z0-9]{8,10}$" put this for type="password"--> 
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Change password</button>   
  </form>
  </div>

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>



<?php include_once 'footer.php';?>