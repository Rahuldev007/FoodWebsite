<?php

//include constants file here
include('../config/constants.php');

//First get id of category to br deleted
$id = $_GET['id'];

//sql query to delete category
$sql = "DELETE FROM tbl_category WHERE id =$id";

//Execute query
$res = mysqli_query($conn,$sql);

if($res==TRUE)
{
    //query executed
    // echo "category deleted";

    //Create session variable to display message
    $_SESSION['delete'] = ' <div class="success">
                               Category deleted Successfully
                            </div>';

    //Redirect to manage Admin page
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    //query not executed
    // echo "category deleted";

    //Create session variable to display message
    $_SESSION['delete'] = ' <div class="error">
                                Requested Category not deleted
                            </div>';

    //Redirect to manage Admin page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>