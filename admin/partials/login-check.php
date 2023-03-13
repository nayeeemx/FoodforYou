
<?php
    //AUTHORISATION(ACCESS CONTROL)
    //CHECK WHETHER LOGGED IN OR NOT
    if(!isset($_SESSION['user']))
    {
        //If login is not set
        $_SESSION['no-loginmessage'] = "<div class = 'error'>Please login to access the admin panel.</div>";
        //Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }

?>