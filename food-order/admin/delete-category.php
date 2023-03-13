<?php
    include('../config/constants.php');

    //echo "Delete page";
    if(isset($_GET['id']) AND isset($_GET['image_name']))   
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image if available 
        if($image_name != "")
        {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            //If failed to remove error image then add a message and stop
            if($remove == false)
            {
                //Set the session message
                $_SESSION['remove']  = "<div class = 'error'>Failed to remove category.</div>";
                //Redirect to manage categort
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the session
                die();
                
            }
        }

        //Delete from database 
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn,$sql);

        //Check whether the data is delted from database
        if($res == true){
            //Set success message and redirect
            $_SESSION['delete'] = "<div class = 'success'> Category deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else {
            //Set fail message and redirect 
            $_SESSION['delete'] = "<div class = 'error'>Failed to delete category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }

    }
       
    else{
        //Redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>