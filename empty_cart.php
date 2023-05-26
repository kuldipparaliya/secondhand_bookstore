<?php
    include "config.php";
    
    session_start();
    /*Unset session cart variable */
    unset($_SESSION['cart']);

    header("location: {$_SERVER['HTTP_REFERER']}");

?>
