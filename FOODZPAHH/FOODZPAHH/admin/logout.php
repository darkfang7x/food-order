<?php
    // destroy the session and redirect to login page
    include('../config/constant.php');

    session_destroy();

    header('location:'.SITEURL.'FOODZPAHH/admin/login.php');

?>