<?php
    include "config.php";
    session_start();
    /* If user_id is not then redirect to the login page*/
    if(!isset($_SESSION['user_id'])){
        header("location: {$hostname}/login.php");
    }else{
        /* Check cart button is pressed or not*/
        if(isset($_POST['cart'])){
            $book_id = $_POST['book_id'];
            $sql = "select * from book
            left join user on user.user_id = book.book_author
            left join category on category_id = book.book_category 
            where book_id = $book_id";
            
            $result = mysqli_query($conn,$sql) or die("Query Failed!!!");
            $row = mysqli_fetch_assoc($result);
            
            /*If session cart button is set then check whether book is already added into cart or not*/
            if(isset($_SESSION['cart'])){
                /*array_column return the array with all book_id*/
                $column = array_column($_SESSION['cart'],'book_id');
                /*in_array check whether book_id present to the array or not*/
                if(in_array($book_id,$column)){
                    /* Redirect to previous page*/
                    header("location: {$_SERVER['HTTP_REFERER']}");
                }else{
                    /*Get the length of the cart*/
                    $count = count($_SESSION['cart']);
                    /* Set the next cart items */
                    $_SESSION['cart'][$count] = $row;
                    header("location: {$_SERVER['HTTP_REFERER']}");
                }
            }else{
                /* If session cart is not set then set book at index zero*/
                $_SESSION['cart'][0] = $row;
                header("location: {$_SERVER['HTTP_REFERER']}");
            }
           
        }
    }

    if(isset($_POST['remove'])){
        /* If remove button isset then capture the book_id*/
        $book_id = $_POST['book_id'];
        foreach($_SESSION['cart'] as $key => $value){
            /* for session cart check book_id */
            if($value['book_id'] == $book_id){
                /*book_id is match then remove book from cart*/
                unset($_SESSION['cart'][$key]);
                /*Rearrange the values of the session cart array*/
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                /*Id session array size become zero then unset session cart variable*/
                if(count($_SESSION['cart']) == 0){
                    unset($_SESSION['cart']);
                }
                header("location: {$_SERVER['HTTP_REFERER']}");
            }
        }
        
    }

?>