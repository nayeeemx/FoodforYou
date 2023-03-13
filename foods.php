<?php include('partials-front/menu.php');?>

    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <form action="<?php SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Display food that are active
                $sql="SELECT * FROM tbl_food WHERE active = 'Yes'";

                //Execute the query
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                //Check whether food available or not
                if($count >0)
                {
                    //Food avalailable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values 
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        $price = $row['price'];
  

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                //Image available check

                                if($image_name == "")
                                {
                                    echo "<div class = 'error'>Image not available.</div>";
                                }
                                else{
                                    ?>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>">
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                    </a>

                                    <?php
                                }


                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail">
                                <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>



                        <?php
                    }
                }
                else{
                    //Food not available
                    echo "<div class = 'error'>Food not available.</div>";
                }
            ?>

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php');?>
