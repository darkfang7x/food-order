<?php include('config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD USER</title>
    <link rel="stylesheet" href="../CSS/add-user.css">
</head>
<body>
<div class='main-content'>
<h1>Welcome New User</h1>
    <div class='wrapper'>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
        <table>
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter your name"></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Enter your username"></td>
            </tr>
            <tr>
                <td>E-mail: </td>
                <td><input type="text" name="email" placeholder="Enter your email"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Enter your password"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" name="submit" value="Register" class="btn-secondary">
                </td>
            </tr>
        </table>    
        </form>
        <p class="para">Already existing user? Please <a href="user-login.php">sign in</a>.</p>
    </div>
</div>
</body>
</html>


<?php
    // process the value from form and save it in database
    // check whether the submit button is clicked or not


    if(isset($_POST['submit'])){
        // button clicked
        // echo "Button clicked";
        // get data from form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password']; //md5 is a one-way encryption method

        // sql query to save data 

        $sql = "INSERT INTO tbl_user SET
            full_name='$full_name',
            username='$username',
            email='$email',
            password='$password'
        ";

        // executing query and saving data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // check whether the data is inserted or not
        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Successfully Registered. Please sign in.</div>";
            // Redirect page to manage admin
            header("location:".SITEURL.'FOODZPAHH/client/user-login.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to register.</div>";
            // Redirect page to add admin
            header("location:".SITEURL.'FOODZPAHH/client/add-user.php');
        }
    }
?>