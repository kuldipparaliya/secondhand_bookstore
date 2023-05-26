<?php

    include "config.php";

    session_start();
    /*Unset the all variable */
    session_unset();
    /*delete the session */
    session_destroy();

    header("location: {$hostname}");
?>