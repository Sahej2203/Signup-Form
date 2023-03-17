<?php session_start();?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <?php include 'css/style.php' ?>
    <?php include 'links/links.php' ?>
</head>
<body>

<?php 

include 'dbcon.php';
if(isset($_POST['submit'])){
    $username = ($_POST['username']);
    $email = ( $_POST['email']);
    $mobile = ( $_POST['mobile']);
    $password = ($_POST['password']);
    $cpassword = ( $_POST['cpassword']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass  = password_hash($cpassword , PASSWORD_BCRYPT);

    $emailquery = "select * from registration where email = '$email'";
    $query = mysqli_query($conn,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount>0){
        echo "email already exist";
    }
    else{
        if($password === $cpassword){
            $insertquery = "insert into registration( username, email, mobile, password, cpassword) 
        values ('$username','$email','$mobile','$pass','$cpass')";

        $iquery = mysqli_query($conn, $insertquery);
        if($iquery)
        {
            ?>
            <script>
                alert("Inserted Successfully");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("Not Inserted");
            </script>
            <?php
        }
    }else{
        ?>
            <script>
                alert("Password are not matching");
            </script>
            <?php
    }
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
                <input name="username" class="form-control" placeholder="Full Name" type="text" required>
            </div>
            
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
                </div>
                <input name="email" class="form-control" placeholder="Email address" type="email" required>
            </div>
            
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                </div>
                <input name="mobile" class="form-control" placeholder="Phone number" type="number" required>
            </div>

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i></span>
                </div>
                <input name="password" class="form-control" placeholder="Create Password" type="password" required>
            </div>

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i></span>
                </div>
                <input name="cpassword" class="form-control" placeholder="Confirm Password" type="password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
            </div>

            <p class="text-center">Have an account? <a href="login.php">Log In</a></p>
        </form>
        </article>

    </div>
</body>
</html>