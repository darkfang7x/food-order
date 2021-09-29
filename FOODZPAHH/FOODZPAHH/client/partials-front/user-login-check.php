<?php 
    // check whether the user is logged in or not 
    // Authorisation

    if(!isset($_SESSION['user']))   //if user is not set i.e. user is not logged in
    {
        $_SESSION['no-login-text'] = "<div class='error'> Please log in to access. </div>";

        header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
    }

?>
