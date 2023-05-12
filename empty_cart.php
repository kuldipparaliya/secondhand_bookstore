<?php
    include "config.php";
    
    session_start();

    unset($_SESSION['cart']);

    header("location: {$_SERVER['HTTP_REFERER']}");

?>
