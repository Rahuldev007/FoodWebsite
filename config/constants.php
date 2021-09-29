<?php

    //Session Start
    session_start();
    // create constant to store non repeating values
    define('SITEURL','http://localhost/food_order_project/');     //This  constant is defined for the admin to relocate to the index(siteurl)
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    //   Execute query and save data in database
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  //database conncection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());    //selecting database

?>