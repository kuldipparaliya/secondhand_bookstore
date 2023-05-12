<?php

    include 'config.php';

    if(!isset($_SESSION['user_id'])){
        header("header: {$hostname}");
    }

    if($_SESSION['role']==0){
        header("header: ../index.php");
    }
    
    $id = $_GET['id'];
    $cat_id = $_GET['catid'];
    $sql2 = "select * from book where book_id = {$id}";
    $result2 = mysqli_query($conn,$sql2) or die("Select Query Failed!!");

    $row = mysqli_fetch_assoc($result2);
    
    unlink("upload/".$row['book_image']);

    $sql = "delete from book where book_id = {$id}";
    $sql1 = "update category set no_book = no_book - 1 where category_id = {$cat_id}";

    if(mysqli_query($conn,$sql)&& mysqli_query($conn,$sql1)){
        header("location: {$hostname}/book.php");
    }else{
        echo "<div>Query Failed!!</div>";
    }
?>