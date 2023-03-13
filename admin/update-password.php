<?php include('partials/menu.php')?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Change password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action = "" method = "POST">
            <table class = "tbl-30">
                <tr>
                    <td>Current password:</td>
                    <td>
                        <input type = "password" name = "current_password" placeholder = "Old password">

                    </td>
                </tr>
                <tr>
                    <td>New password:</td>
                    <td>
                        <input type = "password" name = "new_password" placeholder = "New password">

                    </td>
                </tr>
                <tr>
                    <td>Confirm password:</td>
                    <td>
                        <input type = "password" name = "confirm_password" placeholder = "Confirm password">

                    </td>
                </tr>
                <tr>
                    <td colspan="2">    
                        <input type = "hidden" name = "id" value = "<?php echo $id;?>">
                        <input type="submit" name="submit" value = "Change password" class = "btn-secondary">

                    </td>
                </tr>

            </table>

        </form>

    </div>

</div>

<?php
    //Check whether the submit buttton is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button is clicked ";
        //1.Get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2.Check whether the user with current id and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";


        //Execute the query
        $res = mysqli_query($conn,$sql);

        if($res == true)
        {
            //Check whether the data is available or not
            $count = mysqli_num_rows($res);
            if($count == 1){
                    //echo "User Found";
                    //Check whether the new password and confirm matches
                    if($new_password==$confirm_password)
                    {
                        //update password
                        $sql2 = "UPDATE tbl_admin SET
                                    password = '$new_password'
                                    WHERE id = $id
                                    ";
                        $res2 = mysqli_query($conn,$sql2);
                        
                        if($res2 == true)
                        {
                            $_SESSION['change-password'] =  "<div class = 'success' >Password updated .</div>";
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }
                        else{
                            $_SESSION['change-password'] =  "<div class = 'error' >Error updating password .</div>";
                            header("location:".SITEURL.'admin/manage-admin.php');
                        }

                    }
                    else{
                        //Redirect to manage admin with error message
                        $_SESSION['password-not-matched'] =  "<div class = 'error' >New password and Confirm password doesnt match.</div>";
                        header("location:".SITEURL.'admin/manage-admin.php'); 
                    }

            }
            else{
                $_SESSION['user-not-found'] =  "<div class = 'error' >User not found.</div>";
                header("location:".SITEURL.'admin/manage-admin.php'); 
            }
        }
        //3.Check whether the current password and confirm password match or not

        //4.Change password if all the above conditions are satisfied

    }
?>


<?php include('partials/footer.php')?>
