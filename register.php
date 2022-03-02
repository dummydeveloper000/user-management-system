<?php
    include "include/header.php";
    include "include/db_config.php";
?>
<?php
if(isset($_POST["register"])){
    
    $errorMsg = "";

    $name = trim($_POST["name"]);
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];

    //echo "$name $username $email $mobile $password";

    // validating the entry of form
    
    if(empty($name) || !preg_match("/^[a-z A-Z]*$/", $name)){
        $errorMsg = "Invalid name or field is empty!";
    } elseif(empty($username) || !ctype_alnum($username)){
        $errorMsg = "Invalid username or field is empty!";
    } elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errorMsg = "Invalid email or field is empty!";
    } elseif(empty($mobile) || !preg_match("/^\d{10}$/", $mobile)){
        $errorMsg = "Invalid mobile number or field is empty!";
    } elseif(empty($password) || strlen($password)<6){
        $errorMsg = "Password is less than six letters or field is empty!";
    }

    else{
        // run the query language to insert the received data into database
        $query = "INSERT INTO  `users` (`name`, `username`, `email`, `mobile`, `password`)
        VALUES ('$name', '$username', '$email', '$mobile', '$password')";

        // prepare the query with prepare function and execute with execute function and 
        //display the successful message in the dashboard
        if($conn->prepare($query)->execute()){
            $errorMsg = "You have successfully registered!";
        }
    }

}
?>
        <!-- template for the dashboard -->
<div class="container">
<?php
    include "include/navbar.php";
?>    

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">User Registration</h3>
            <?php
            if(!empty($errorMsg)){
                ?>
                <p class="text-center"><?php echo $errorMsg; ?></p>
            <?php
            }  ?>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <form class="" action="register.php" method="post">
                    <div class="form-group pt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                        <input type="hidden" name="roleid" value="3" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    include "include/footer.php";
?>