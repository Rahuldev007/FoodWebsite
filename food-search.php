<?php include('partials-front/menu.php'); ?>

    <!-- food-search section starts here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                  //get the search 
                  $search = $_POST['search'];
            ?>
            <h2>Your Search For <a href="#" class="text white"><?php echo $search; ?></a></h2>
        </div>
    </section>
    <!-- food-search section Ends here -->

    <!-- food menu section starts here -->
    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Food Menu</h2>

            <?php     

                //create sql query
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute query
                $res =mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check wheather food is available or not
                if($count>0)
                {
                    //food is available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the data
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $price=$row['price'];
                        $description=$row['description'];

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
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?></p>
                                <p class="food-detail"><?php echo $description;?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>    
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
        </div>
    </section>
    <!-- food menuvbar section Ends here -->

<?php include('partials-front/footer.php'); ?>