<?php
    //Include constants
    include('../config/constants.php'); 
    //echo "Delete page";

    if(isset($_GET['id'])&&isset($_GET['image_name'])) //Either use 
    {

        //Process to delete
        //echo "Process to delete";

        //1.Get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.Remove image if available
        if($image_name != "")
        {
            //It has image and needs to be removed
            $path = "../images/food/".$image_name;
            //Remove image file from folder
            $remove = unlink($path);


            //Check whether the image is removed or not
            if($remove == false)
            {
                //Failed to remove image
                $_SESSION['upload']  = "<div class = 'error'>Failed to remove image.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the Process of deleting food 
                die();
            }
        }

        //3.Delete from database
        //4.Redirect to manage food with session message
        $sql = "DELETE FROM tbl_food WHERE id = $id";
        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Check whether the query is executed or not
        if($res == true)
        {
            //Food deleted
            $_SESSION['delete'] = "<div class = 'success'>Food deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //Failed to delete Food
            $_SESSION['delete'] = "<div class = 'error'>Failed to delete food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else{
        //Redirect to manage food page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class = 'error'>Unauthorised access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        
    }
?>