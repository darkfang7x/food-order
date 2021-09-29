<?php 
    include('../config/constant.php');
    include('login-check.php');
?>


<!DOCTYPE html>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODZPAHH</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <h1 class="top">ADMIN PANEL</h1>
    <!-- Menu Section start -->
    <div class="menu text-center"> 
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
    </div>
    <!-- Menu Section end -->
</body>