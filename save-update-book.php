<?php

    include "config.php";
    session_start();
     /* If username is not set then redirect into the page into home page */
    if(!isset($_SESSION['username'])){
        header("location: {$hostname}");
    }
    
     /* Capture the new data and set the new data enter by user */
    $sql = "update book set book_title = '{$_POST['btitle']}',book_category={$_POST['category']},old_prize={$_POST['oprize']},prize={$_POST['prize']}
    where book_id = {$_POST['book_id']}";

     /* If category is chage then increase and decrease category count*/
    $sql1 = "update category set no_book = no_book + 1 where category_id = {$_POST['category']}";
    $sql2 = "update category set no_book = no_book - 1 where category_id = {$_POST['old_category']}";


    if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1) && mysqli_query($conn,$sql2)){
        header("location: {$hostname}/profile.php?uid=".$_SESSION['user_id']."");
    }else{
        echo "Query Failed";
    }


?>