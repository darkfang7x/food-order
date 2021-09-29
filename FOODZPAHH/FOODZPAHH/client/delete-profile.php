<link rel="stylesheet" href="user.css">
<?php

    include('config/constant.php');

    // get the id of client to be deleted
    $id = $_GET['id'];

    // create sql query to delete client
    $sql = "DELETE FROM tbl_user WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed successfully or not
    if($res==TRUE)
    {
        $_SESSION['delete'] = "<div class='error'>You have been removed successfully. We regret that we'll miss you !!</div>";
        header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to remove user. Try again later.</div>";
        header('location:'.SITEURL.'FOODZPAHH/client/user-profile.php');
    }
    // redirect to manage client page 


?>