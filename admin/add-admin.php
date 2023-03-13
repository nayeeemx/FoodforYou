<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />

        <?php
            if(isset($_SESSION['add']))//checking if the session is set or not
            {
                echo $_SESSION['add'];//displaying the session
                unset ($_SESSION['add']);//removing the session mesage
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name" >
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="user_name" placeholder="Enter Username" >
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password" >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
    </div>
</div>





<?php
    //Process the value from form and save in database
    //Check whether the bottom is clicked or not 
    if(isset($_POST['submit'])) 
    {
        //Button clicked
        //1.Get the data from form 
        
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        $password = md5($_POST['password']);  //Password encription with md5 
        

        //2.Create the sql query to insert data into databse

        $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$user_name',
        password = '$password' 
                ";

        //3.Execute the query and store it in database

        $res = mysqli_query($conn, $sql) or die(mysqli_error()); 

        //4.Check whether the data (Query execution) is inserted ot not and display message
        
        if($res==true)
        {
            //echo 'Data is inserted';
            //creating session variable to display message
            $_SESSION['add']="<div class = 'success'>Admin added successfully.</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php'); 
        }
        else{
            //echo 'Error in inserting data';
            //creating session variable to display message
            $_SESSION['add']="<div class = 'error'>Error in adding admin  </div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php'); 
        }
    }
    

?>

<?php include('partials/footer.php');?>