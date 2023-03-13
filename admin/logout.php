<?php
    //include constants
    include('../config/constants.php');

    //1.Destroy the session and redirect it to login page
    session_destroy();//Unset $_SESSION['user'];

    header('location:'.SITEURL.'admin/login.php');
?>