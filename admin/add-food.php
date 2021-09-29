<?php include('partial/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <?php

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?>

        <form action="" method="post" enctype ="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php  
                            
                                //first display the categories from database
                                //create sql query to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn,$sql);

                                // count rows to check wheather we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count is greater then zero then we have categories 
                                if($count>0)
                                {
                                    //Display categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>   

                                        <?php
                                    }
                                }
                                else
                                {
                                    //No categories to display
                                    ?>
                                    <option value="0">No Categories</option>
                                    <?php
                                }
                                //then display that categories to the dropdown


                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partial/footer.php') ?>

<?php

   //check wheather the submit button is clicked oor not 
   if(isset($_POST['submit']))                             
   {
       //Button is clicked
       //Add food data is database

       //1. get the data from form
       $title =$_POST['title'];
       $description=$_POST['description'];
       $price =$_POST['price'];
       $category =$_POST['category'];

       //check wheather the radio button for featured and active are checked or not
       if(isset($_POST['featured']))
       {
           //button is selected and get the value
           $featured =$_POST['featured'];
       }
       else
       {
           //button is not selected and it will automatically select the default value "No"
           $featured = "No";
       }

       if(isset($_POST['active']))
       {
           //button is selected and get the value
           $active =$_POST['active'];
       }
       else
       {
           //button is not selected and it will automatically select the default value "No"
           $active = "No";
       }
       //2. upload the image if selected
       //Check wheather the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //Get the details of selected image
                    $image_name = $_FILES['image']['name'];

                    //check wheather the image is selected or not and upload image if selected
                    if($image_name!="")
                    {
                        // Auto rename our image
                        //Get the extension of our image(jpg,png,gif,etc) eg. "food1.jpg"
                        $tmp= explode('.',$image_name);
                        $ext = end($tmp); //break image name in 2 or more than 2 parts with sign (eg. .jpg)

                        //Now Rename the image 
                        $image_name = "food_name_".rand(0000,9999).'.'.$ext;  //(eg. food_name_456.jpg)

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/".$image_name;

                        //finally upload image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check wheather the image is uploaded or not
                        //and if the image is not uploaded then we will stop the proces and redirect with the error message
                        if($upload==false)
                        {
                            //failed to upload the image and set message
                            $_SESSION['upload'] = "<div class='error'>Failed To upload Image</div>";
                            //Redirect to add category page
                            header('location:'.SITEURL.'admin/add-food.php');

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

       //3. insert into database
       $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id= $category,
                featured ='$featured',
                active='$active'
                ";

        //execute query
        $res2 = mysqli_query($conn,$sql2);

        //check wheather data inserted or not
        if($res2==TRUE)
        {
            //data inserted successfully
            $_SESSION['add'] = "<div class='success'>Food added Successfully.</div>";

            // Redirect to manage Category page
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to insert the data
            $_SESSION['add'] = "<div class='error'>Failed to add Food.</div>";

            // Redirect to manage Category page
            header('location:'.SITEURL.'admin/add-food.php');
        }

       //4. finally redirect to the manage food page
   }
   
?>