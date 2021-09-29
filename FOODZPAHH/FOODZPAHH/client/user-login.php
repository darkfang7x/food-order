<?php include('config/constant.php'); ?>

<html>
    <head>
        <title>Login- Food Order System</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">LOGIN</h1>

            <?php
                if(isset($_SESSION['log-in']))
                {
                    echo $_SESSION['log-in'];
                    unset($_SESSION['log-in']);
                }

                if(isset($_SESSION['no-login-text']))
                {
                    echo $_SESSION['no-login-text'];
                    unset($_SESSION['no-login-text']);
                }

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            ?>
            <br>

            <!-- login form begins -->

            <form action="" method="POST" class="text-center form-body">
                Username:
                <input type="text" name="username" placeholder="Enter username">
                <br><br>
                Password:
                <input type="password" name="password" placeholder="Enter password">
                <br><br>
                
                <input type="submit" name="submit" value="LOG IN" class="btn-special">
            </form>

            <!-- login form ends -->

            <p class="text-center form-body">New User? Register yourself <a href="add-user.php">here.</a></p>

            <p class="text-center form-body">2021 All rights reserved. FOODZPAHH SNACKS 'N' BEVERAGES.</p>
        </div>
        </div>
    </body>
</html>

<?php
// check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // process the login form

    // get the data from login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // sql to check whether the user and password exists or not

    $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count==1)
    {
        // user availble

        $_SESSION['log-in'] = "<div class='success'> Welcome Back !! </div>";

        // to check whether the user is logged in or not
        $_SESSION['user'] = $username;

        while($row = mysqli_fetch_assoc($res))
        {
            $_SESSION['user_id'] = $row['id'];
        }

        header('location:'.SITEURL.'FOODZPAHH/client/client_home.php');
    }
    else
    {
        // user unavailable

        $_SESSION['log-in'] = "<div class='error'> Please check the username or the password you've provided !! </div>";
        header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
    }
}



?>