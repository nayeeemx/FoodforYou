<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>

        <br><br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>

        <!--Add category form starts-->
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder = "Category title">
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name = "image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value = "Yes"> Yes
                        <input type="radio" name="featured" value = "No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value = "Yes"> Yes
                        <input type="radio" name="active" value = "No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan = "2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <!--Add category form ends-->

        <?php
            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                echo "Button clicked";
                
                //1.Get the value from form
                $title = $_POST['title'];
                echo $title;
                //For radio selected or not
                if(isset($_POST['featured'])){
                    //Get the value from form
                    $featured = $_POST['featured']; 
                }
                else{
                    //Set the default value
                    $featured = "No";

                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = "No";
                }

                //Check whether the image is selected or not
                //print_r($_FILES['image']);
                //die();//break the code here

                if(isset($_FILES['image']['name'])){
                    //Upload the image
                    //To upload image we need image name source path and destination path
                    $image_name = $_FILES['image']['name'];
                    //Autorename image
                    //Get the extension(jpg,png)eg.good1.jpg

                    if($image_name != ""){
                         $ext = end(explode('.',$image_name));

                        //Rename the image
                        $image_name = "food_category_".rand(000,999).'.'.$ext;


                        $source_path = $_FILES['image']['tmp_name'];



                        $destination_path = "../images/category/".$image_name;

                        //Finally upload the image
                        $upload = move_uploaded_file($source_path , $destination_path);

                        //Check whether the image is uploaded or not
                        //And if not uploaded then we will stop the process and redirect with error message
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class = 'error'>Failed to upload image.</div>";

                            header("location:".SITEURL.'admin/add-category.php');
                            //Stop the process
                            die();
                        }

                    }
                   

                }
                else{
                    //Dont upload image and set the image name value as blank
                    $image_name="";
                }

           

                //2.Create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET 
                        title = '$title' ,
                        image_name = '$image_name',
                        featured = '$featured' ,
                        active = '$active' 
                        ";

                //3.Execte the db query 
                $res =  mysqli_query($conn,$sql);

                //4.Check whether the query is executed or not and data added or not
                
                if($res == true){
                    //Query executed and category added 
                    $_SESSION['add'] = "<div class = 'success'>Category added successfully.</div>";
                    //Rediect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //Failed to add category
                    $_SESSION['add'] = "<div class = 'error'>Failed to add category.</div>";
                    //Rediect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>