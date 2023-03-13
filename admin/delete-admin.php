<?php
    //include the constants file
    include('../config/constants.php');
    //1.get id of admin to be deleted
    $id = $_GET['id'];
    //2.sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    
    //EXECUTE THE QUERY
    $res = mysqli_query($conn,$sql);

    //check whether the query is executed successfully or not 
    if($res == true)
    {
        //echo "Admin deleted";
        //create session variable to display message 
        $_SESSION['delete'] = "<div class = 'success'>Admin deleted successfully </div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //echo "Failed to delete admin";
        $_SESSION['delete'] = "<div class ='error'  >Admin deletion unsuccessfull,Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //3.Redirect to manage-admin page with message(success/error)


?>