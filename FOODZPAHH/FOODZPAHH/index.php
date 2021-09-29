<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOODZPAHH SNACKS 'N' BEVERAGES</title>
    <link rel="stylesheet" href="CSS/first.css">
</head>
<body>
    <h1>FOODZPAHH SNACKS 'N' BEVERAGES</h1>
    <div class="entry">
        <div class="core">
            <h2 class="text-center">Log in as: </h2>
            <form action="" method="POST">
                <table id="t01" class="text-center">
                    <tr>
                    <td>
                        <input type="radio" name="login_as" value="admin">  ADMIN
                        <input type="radio" name="login_as" value="user">  USER
                    </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="CONTINUE" class="btn-cont">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="footer">2021 All rights reserved. FOODZPAHH SNACKS 'N' BEVERAGES.</div>
    </div>
</body>
</html>


<?php
    if(isset($_POST['submit']))
    {
        if(isset($_POST['login_as']))
        {
            // get the value from form
            $login_as = $_POST['login_as'];
        }
        else
        {
            // set the default value
            $login_as = "admin";
        }

        if($login_as=='admin')
        {
            header('location: admin/');
        }
        else
        {
            header('location: client/user-login.php');
        }
    }
?>