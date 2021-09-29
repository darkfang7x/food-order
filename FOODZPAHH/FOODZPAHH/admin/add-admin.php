<?php include('partials/menu.php'); ?>


<div class='main-content'>
    <div class='wrapper'>
        <h1> ADD ADMIN</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter your name"></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Enter your username"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Enter your password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>    
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
    // process the value from form and save it in database
    // check whether the submit button is clicked or not


    if(isset($_POST['submit'])){
        // button clicked
        // echo "Button clicked";
        // get data from form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password']; //md5 is a one-way encryption method

        // sql query to save data 

        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        // executing query and saving data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // check whether the data is inserted or not
        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            // Redirect page to manage admin
            header("location:".SITEURL.'FOODZPAHH/admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'FOODZPAHH/admin/add-admin.php');
        }
    }
?>