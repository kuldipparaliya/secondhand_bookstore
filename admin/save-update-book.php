<?php
    if($_SESSION['role']==0){
        header("location: ../index.php");
      }
    include "config.php";
    // if(empty($_FILES['new_image']['name'])){
    //     $file_name = $_POST['old_image'];
    // }else{
    
    //     $errors = array();
    //     $file_name = $_FILES['new_image']['name'];
    //     $file_size = $_FILES['new_image']['size'];
    //     $file_temp = $_FILES['new_image']['tmp_name'];
    //     $file_type = $_FILES['new_image']['type'];
    //     $ext = explode('.',$file_name);
    //     $file_ext = end($ext);

    //     $extensions =array('jpeg','jpg','png');

    //     if(in_array($file_ext,$extensions)=== false){
    //         $errors[] ="This extension file not allowed,Please choose a jpg,jpeg or png file";
    //     }

    //     if($file_size >= 2097152){
    //         $errors[] = "File size must be less than 2MB";
    //     }

    //     if(empty($errors)  == true){
    //         move_uploaded_file($file_temp,"upload/".$file_name);
    //     }else{
    //         print_r($errors);
    //         die();
    //     }
    // }

    $sql = "update book set book_title = '{$_POST['btitle']}',book_category={$_POST['category']},old_prize={$_POST['oprize']},prize={$_POST['prize']}
    where book_id = {$_POST['book_id']}";

    $result = mysqli_query($conn,$sql) ;

    if($result){
        header("location: {$hostname}/book.php");
    }else{
        echo "Query Failed";
    }

?>