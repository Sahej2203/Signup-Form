<?php session_start();?>
<html lang="en">
<head>
    <title>Login</title>
    <?php include 'css/style.php' ?>
    <?php include 'links/links.php' ?>
</head>

<body>

<?php 

include 'dbcon.php';
if(isset($_POST['submit'])){
    $email = ( $_POST['email']);
    $password = ($_POST['password']);

    $emailsearch = "select * from registration where email = '$email'";
    $query = mysqli_query($conn,$emailsearch);

    $emailcount = mysqli_num_rows($query);

    if($emailcount){
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass=$email_pass['password'];

        $_SESSION['username'] = $email_pass['username'];

        $pass_decode = password_verify($password, $db_pass);

        if($pass_decode){
            echo "Login Successfully";
            ?>
            <script>
                location.replace("home.php");
            </script>

            <?php
        }
        else{
            echo "Incorrect Password";
        }
    }
    else 
    {
        echo "Invalid email";
    }
 }

?>
    <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Create Account</h4>

        <p class="text-center">Get started with your free account</p>

        <p>
            <a href="" class="btn btn-block btn-gmail"> <i class="fa fa-google"></i> Login via Gmail </a>
            <a href="" class="btn btn-block btn-facebook"> <i class="fa fa-facebook-gf"></i> Login via facebook </a>
        </p>

        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p>
        <form action="" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i></span>
                </div>
                <input name="email" class="form-control" placeholder="Full Name" type="email" required>
            </div>

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i></span>
                </div>
                <input name="password" class="form-control" placeholder="Create Password" type="password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Login Now</button>
            </div>

            <p class="text-center">Not have an account? <a href="registration.php">SignUp Here</a></p>
        </form>
        </article>
    </div>
    
</body>
</html>