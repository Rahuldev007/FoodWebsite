<?php include('partial/menu.php') ?>


    <!-- main content starts  -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin </h1>
            <br>

            <?php 

                if(isset($_SESSION['add']))  // check if session is successfull the it will disply message
                {
                    echo $_SESSION['add'];   // Displaying session message
                    unset($_SESSION['add']);  // Removing session message
                }
                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                
                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['no-admin-found']))
                {
                    echo $_SESSION['no-admin-found'];
                    unset($_SESSION['no-admin-found']);
                }

                if(isset($_SESSION['password-not-match']))
                {
                    echo $_SESSION['password-not-match'];
                    unset($_SESSION['password-not-match']);
                }

                
                if(isset($_SESSION['password-updated']))
                {
                    echo $_SESSION['password-updated'];
                    unset($_SESSION['password-updated']);
                }

                
                if(isset($_SESSION['password-not-update']))
                {
                    echo $_SESSION['password-not-update'];
                    unset($_SESSION['password-not-update']);
                }

                
            ?>
            <br><br>
            <!-- Button to add admin  -->
            <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>


            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <!-- Query to display all data of the admin(database)     -->
                <?php 
                
                $sql = 'SELECT * FROM tbl_admin';

                // Execute the query 
                $res = mysqli_query($conn,$sql);

                // Check wheather the query is executed or not
                if($res==TRUE)
                {
                    // Count rows to check wheather we have data in database or not
                    $count = mysqli_num_rows($res);  //This function will count total number of rows in "tbl_admin" table of *food-order* db
                    
                    // To remove the sn. issue we need to create our insitial variable 
                    $sn = 1;

                    //check number of rows
                    if($count>0)
                    {
                        //we have data in database

                        while($rows = mysqli_fetch_assoc($res))
                        {
                            //Using while loop to get all the data from database

                            //while loop will run as long as we have data in database

                            //get individual data
                            $id = $rows['id']; //get data of id from table
                            $full_name = $rows['full_name']; //'full_name' of right side is taken from table heading to get data
                            $username = $rows['username'];   //'username' of right side is taken from table heading to get data

                            //Displaying the value in our table                                //   <---------- tr is came from line number 89 to display data in table
                            ?>

                            <tr>
                                <td> <?php echo $sn++ ; ?> </td>                                
                                <td> <?php echo $full_name; ?> </td>
                                <td> <?php echo $username;  ?> </td>

                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Update Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                </td>

                             </tr>    

                            <?php
                        }
                    }
                    else
                    {
                        // we do not have data in database    
                    }
                }
                
                ?>
               <!-- 
                <tr>
                    <td>1</td>
                    <td>Rahul Dev</td>
                    <td>rahuldev007</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Rahul Dev</td>
                    <td>rahuldev007</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Rahul Dev</td>
                    <td>rahuldev007</td>
                    <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>
                    </td>
                </tr> -->
            </table>

              
            <div class="clearfix"></div>
        </div> 
    </div>
    <!-- main content ends  -->


<?php include('partial/footer.php') ?>