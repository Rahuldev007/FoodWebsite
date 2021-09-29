<?php

    // include constants
    include("../config/constants.php");

    // 1. dESTROY THE SESSION
    session_destroy();   //unset $_SESSION['user]


    // 2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>