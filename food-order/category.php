<?php include('partials-front/menu.php');?>

    <!-- Navbar Section Ends Here -->
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="category-search text-center">
        <div class="container">
            
            <form action="category-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Category.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Display all the categories
                //Create sql query

                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                //Execute 
                $res = mysqli_query($conn,$sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether category is available or not
                if($count >0)
                {
                    //Categories available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                    
                        ?>
                        <a href="<?php echo SITEURL; ?>category-food.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                <?php 
                                    if($image_name == "")
                                    {
                                            //image not available 
                                            echo "<div class = 'error'>Image not found.</div>";
                                        }
                                    else 
                                    
                                        {
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                                            <?php
                                        }
                                ?>     
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                        </a>
    
                        <?php

                    }
                }
                else{
                    //Categories not available
                    echo "<div class = 'error'>Category not added.</div>";
                }
            ?>

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>
