<?php

    include 'config.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: {$hostname}");
    }
    $id = $_GET['id'];
    $cat_id = $_GET['catid'];
    $sql2 = "select * from book where book_id = {$id}";
    $result2 = mysqli_query($conn,$sql2) or die("Select Query Failed!!");

    $row = mysqli_fetch_assoc($result2);
    
    unlink("admin/upload/".$row['book_image']);

    $sql = "delete from book where book_id = {$id}";
    $sql1 = "update category set no_book = no_book - 1 where category_id = {$cat_id}";

    if(mysqli_query($conn,$sql)&& mysqli_query($conn,$sql1)){
        header("location: {$hostname}/profile.php?uid={$_SESSION['user_id']}");
    }else{
        echo "<div>Query Failed!!</div>";
    }
?>