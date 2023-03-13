<?php include('partials-front/menu.php');?>

    <?php
    
        //Check whether the food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the food id and details of selected food
            $food_id=$_GET['food_id'];

            //SQL QUERY
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //Count the rows
            $count=mysqli_num_rows($res);
            //Check whether the data is available ir not
            if($count==1)
            {
                //Get the data
                $row=mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];

            }
            else{
                //Food not available
                header('location:'.SITEURL);
            }
        }
        else{
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                            //Check whether image available or not
                            if($image_name=="")
                            {
                                //Image not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else{
                                //Image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">

                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //Cehck whether button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Get all the details
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d h:i:sa"); //Order date

                    $status = "Ordered"; //Ordered , on delivery

                    $customer_name = $_POST['full_name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the order in database
                    //Sql to save data

                    $sql2 = "INSERT INTO tbl_order SET 
                            food = '$food',
                            price = '$price',
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        ";
                    
                    $res2 = mysqli_query($conn,$sql2);

                    //Check whether the query executed or not
                    if($res2 == true)
                    {
                        //QUery executed and saved
                        $_SESSION['order'] = "<div class = 'success text-center'>Food ordered successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class = 'error text-center'>Failed to order.</div>";
                        header('location:'.SITEURL);
                        
                    }
                    
                }
            
                            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials-front/footer.php');?>
