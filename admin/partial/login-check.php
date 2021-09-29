<?php

//Authorization:check control

//check wheather the user is logged in or not

if(!isset($_SESSION['user'])) //If user session is not set
{
    //user is not logged in
    //Redirect to login page with message
    $_SESSION['no-login-message'] = '<div class="error text-center">Please login to Access Admin panel</div>';

    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
}

?>