<?php
    require 'connection.php';
    //require 'header.php';
    session_start();
    $item_id=mysqli_real_escape_string($con, $_GET['id']);
    $user_id=mysqli_real_escape_string($con, $_SESSION['id']);
    $add_to_cart_query="insert into users_items(user_id,item_id,status) values (?, ?, 'Added to cart')";
    $stmt = mysqli_prepare($con, $add_to_cart_query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
    mysqli_stmt_execute($stmt);
    header('location: products.php');
?>
