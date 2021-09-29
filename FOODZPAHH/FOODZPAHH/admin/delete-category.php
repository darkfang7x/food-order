<?php

include('../config/constant.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // get the value and delete
    
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove the physical image file if available
    if($image_name != "")
    {
        // image is available
        $path = "../images/category/".$image_name;
        // remove the image
        $remove = unlink($path);

        if($remove==FALSE)
        {
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
            
            header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');

            die();
        }
    }

    // delete data from database

    $sql = "DELETE FROM tbl_category where id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";

        header("location:".SITEURL.'FOODZPAHH/admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to remove category.</div>";

        header("location:".SITEURL.'FOODZPAHH/admin/manage-category.php');
    }
    
}
else
{
    // redirect to manage category page
    header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
}

?>