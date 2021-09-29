<?php include('partial/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br>

        <!-- Add Category Form Starts Here -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Starts Here -->

        <!-- Check wheather the submit button is clicked or not  -->
        <?php
            //1. Check wheather the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                // button clicked
                // echo "clicked";
                
                //Get the value from category form
                $title = $_POST['title'];

                //For radio input type we need to check wheather the button is selected or not
                if(isset($_POST['featured']))
                {
                    //button is selected and get the value
                    $featured = $_POST['featured'];
                }
                else
                {
                    //button is not selected and it will automatically select default value 'No'
                    $featured = "No";
                }
                if(isset($_POST['active']))
                {
                    // //button is selected and get the value
                    $active = $_POST['active'];
                }
                else
                {
                    //button is not selected and it will automatically select default value 'No'
                    $active = "No";
                }

                //Check wheather the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);

                // die();  //Break the code here

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //To upload image we need image name,source path and destination name
                    $image_name = $_FILES['image']['name'];
                    if($image_name!="")
                    {
                        // Auto rename our image
                        //Get the extension of our image(jpg,png,gif,etc) eg. "food1.jpg"
                        $ext = end(explode('.',$image_name)); //break image name in 2 or more than 2 parts with sign (eg. .jpg)

                        //Now Rename the image 
                        $image_name = "food_category_".rand(000,999).'.'.$ext;  //(eg. food_category_456.jpg)

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //finally upload image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check wheather the image is uploaded or not
                        //and if the image is not uploaded then we will stop the proces and redirect with the error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload'] = "<div class='error'>Failed To upload Image</div>";
                            //Redirect to add category page
                            header('location:'.SITEURL.'admin/add-category.php');

                            // Then we will stop the prcess
                            die();
                        }
                    }        
                }
                else
                {
                    //Don't upload the image and set the image name value as blank
                    $image_name ="";
                }

                // 2. Sql query to insert data in database
                $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        "; 
                        
                // 3. Execute the query
                $res = mysqli_query($conn,$sql);

                // check wheather the query is executed or not
                if($res==TRUE)
                {
                    // query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category added Successfully.</div>";

                    // Redirect to manage Category page
                   header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // failed to add category
                   $_SESSION['add'] = "<div class='error'>Failed to add Category.</div>";

                   // Redirect to manage Category page
                   header('location:'.SITEURL.'admin/add-category.php');
                }


            }
            
        ?>

    </div>
</div>

<?php include('partial/footer.php') ?>
