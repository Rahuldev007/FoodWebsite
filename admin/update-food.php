<?php include('partial/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br>

            <?php

                //check wheather the id is selected or not
                if(isset($_GET['id']))
                {
                    //get all the details
                    $id = $_GET['id'];

                    //sql query to get the food
                    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                    //execute the query
                    $res2 =mysqli_query($conn,$sql2);

                    // Check wheather the query is executed or not
                    if($res2==TRUE)
                    {
                        //query is executed
                        //Check wheather the data is available or not
                        $count = mysqli_num_rows($res2);

                        //check wheather data is available or not
                        if($count==1)
                        {
                            //data is available 
                            //getting data from database
                            $row2 = mysqli_fetch_assoc($res2);
                            $title = $row2['title'];
                            $description = $row2['description'];
                            $price = $row2['price'];
                            $current_image = $row2['image_name'];
                            $current_category = $row2['category_id'];
                            $featured = $row2['featured'];
                            $active = $row2['active'];


                        }
                        else
                        {
                            //data is not available
                            //Redirecr to manage category page with session message
                            $_SESSION['no-food-found'] ="<div class='error'>Food Not Found</div>";

                            //Redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }
                    }
                }
                else
                {
                    //id is not selected and will redirect to manage food page
                    header('location:'.SITEURL.'admin/manage-food.php');
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
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price"  value="<?php echo $price; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php

                                if($current_image=="")
                                {
                                    //image is not available
                                    echo "<div class='error'>Image is not available.</div>";
                                }
                                else
                                {
                                    //image is available
                                    ?>

                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" alt="<?php echo $title; ?>" width="150px">

                                    <?php
                                }

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select New Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php

                                    //query to get all the active categories
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    //execute query
                                    $res =mysqli_query($conn,$sql);

                                    //count rows
                                    $count = mysqli_num_rows($res);

                                    //check wheather category is available or not
                                    if($count>0)
                                    {
                                        //category is available
                                        while($row=mysqli_fetch_assoc($res))
                                        {

                                            $category_title = $row['title'];
                                            $category_id = $row['id'];
                                            
                                            ?>
                                            <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>
                                            <?php
                                            
                                        }
                                    }
                                    else
                                    {
                                        //category is not available
                                        echo "<option value='0'>Category is not available.</option>";
                                    }

                                ?>
                                <!-- <option value="0">Test Category</option> -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active"   value="Yes">Yes
                            <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //button clicked
                    // echo "button clicked";

                    //1/ get all the data from form
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $current_image=$_POST['current_image'];
                    $category=$_POST['category'];

                    $featured=$_POST['featured'];
                    $active=$_POST['active'];

                    //2/upload the image if selected

                    //checked wheather the upload button is clicked or not
                    if(isset($_FILES['image']['name']))
                    {
                        //image button is clicked
                        $image_name=$_FILES['image']['name']; //new image name

                        //check wheather the file is available or not
                        if($image_name!="")
                        {
                            //image file is available
                            //rename the image
                            $tmp= explode('.', $image_name);
                            $ext=end($tmp);

                            $image_name="food_name_".rand(000,999).'.'.$ext;

                            //get the source path and the destination path
                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/food/".$image_name;

                            //upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check wheather the image is uploaded or not
                            if($upload==false)
                            {
                                //failed to upload the image and set message
                                $_SESSION['upload'] = "<div class='error'>Failed To upload Image</div>";
                                //Redirect to manage food page
                                header('location:'.SITEURL.'admin/manage-food.php');

                                // Then we will stop the prcess
                                die();
                            }

                            //3.remove the current image if the new image is uploaded
                            //B. removing the current image if available
                            if($current_image!="")
                            {
                                //image is available
                                //remove the image
                                $remove_path="../images/food/".$current_image;
                                $remove=unlink($remove_path);

                                //check wheather the image is removed or not
                                if($remove==false)
                                {
                                    //failed to remove the image
                                    $_SESSION['remove-failed']="<div class='error'>Failed to remove image.</div>";

                                    header('location:'.SITEURL.'admin/manage-food.php');

                                    die();
                                }
                                    
                            }
                            
                        }
                        else
                        {
                            //image button is not clicked so new image will not be uploaded
                            $image_name=$current_image;
                        }
                    }
                    else
                    {
                        //image is not selected
                        $image_name = $current_image;
                    }

                    //4.update the food and database
                    $sql3 ="UPDATE tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                        WHERE id=$id
                    ";

                    //execute the query
                    $res3=mysqli_query($conn,$sql3);
                    
                    //check wheather query is executed or not
                    if($res3==true)
                    {
                        //query is executed and food updated
                        $_SESSION['update']="<div class='success'>Food Updated successfully.</div>";
                        
                        //Redirect to manage food page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to upload the food
                        $_SESSION['update']="<div class='error'>Failed to update food.</div>";
                        
                        //Redirect to manage food page
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>
        </div>
    </div>

<?php include('partial/footer.php'); ?>