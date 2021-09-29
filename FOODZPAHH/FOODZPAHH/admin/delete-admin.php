
<?php

    include('../config/constant.php');

    // get the id of admin to be deleted
    $id = $_GET['id'];

    // create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed successfully or not
    if($res==TRUE)
    {
        $_SESSION['delete'] = "<div class='success'>Admin removed successfully.</div>";
        header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to remove admin. Try again later.</div>";
        header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
    }
    // redirect to manage admin page 


?>