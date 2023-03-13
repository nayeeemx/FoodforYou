<?php include('../config/constants.php')?>

<html>
    <head>
        <title>Login - Food order system</title>
        <link rel="stylesheet" href="../css/admin.css" class = "text-center"> 
    </head>
    <body>
        <div class = "login text-center">
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-loginmessage']))
                {
                    echo $_SESSION['no-loginmessage'];
                    unset($_SESSION['no-loginmessage']);
                }
            ?>
            <br >

            <h1 class ="text-center">Login</h1>
            <br>
            <!--LOGIN FORM STARTS HERE-->
            <form action="" method = "POST">
                Username <br>
                <input type="text" name = "username" placeholder = "Enter the username"><br><br>
                Password <br>
                <input type="password" name = "password" placeholder = "Enter password"><br><br>
                <input type = "submit" name = "submit" value = "Login" class = "btn-primary">
                <br><br> 
            </form>

            <!--LOGIN FORM ENDS HERE-->
            <p class = "text-center">Created By - <a href="www.nayeeemx.com">Mohammed Nayeem</a></p>
        </div>

    </body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        //1.Get th data from login
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2.SQL to check the exitence of the user and password
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND PASSWORD = '$password'";
        
        //3.Execute the query
        $res = mysqli_query($conn,$sql);

        //4.Count the number of rows
        $count = mysqli_num_rows($res);

        if($count == 1){
            //User available
            $_SESSION['login'] = "<div class = 'success'> Login successful.</div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in our not
            //Redirect to homepage
            header('location:'.SITEURL.'admin/');
        }
        else{
            //User not available
            $_SESSION['login'] = "<div class = 'error text-center'> Username and password did not match.</div>";
            //Redirect to homepage
            header('location:'.SITEURL.'admin/login.php');

        }


         
                
    }
?>

