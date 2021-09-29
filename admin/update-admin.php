<?php include('partial/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br>

            <?php  
            
            //1.Get the id of selected Admin
            $id = $_GET['id'];

            //2. create sql query to get the detail
            $sql = "SELECT * FROM tbl_admin where id=$id";

            //3. Execute the query
            $res = mysqli_query($conn,$sql);

            //Check wheather the query is executed or not
            if($res==TRUE)
            {
                //Check wheather the data is available or not
                $count = mysqli_num_rows($res);

                //Check wheather we have admin data or not
                if($count==1)
                {
                    //Get the Details
                    // echo "Admin is Available";
                    $rows = mysqli_fetch_assoc($res);
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                }
                else
                {
                    //Redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

            
            ?>

            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" value= "<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit"  value="Update Admin"  class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partial/footer.php') ?>

<?php

//Check Submit button is Clicked or not

if(isset($_POST['submit']))
{
    //button clicked
    // echo 'Button clicked';
    // 1. Get the data from form to update
    $id = $_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    
    // 2. sql query to update admin
    $sql = "UPDATE tbl_admin SET 
            full_name ='$full_name', 
            username ='$username' where id ='$id' 
           ";

    // 3. Executing query and saving data to the database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    // Check wheather the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //query executed and admin is updated
        // echo "data updated";
        // Create a session variable to display message
        $_SESSION['update']='<div class="success">Admin Updated Successfully</div>';
        //Redirect page to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');  //after admin added successfully page will go to manage-admin.php page
    }
    else{
        // data is not inserted
        // echo "data not inserted";
        $_SESSION['update']='<div class="error">Failed to Update Admin</div>';
        //Redirect page to Add Admin
        header('location:'.SITEURL.'admin/update-admin.php');      
    }
}

?>