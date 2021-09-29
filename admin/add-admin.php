<?php include('partial/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>

        <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];  // Displaying session message
                unset($_SESSION['add']);  //Removing session message
            }  

        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="your username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class='btn-primary'>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partial/footer.php') ?>

<?php 

// process the value from form and save it to database

// check wheather the buttom is clicked or not 
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // 1. Get the data from form 
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);    //md5 will encrypt password

    // 2. sql query to save data in database
    $sql = "INSERT INTO tbl_admin SET
            full_name ='$full_name',
            username ='$username',
            password = '$password'
    ";

    // 3. Executing query and saving data to the database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    // Check wheather the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //data is inserted
        // echo "data inserted";
        // Create a session variable to display message
        $_SESSION['add']='<div class="success">Admin Added Successfully</div>';
        //Redirect page to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');  //after admin added successfully page will go to manage-admin.php page
    }
    else{
        // data is not inserted 
        // echo "data not inserted";
        $_SESSION['add']='<div class="error">Failed to add Admin</div>';
        //Redirect page to Add Admin
        header('location:'.SITEURL.'admin/add-admin.php');      
    }
}

?>