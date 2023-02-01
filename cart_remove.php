<?php
    require 'connection.php';
    session_start();
    $item_id = mysqli_real_escape_string($con, $_GET['id']);
    $user_id = mysqli_real_escape_string($con, $_SESSION['id']);
    $delete_query="delete from users_items where user_id=? and item_id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
    mysqli_stmt_execute($stmt) or die(mysqli_error($con));
    header('location: cart.php');
?>
