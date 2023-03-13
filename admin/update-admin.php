<?php include('partials/menu.php');?>

<div class = "main-content">
    <div class="wrapper">
        <h1>Update admin</h1>
        <br><br>

        <?php
            //1.Get the selected admin id
            $id = $_GET['id'];

            //2.Create sql query to get details
            $sql = "SELECT * from tbl_admin where id = $id ";

            //3.Execute the query
            $res = mysqli_query($conn,$sql);

            //check whether the id is executed correctly or not 
            if($res == true )
            {
                //check whether the data us available or not
                $count = mysqli_num_rows($res);

                //check whether we have admin data or not
                if($count == 1)
                {
                    //get the details
                    //echo "Admin available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username']; 
                }
                else{
                    //we will redirect it to manage admin page
                    header("location:".SITEURL.'admin/manage-admin.php');                 
                }
            }
         
        ?>

        <form action="" method="POST">
            <table class = "tbl-30">
                <tr>
                    <td>Full name :</td>
                    <td>
                        <input type = "text" name = "full_name" value = "<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username :</td>
                    <td>
                        <input type = "text" name = "username" value = "<?php echo $username;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type = "hidden" name = "id" value = "<?php echo $id;?>">
                        <input type="submit" name="submit" value = "Update Admin" class = "btn-secondary">

                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>


<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button clicked";
        //Get all the values from the form to update

        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create sql query
        $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id = $id
                ";
        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Check whether the query executed successfully or not
        if($res == true)
        {
            $_SESSION['update']="<div class = 'success'>Admin updated successfully </div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php'); 
        }
        else{
            $_SESSION['update']="<div class = 'error'>Failed to update admin. </div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php'); 
        }
    }
?>


<?php include('partials/footer.php');?>