<?php
    require 'connection.php';
    session_start();
    if(!isset($_SESSION['id'])){
        header('location:index.php');
        exit;
    }
    $item_id=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $user_id=$_SESSION['id'];
    if($item_id === false){
        header('location: products.php');
        exit;
    }
    $add_to_cart_query="insert into users_items(user_id,item_id,status) values (?,?,?)";
    $stmt = mysqli_prepare($con,$add_to_cart_query);
    mysqli_stmt_bind_param($stmt, 'iis', $user_id, $item_id, "Added to cart");
    $add_to_cart_result=mysqli_stmt_execute($stmt) or die(mysqli_error($con));
    header('location: products.php');
?>
