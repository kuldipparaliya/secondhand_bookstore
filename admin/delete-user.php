<?php
    include "config.php";
    if($_SESSION['role']==0){
        header("location: ../index.php");
      }

    $user_id = $_GET['id'];
    $sql2 = "select * from book where book_author = {$user_id}";
    $result2 = mysqli_query($conn,$sql2) or die("Query Failed!!!");
    while($row2 = mysqli_fetch_assoc($result2)){
        $sql3 = "update category set no_book = no_book - 1 where category_id = {$row2["book_category"]}";
        unlink('upload/'.$row2["book_image"]);
        mysqli_query($conn,$sql3);
    }
    $sql4 = "select * from user where user_id = {$user_id}";
    $result4 = mysqli_query($conn,$sql4) or die("Query Failed!!!");
    while($row4 = mysqli_fetch_assoc($result4)){
        unlink("upload/".$row4["user_image"]);
    }

    $sql1 = "delete from book where book_author = {$user_id}";
    $sql = "delete from user where user_id = {$user_id}";
    mysqli_query($conn,$sql1);
    if(mysqli_query($conn,$sql)){
        header("Location: {$hostname}/user.php");
    }else{
        echo "<p>Record can't deleted!!</p>";
    }

?>