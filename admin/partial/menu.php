<?php 

    include('../config/constants.php');

                //And

    include('login-check.php'); 

                  //or  

        //Authorization:check control

    //check wheather the user is logged in or not

    // if(!isset($_SESSION['user'])) //If user session is not set
    // {
        //user is not logged in
        //Redirect to login page with message
        // $_SESSION['no-login-message'] = '<div class="error text-center">Please login to Access Admin panel</div>';

        //Redirect to login page
        // header('location:'SITEURL.'admin/login.php');
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food order website - Home page</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Titillium+Web:ital,wght@1,300&display=swap"
        rel="stylesheet">
</head>
<body>

    <!-- menu section starts  -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- menu section ends  -->
