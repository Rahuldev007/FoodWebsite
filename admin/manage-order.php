<?php include('partial/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order </h1>
            <br>

            <?php

            if(isset($_SESSION['updated']))
            {
                echo $_SESSION['updated'];
                unset($_SESSION['updated']);
            }

            ?>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Customer Address</th>
                    <th>Actions</th>
                </tr>

                <?php

                    //get data from db
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC";    // ORDER BY id DESC helps in displaying latest order

                    //execute query
                    $res=mysqli_query($conn,$sql);

                    //count rows
                    $count=mysqli_num_rows($res);

                    $sn=1;

                    if($count>0)
                    {
                        //order available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the order details
                            $id=$row['id'];
                            $food=$row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];
                            $total=$row['total'];
                            $order_date=$row['order_date'];
                            $status=$row['status'];
                            $customer_name=$row['customer_name'];
                            $customer_contact=$row['customer_contact'];
                            $customer_email=$row['customer_email'];
                            $customer_address=$row['customer_address'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <!-- ordered,on delivery, delivered and cancelled -->
                                        <?php 

                                            if($status=="ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="on delivery")
                                            {
                                                echo "<label style= 'color:orange;'>$status</label>";
                                            }
                                            elseif($status=="delivered")
                                            {
                                                echo "<label style= 'color:green;'>$status</label>";
                                            }
                                            elseif($status=="cancelled")
                                            {
                                                echo "<label style= 'color:red;'>$status</label>";
                                            }

                                        ?>
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //order is not available
                        
                    }
                 
                ?>
               

            </table>
              
              
             <div class="clearfix"></div>
        </div> 
    </div>
<?php include('partial/footer.php') ?>