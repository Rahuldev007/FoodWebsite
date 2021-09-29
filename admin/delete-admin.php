<?php

//include constant file here
include('../config/constants.php');

// 1. First getting id of admin to be deleted
 $id = $_GET['id'];

// 2. second writing sql queries to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res = mysqli_query($conn,$sql);

//Check wheather query executed or not
if($res==TRUE)
{
    //query executed
    // echo 'query executed';

    //Create session variable to display message
    $_SESSION['delete'] = ' <div class="success">
                                Admin deleted Successfully
                            </div>';

    //Redirect to manage Admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
    //query not executd
    // echo 'query not executed or admin not deleted';
    $_SESSION['delete'] = ' <div class="error">
                                Admin Not Deleted Successfully
                            </div>';

    // Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
// 3. Then redirecting to manage admin page after deleting admin with message(success/error)


?>

