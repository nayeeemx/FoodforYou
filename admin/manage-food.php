<?php include('partials/menu.php');?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage food</h1>
                <br /> <br /> <br />

                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>


                <br /> <br /> <br />
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
                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    
                    if(isset($_SESSION['id-change']))
                    {
                        echo $_SESSION['id-change'];
                        unset($_SESSION['id-change']);
                    }
                    if(isset($_SESSION['remove-failed']))
                    {
                        echo $_SESSION['remove-failed'];
                        unset($_SESSION['remove-failed']);
                    }
                    
                 ?>


                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    
                        //Create sql query to add food
                        $sql = "SELECT a.*,b.title as category FROM tbl_food a inner join tbl_category b on a.category_id=b.id";

                        //Execute the query
                        $res = mysqli_query($conn,$sql);

                        //Count the number of rows to check if we have food or not
                        $count = mysqli_num_rows($res);

                        //Create serial number variable and set it 1
                        $sn = 1;

                        if($count > 0)
                        {
                            //We have food in darabase
                            //Get the food from database and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get the value from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                $category = $row['category'];


                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title;?></td>
                                        <td><?php echo $description;?></td>
                                        <td>$<?php echo $price;?>    </td>
                                        <td>
                                            <?php
                                                //Check whether we have image or not
                                                if($image_name =="")
                                                {
                                                    echo "<div class = 'error'>Image not added.</div>";
                                                } 
                                                else
                                                {
                                                    ?>
                                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td><?php echo $category;?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                <?php

                            }
                        }
                        else{
                            //Food not added in DB
                            echo "<tr><td colspan = '7' class = 'error'>Food not added yet.</td></tr>";
                        }
                    ?>

                    
                </table>


            </div>
        </div>
<?php include('partials/footer.php');?>