<!DOCTYPE html>
<?php
    include('../config/constant.php');
    include('user-login-check.php');

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODZPAHH</title>
    <link rel="stylesheet" href="../CSS/user.css">
    
</head>
<body>  
<div class="app-bar">
    <div class="wrapper">
    <ul>
        <li><a href="<?php echo SITEURL; ?>FOODZPAHH/client/user-profile.php">My Profile</a></li>
        <li><a href="<?php echo SITEURL; ?>FOODZPAHH/client/user-order.php">My Orders</a></li>
        <li><a href="<?php echo SITEURL; ?>FOODZPAHH/client/catalogue.php">Menu</a></li>
        <li><a href="<?php echo SITEURL; ?>FOODZPAHH/client/user-logout.php">Log Out</a></li>
    </ul>
    </div>
</div> 
<a href="<?php echo SITEURL; ?>FOODZPAHH/client/client_home.php">
    <div class="head">
        <img src="../images/foodzpahh_logo.png" alt="Official logo" width="85%" height="20%">
    </div>
</a>
</body>
</html>