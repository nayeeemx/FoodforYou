<?php include('partials/menu.php');?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage admin</h1>
                <br /> 
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['add']);//REMOVING SESSION MESSAGE 
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['delete']);//REMOVING SESSION MESSAGE 
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['update']);//REMOVING SESSION MESSAGE 
                    }
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['user-not-found']);//REMOVING SESSION MESSAGE 
                    }
                    if(isset($_SESSION['password-not-matched']))
                    {
                        echo $_SESSION['password-not-matched'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['password-not-matched']);//REMOVING SESSION MESSAGE 
                    }
                    if(isset($_SESSION['change-password']))
                    {
                        echo $_SESSION['change-password'];//DISPLAYING SESSION MESSAGE 
                        unset($_SESSION['change-password']);//REMOVING SESSION MESSAGE 
                    }
                    
                ?>

                <br><br><br>


                <!-- BUTTON TO ADD ADMIN -->

                <a href="add-admin.php" class="btn-primary">Add admin</a>
                
                <br ><br ><br >
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full name</th>
                        <th>username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_admin";
                        //EXECUTE QUERY
                        $res = mysqli_query($conn,$sql);

                        //check whether is executed or not
                        if($res == TRUE)
                        {
                            //count rows
                            $count = mysqli_num_rows($res);
                            $sn = 1 ; //create a variable and assign id =1
                            if($count>0)
                            {
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];


                                    ?>    <!--breaking php !-->
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href = "<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class = "btn-primary">Change password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>


                                    <?php     //starting php
                                
                                }

                                
                            }
                            else{
                                //DO nothing   
                                
                            }
                        }
                    ?>
                </table>

            </div>
        </div>
<?php include('partials/footer.php');?>