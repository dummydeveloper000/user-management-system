<?php
include "include/header.php";
include "include/db_config.php";
?>

<div class="container">

<?php
  include "include/navbar.php";
?>

<?php
$errorMsg = "";

if(isset($_POST["login"])){
  
  $email = $_POST["email"];
  $password = $_POST["password"];

  // validate the email and password

  if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errorMsg = "Invalid email or empty!";
  } elseif(empty($password) || strlen($password)<6){
    $errorMsg = "Password empty or less than six letters!";
  }
  else{
    $query = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $user = $conn->query($query)->fetch();

    if(!empty($user) and !empty($password)){
      $errorMsg = "You are successfully logged In!";
    } else{
      $errorMsg = "Incorrect Credentials!"
    }
    }
}

?>
    <div class="card">
    <div class="card-header">
      <h3 class="text-center"><i class="fas fa-sign-in-alt mr-2"></i>User Login</h3>
      <?php if(!empty($errorMsg)){ ?>
        <p class="text-center"><?php echo $errorMsg;?></p>
        <?php } ?>  
      
    </div>
    <div class="card-body">
      <div style="width:450px; margin:0px auto">
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" name="login" class="btn btn-success">Login</button>
          </div>
        </form>
      </div>
    </div>
</div>
<!-- include the footer file -->
<?php
    include "include/footer.php";
?>

