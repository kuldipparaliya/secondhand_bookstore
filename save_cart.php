<?php
    include "config.php";
    session_start();

    if(!isset($_SESSION['user_id'])){
        header("location: {$hostname}/login.php");
    }else{
        if(isset($_POST['cart'])){
            $book_id = $_POST['book_id'];
            $sql = "select * from book
            left join user on user.user_id = book.book_author
            left join category on category_id = book.book_category 
            where book_id = $book_id";
            
            $result = mysqli_query($conn,$sql) or die("Query Failed!!!");
            $row = mysqli_fetch_assoc($result);
            

            if(isset($_SESSION['cart'])){
                $column = array_column($_SESSION['cart'],'book_id');
                if(in_array($book_id,$column)){
                    header("location: {$_SERVER['HTTP_REFERER']}");
                }else{
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = $row;
                    header("location: {$_SERVER['HTTP_REFERER']}");
                }
            }else{
                $_SESSION['cart'][0] = $row;
                header("location: {$_SERVER['HTTP_REFERER']}");
            }
           
        }
    }

    if(isset($_POST['remove'])){
        $book_id = $_POST['book_id'];
        foreach($_SESSION['cart'] as $key => $value){
            if($value['book_id'] == $book_id){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);

                if(count($_SESSION['cart']) == 0){
                    unset($_SESSION['cart']);
                }
                header("location: {$_SERVER['HTTP_REFERER']}");
            }
        }
        
    }

?>