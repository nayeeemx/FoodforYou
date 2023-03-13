<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method ="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="num" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Create php code to display categories from Databse 
                                //1.Create Sql to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Execiting query 
                                $res = mysqli_query($conn,$sql);

                                //Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                if($count > 0){
                                    //We have categories
                                    while($row=mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }


                                }
                                else{
                                    //We do not have categories
                                    ?>
                                    <option value="0">No Category Found.</option>
                                    <?php
                                }
                                //2.Display on Drpopdown

                            ?>                        
              
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add food in database
                //echo "Clicked";

                //1.get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $active = $_POST['active'];


                //2.Upload the image if selected
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $featured = $_POST['active'];
                }
                else{
                    $featured = "No";
                }

                //3.Insert into database
                //Check whether the image is clicked or not and upload image only if available
                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    if($image_name!="")
                    {
                        //Image is selected
                        //A.Rename the image 
                        //Get the extension of selected image
                        $ext = end(explode('.',$image_name));

                        //Create new name for image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                        //B.Upload the image
                        //Get the source fpath
                        $src = $_FILES['image']['tmp_name'];
                        
                        //Destination path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally upload image
                        echo $src;
                        echo $dst;

                        $upload = move_uploaded_file($src,$dst);

                        //Check whether the image is uploaded or not
                        if($upload == false)
                        {
                            //Failed to upload image 
                            //Redirect to add category with error message and stop the process
                            $_SESSION['upload'] = "<div class = 'error'>Failed to upload image.</div>";

                            header("location:".SITEURL.'admin/add-food.php');
                            //Stop the process
                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                }

                //3.Insert into databse

                //Create sql query to save or add food
                //For numerical value no need to quotes for string we need ''
                $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = '$price',
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //Check whether data inserted or not
                                

                //4.Redirect with message to manage food page
                if($res2 == true)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div clas = 'success'>Food added successfully.</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }
                else{
                    $_SESSION['add'] = "<div clas = 'error'>Failed to update.</div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }
            }
        
        ?>
    </div>

</div>


<?php include('partials/footer.php');?>