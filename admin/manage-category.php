<?php include('partial/menu.php') ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Manage Category </h1>
            <br>

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

                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }


            ?>
            <br>
            
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br>

            
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php

                    //Query to get datafrom database
                    $sql = "SELECT * FROM tbl_category";

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
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                        
                                            if($image_name!="")
                                            {
                                                //Display Image
                                                ?>

                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

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
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
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
                            <td colspan="6"><div class="error">No category Added</div></td>
                        </tr>

                        <?php
                    }

                ?>

            </table>
             <div class="clearfix"></div>
        </div> 
    </div>
<?php include('partial/footer.php') ?>