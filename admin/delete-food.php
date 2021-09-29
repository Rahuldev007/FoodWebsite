<?php

//include constants file here
include('../config/constants.php');

//First get id of food to be deleted
$id = $_GET['id'];

//sql query to delete food
$sql = "DELETE FROM tbl_food WHERE id =$id";

//Execute query
$res = mysqli_query($conn,$sql);

if($res==TRUE)
{
    //query executed
    // echo "food deleted";

    //Create session variable to display message
    $_SESSION['delete'] = ' <div class="success">
                               Food deleted Successfully
                            </div>';

    //Redirect to manage food page
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    //query not executed
    // echo "food not deleted";

    //Create session variable to display message
    $_SESSION['delete'] = ' <div class="error">
                                Requested Food not deleted
                            </div>';

    //Redirect to manage food page
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>