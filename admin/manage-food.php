<?php include('partial/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food </h1>
        <br>
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br>

        <?php
                
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
                
            if(isset($_SESSION['no-food-found']))
            {
                echo $_SESSION['no-food-found'];
                unset($_SESSION['no-food-found']);
            }

            if(isset($_SESSION['remove-failed']))
            {
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

        ?>
            
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

                    //Query to get datafrom database
                    $sql = "SELECT * FROM tbl_food";

                    //execute query
                    $res = mysqli_query($conn,$sql);

                    // count the rows
                    $count = mysqli_num_rows($res);

                    //create sn. variable and assign value as 1
                    $sn = 1;

                    // check wheather we have data in database or not
                    if($count>0)
                    {
                        //we have data in database
                        // Get the data and display
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php 
                                            //check wheather we have image or not
                                            if($image_name!="")
                                            {
                                                //Display Image
                                                ?>

                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                                <?php
                                            }
                                            else
                                            {
                                                //Display message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }

                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>

                            <?php

                        }
                    }
                    else
                    {
                        // we do not have data in database
                        // we will disolay the message inside the table
                        ?>

                        <tr>
                            <td colspan="7"><div class="error">Food not added Yet.</div></td>
                        </tr>

                        <?php
                    }

            ?>
        </table>
              
        <div class="clearfix"></div>
    </div> 
</div>
<?php include('partial/footer.php') ?>