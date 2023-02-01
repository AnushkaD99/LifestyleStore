<?php
    require 'connection.php';
    session_start();
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $password = mysqli_real_escape_string($con,$_POST['password']);
    if(strlen($password)<6){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $user_authentication_query="SELECT * FROM users WHERE email='$email'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    //$rows_fetched=mysqli_num_rows($user_authentication_result);
    $row=mysqli_fetch_array($user_authentication_result);
    if(password_verify($password, $row['password'])){
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];  //user id
        header('location: products.php');
    }else{
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=login.php" />
        <?php
        die($password);
        //header('location: login');
        //echo "Wrong email or password.";
    }
 ?>