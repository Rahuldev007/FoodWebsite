<?php include("../config/constants.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order Website</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login text-center">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>        
        <br>
        <form action="" method="post" class="text-center">
        Username:
        <input type="text" name="username" placeholder="Enter Username"> 
        <br><br>

        Password:
        <input type="password" name="password" placeholder="Enter Password">   
        <br><br>

        <input type="submit" name="submit" value="Login" class="btn-primary">     
        <br><br>
        </form>

        <p class="text-center">Created By-<a href="#">Rahul Dev</a></p>
    </div>
</body>
</html>


<?php

    //Check wheather the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //button clicked
        // 1.Get data from login form
        $username = $_POST['username'];                             //F_admin U_admin1  P_admin2
        $password = md5($_POST['password']);                        //Rahul Dev U_admin  P_admin   


        // 2. sql query to Check wheather the user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. eXECUTE THE QUERY
        $res = mysqli_query($conn,$sql);

        // 4. Count rows to check wheather user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available
            $_SESSION['login']='<div class="success">Login is Successful.</div>';

            $_SESSION['user'] = $username;  //Check wheather the user is logged in or not and logout will unset it.

            // Redirect to admin index page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available
            $_SESSION['login']='<div class="error text-center">Username & Password did not match</div>';

            // Redirect to admin index page
            header('location:'.SITEURL.'admin/login.php');
        }

    }

?>