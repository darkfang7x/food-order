<?php include('config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Profile</title>
    <link rel="stylesheet" href="../CSS/user.css">
</head>
<body>
    <h1 class="text-center h1-color">Update Your Profile</h1><br><br>
    <div class="profile">
        <div class="wrapper">
            <?php
            // Get the id of the selected user
            $id=$_GET['id'];
            
            // create sql query to get the details
            $sql = "SELECT * FROM tbl_user WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $email = $row['email'];
                }
                else
                {
                    // redirect to user profile page
                    header('location:'.SITEURL.'FOODZPAHH/cleint/user-profile.php');
                }
            }

            ?>

            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

            ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td class="header">Full name</td>
                </tr>
                <tr>
                    <td class="data">
                    <input class="update-plc" type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="header">Username</td>

                </tr>
                <tr>
                    <td class="data">
                    <input class="update-plc" type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="header">E-mail</td>
                </tr>
                <tr>
                    <td class="data">
                    <input class="update-plc" type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                    <td><input type="submit" name="SUBMIT" value="Save" class="btn-affirmative"></td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</body>
</html>

<?php
    // check whether the submit button is clicked or not
    if(isset($_POST['SUBMIT']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        // echo $id;
        // echo $username;
        // create sql query to update 

        $sql = "UPDATE tbl_user SET
        full_name = '$full_name',
        username = '$username',
        email = '$email'
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['update'] = "<div class='success'>User details updated successfully.</div>";
            
            header('location:'.SITEURL.'FOODZPAHH/client/user-profile.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to update user details. Please try again.</div>";

            header('location:'.SITEURL.'FOODZPAHH/client/update-profile.php');
        }
    }

?>