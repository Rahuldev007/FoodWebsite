<?php include('partial/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br>

            <?php

                if(isset($_GET['id']))
                {
                    // Id and all other details is selected 
                    // echo "Id is selected";

                    // Getting selected id
                    $id = $_GET['id'];

                    // create sql query to get the details
                    $sql = "SELECT * FROM tbl_category WHERE id = $id";

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
                            //getting data from database
                            $row = mysqli_fetch_assoc($res);
                            $title = $row['title'];
                            $current_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];


                        }
                        else
                        {
                            //data is not available
                            //Redirecr to manage category page with session message
                            $_SESSION['no-category-found'] ="<div class='error'>Category Not Found</div>";

                            //Redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                    }

                }
                else
                {
                    //id is not selected and will redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php

                                if($current_image!="")
                                {
                                    //Display image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width = "150px">    

                                    <?php
                                }
                                else
                                {
                                    //Display message
                                    echo "<div class='error'>Image Not Added</div>";
                                }

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No 
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update CAtegory" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if(isset($_POST['submit']))             
            {
                //clicked
                // echo "clicked";

                //Get data from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image if selected
                //Check wheather image is selected or not
                if(isset(['image']['name']))
                {
                    //image is selected
                    $image_name =$_FILES['image']['name'];

                    //check wheather image is selected or not
                    if($image_name!="")
                    {
                        //image is available

                        //upload the new image
                        //Get the extension of our image(jpg,png,gif,etc) eg. "food1.jpg"
                        $ext = end(explode('.',$image_name)); //break image name in 2 or more than 2 parts with sign(eg. .jpg)

                        //Now Rename the image 
                        $image_name = "food_category_".rand(000,999).'.'.$ext;  //(eg. food_category_456.jpg)
  
                        $source_path = $_FILES['image']['tmp_name'];
  
                        $destination_path = "../images/category/".$image_name;
  
                        //finally upload image
                        $upload = move_uploaded_file($source_path,$destination_path);
  
                        //check wheather the image is uploaded or not
                        //and if the image is not uploaded then we will stop the proces and redirect with the errormessage
                        if($upload==false)
                        {
                         //set message
                         $_SESSION['upload'] = "<div class='error'>Failed To upload Image</div>";
                         //Redirect to add category page
                         header('location:'.SITEURL.'admin/manage-category.php');

                         // Then we will stop the prcess
                         die();
                        }
                        //And remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
    
                            //check wheather the image is removed or not
                            //if image is not removed the set the message and redirect to the manage category page
                            if($remove==false)
                            {
                                //image is  not removed and redirect to the manage category page
                                // echo "remove unsucces";
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();//stopthe
                            }        

                        }
                      
                    }
                    else
                    {
                         //image is not selected
                        $image_name = $current_image;
                    }
                }
                else
                {
                    //image is not selected
                    $image_name = $current_image;
                }

                //update the database
                $sql2 = "UPDATE  tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active' WHERE id = $id
                        ";    

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);
                        
                //Redirect to the manage category page with message

                //Check wheather the query is executed or not
                if($res2==TRUE)
                {
                    //query executed and category updated
                    $_SESSION['update']= '<div class="success">Category Updated Successfully.</div>';
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    // failed to execute query and to update category
                    $_SESSION['update']= "<div class='error'>Failed to Update Category</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }

            ?>
        </div>
    </div>

<?php include('partial/footer.php') ?>
