<?php include('partials-front/menu.php'); ?>

    <!-- food-search section starts here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="search for food.." required>
                <input type="submit" value="search" name="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- food-search section Ends here -->

    <?php

        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>

    <!-- categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //create sql query to get data from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' limit 3";

                //execute query
                $res= mysqli_query($conn,$sql);

                //count the rows
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //category is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the data 
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                            <a href="categories.php">
                                <div class="box-3 float-container">
                                    <?php
                                        //check wheather image name is available or not
                                        if($image_name=="")
                                        {
                                            //image is not available
                                            echo "<div class='error'>image is available</div>";

                                        }
                                        else
                                        {
                                            //image is available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curved">
                                            <?php
                                        }
                                    ?>
                                    
                                    <h3 class="float-text float-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //category is not available
                    echo "<div class='error'>Category is not available</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- categories section Ends here -->

    <!-- food menu section starts here -->
    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php

                //create sql query to get data from database
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 2";

                //execute query
                $res2=mysqli_query($conn,$sql2);

                //count number of rows
                $count2 =mysqli_num_rows($res2);

                if($count2>0)
                {
                    //food id available 
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //get the data
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $image_name=$row2['image_name'];
                        $price=$row2['price'];
                        $description=$row2['description'];
                        
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php
                                        //check wheather image is available or not
                                        if($image_name=="")
                                        {
                                            //image is not available
                                            echo "<div class='error'>image is not available</div>";
                                        }
                                        else
                                        {
                                            //image is available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curved">
                                            <?php
                                        }

                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                                <div class="clearfix"></div>
                                
                            </div>

                        <?php
                    }
                }
                else
                {
                    //food is not available
                    echo "<div class='error'>Food is not available</div>";
                }
            
            ?>
            <div class="clearfix"></div>
            <div class="see-all-foods text-center">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- food menuvbar section Ends here -->

<?php include('partials-front/footer.php'); ?>