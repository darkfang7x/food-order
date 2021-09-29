<?php include('partials-front/menu.php'); ?>
<?php
if(isset($_SESSION['u_id']))
{
   $id = $_SESSION['u_id'];
}

$sql = "SELECT * FROM tbl_user WHERE id=$id";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count==1)
{
    while($row = mysqli_fetch_assoc($res))
    {
        $full_name = $row['full_name'];
        $username = $row['username'];
        $email = $row['email'];
    }
}
?>
<?php
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

    if(isset($_SESSION['change-pwd']))
    {
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
    }
    
    if(isset($_SESSION['pwd-not-match']))
    {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
    }
    
    if(isset($_SESSION['user-not-found']))
    {
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <div class="welcome">
        <img src="../images/welcome.png" alt="WELCOME">
    </div>
    <div class="profile">
        <div class="wrapper">
            <table id="t01">
                <tr>
                    <td class="header">Full name</td>
                </tr>
                <tr>
                    <td class="data">
                        <?php echo $full_name; ?>
                    </td>
                </tr>
                <tr>
                    <td class="header">Username</td>

                </tr>
                <tr>
                    <td class="data">
                        <?php echo $username; ?>
                    </td>
                </tr>
                <tr>
                    <td class="header">E-mail</td>
                </tr>
                <tr>
                    <td class="data">
                        <?php echo $email; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="buttons">
            <a href="<?php echo SITEURL; ?>FOODZPAHH/client/update-profile.php?id=<?php echo $id; ?>" class="btn-affirmative">Update Your Profile</a>
            <br><br>
            <a href="<?php echo SITEURL; ?>FOODZPAHH/client/change-password.php?id=<?php echo $id; ?>" class="btn-password">Change Your Password</a>
            <br><br>
            <a href="<?php echo SITEURL; ?>FOODZPAHH/client/delete-profile.php?id=<?php echo $id; ?>" class="btn-negative">Delete Your Profile and Leave Us Behind !!</a>
        </div>
    </div>
</body>
</html>