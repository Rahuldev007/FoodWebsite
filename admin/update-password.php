<?php include('partial/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1>
            <br>

            <?php

                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];  
                    
                    // create sql query to get the details
                    $sql = "SELECT * FROM tbl_admin WHERE id = $id";

                    //Execute query
                    $res = mysqli_query($conn,$sql);

                    // Check wheather the query is executed or not
                    if($res==TRUE)
                    {
                        //query is executed
                        //Check wheather the data is available or not
                        $count = mysqli_num_rows($res);

                        //check wheather data is available or not
                        if($count==1)
                        {
                            //data is available 


                        }
                        else
                        {
                            //data is not available
                            //Redirecr to manage category page with session message
                            $_SESSION['no-admin-found'] ="<div class='error'>Admin Not Found</div>";

                            //Redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }



                }

            ?>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Passord:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr> 
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit"  name="submit" value="Update Password" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>  
        </div>      
    </div>
<?php include('partial/footer.php') ?>            

<?php

//Check Wheather submit button is clicked or not
if(isset($_POST['submit']))
{
    //button clicked
    // echo "button clicked";

    // 1. Get data from the form
    $id = $_POST['id'];
    $current_pasword = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2. Check wheather the current id and current password exist or not
    $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pasword'";
    
    //Execute query
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    if($res==TRUE)
    {
        // Check wheather user exist or not
        $count = mysqli_num_rows($res);

        if($count==1) 
        {
            // user exist
            // echo "user exist";

            //Check wheather new password and confirm password match or not
            if($new_password==$confirm_password)
            {
                //update password
                // echo "Password match";

                $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password' WHERE id=$id
                        ";

                 // 3. Executing query and saving data to the database
                 $res2 = mysqli_query($conn,$sql2);  
                 
                 // Check wheather the (query is executed) data is inserted or not and display appropriate message
                if($res2==TRUE)
                {
                    //query executed and password is updated
                    // echo "password updated";
                    // Create a session variable to display message
                    $_SESSION['password-updated']='<div class="success">Password Updated Successfully</div>';
                    //Redirect page to manage-admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');  //after password updated successfully,page will go to manage-admin.php page
                }
                else
                {
                    // password is not updated
                    // echo "password not updated";
                    $_SESSION['password-not-update']='<div class="error">Failed to Update password</div>';
                    //Redirect page to Add Admin
                    header('location:'.SITEURL.'admin/manage-admin.php');      
                }
            }
            else
            {
                //Redirect to manage admin page
                $_SESSION['password-not-match'] = '<div class="error">Password did not Match.</div>';

                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            
        }
        else
        {
            //user does not exist
            // echo "user not exist";

            //user not found then set message and redirect to manage admin page
            $_SESSION['user-not-found'] = '<div class="error">User is not Available</div>';

            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

    // 3. Check wheather the New password and Confirm passworrd match or not

    // 4. Then sql query to update password
}

?>