<?php
    include "config.php";
    if($_SESSION['role']==0){
        header("location: ../index.php");
      }

    $cid = $_GET['cid'];
      $sql2 = "select * from book where book_category = {$cid}";
      $result2 = mysqli_query($conn,$sql2) or die("Query Failed!!");
      while($row2 = mysqli_fetch_assoc($result2)){
        unlink("upload/".$row2['book_image']);
      }

    $sql1 = "delete from book where book_category = {$cid}";
    mysqli_query($conn,$sql1);
   
    $sql = "delete from category where category_id = {$cid}";

    if(mysqli_query($conn,$sql)){
        header("Location: {$hostname}/category.php");
    }else{
        echo "<h1>Category is not deleted</h1>";
    }
?>