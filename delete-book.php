<?php

    include 'config.php';
    session_start();
    /*If username is not set then redirect tpo the login page */
    if(!isset($_SESSION['username'])){
        header("location: {$hostname}");
    }
    $id = $_GET['id'];
    $cat_id = $_GET['catid'];
    /*Fetch the book name  */
    $sql2 = "select * from book where book_id = {$id}";
    $result2 = mysqli_query($conn,$sql2) or die("Select Query Failed!!");

    $row = mysqli_fetch_assoc($result2);
    /*delete image from the upload folder*/
    unlink("admin/upload/".$row['book_image']);
    /*delete book_id from the database*/
    $sql = "delete from book where book_id = {$id}";

    /*Decrease the category count by one */
    $sql1 = "update category set no_book = no_book - 1 where category_id = {$cat_id}";

    if(mysqli_query($conn,$sql)&& mysqli_query($conn,$sql1)){
        header("location: {$hostname}/profile.php?uid={$_SESSION['user_id']}");
    }else{
        echo "<div>Query Failed!!</div>";
    }
?>