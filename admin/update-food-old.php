<?php include('partials/menu.php');?>

<?php
    //Check whether id is set or not
    if(isset($_GET['id']))
    {
        //Get the id and other details
        //echo "getting the data";
        
        $id = $_GET['id'];

        //echo $id;
        //Create id to get all other details
        $sql = "SELECT * FROM tbl_food WHERE id = $id";
        //Execute query
        $res = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
        //Count the rows to check whether the id is valid or not
          
        //Get all the data
        

        $title = $row['title'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active']; 
        $description = $row['description'];
        $current_category = $row['category_id'];
        $price = $row['price'];
              
    }
    else
    {
        //redirect to manage category
        $_SESSION['id-change'] = "<div class = 'error'>Id was tried to change in url --SECURITY ALERT.</div>";
        /*****************My work***************/
        header('location:'.SITEURL.'admin/manage-food.php');
    }
        
?>


<div class = "main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name = "title" value="<?php echo $title;?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>


                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ;?>">

                    </td>
                <tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //Display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            else{
                                //Display message
                                echo "<div class = 'error'>Image not added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name = "image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                //Query to Get active category
                                $sql2 = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                //Execute query
                                $res2 = mysqli_query($conn,$sql2);
                                $count2 = mysqli_num_rows($res2);

                                //Check whether category available or not
                                if($count2 > 0)
                                {
                                    //Category available
                                    while($row2 = mysqli_fetch_assoc($res2))
                                    {
                                        $category_title = $row2['title'];
                                        $category_id =  $row2['id'];

                                        //echo "<option value = '$category_id'>$category_title</option>";
                                        ?>
                                            <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }

                                }
                                else{
                                    //Category not available
                                    echo "<option value='0'>Category not available.</option>"; 
                                }
                            ?>
                            <option value="0">Test category</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value ="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value ="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update Food" class="btn-secondary">
                    </td>
                    
                </tr>

            </table>
        </form>


        <?php
            if(isset($_POST['submit']))
            {
                
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //updating new image
                //Checking whether the image is selected or not
                if(isset($_FILES['image']['name'])){
                    //Get the image details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    //echo $image_name;
                    //die();
                    if($image_name != "")
                    {
                        //image available
                        //A.Upload the new image

                        
                        $ext = end(explode('.',$image_name));

                        //Rename the image
                        $image_name = "food_name_".rand(000,999).'.'.$ext;


                        $source_path = $_FILES['image']['tmp_name'];



                        $destination_path = "../images/food/".$image_name;

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path , $destination_path);

                        //Check whether the image is uploaded or not
                        //And if not uploaded then we will stop the process and redirect with error message
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class = 'error'>Failed to upload image.</div>";

                            header("location:".SITEURL.'admin/add-food.php');
                            //Stop the process
                            die();
                        }
                        //B.Remove the current image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove == false){
                                //Failed to remove image
                                $_SESSION['failed-remove']="<div class = 'error'>Failed to remove image.</div>";
                                //redirect page to manage admin
                                header("location:".SITEURL.'admin/manage-food.php'); 
                                die();
                            }


                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }



                //Update the database 
                $sql2 = "UPDATE tbl_food SET 
                        title = '$title',
                        image_name='$image_name',
                        featured = '$featured',
                        active = '$active',
                        category_id = '$category',
                        description = '$description',
                        price = '$price'
                        WHERE id =$id
                        ";
                //Execute the query
                $res2 = mysqli_query($conn,$sql2);
                
                //Redirect to manage category with message 
                //Check whether the query is executed or not
                if($res2 == true)
                {
                    //Category update
                    $_SESSION['update'] = "<div class = 'success'>Food updated successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //Failed to update category
                    $_SESSION['update'] = "<div class = 'error'>Failed to update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
            
        
        ?>

    </div>
</div>




<?php include('partials/footer.php');?>