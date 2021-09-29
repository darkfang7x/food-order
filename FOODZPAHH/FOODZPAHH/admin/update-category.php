<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count= mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
            }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current image:</td>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $current_image; ?>" width="150px" height="120px">
                            <?php
                        }
                        else
                        {
                            echo "<div class='error'>Image has not been added.</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php 

            if(isset($_POST['submit']))
            {
                // get all the values from the form

                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // updating new image

                if(isset($_FILES['image']['name']))
                {
                    // get the image details
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is available or not
                    if($image_name != "")
                    {
                        // image available
                            // A. upload the new image

                                $ext = end(explode('.', $image_name));

                                $image_name = "Food_category_".rand(000, 999).'.'.$ext;
                                
                                // upload image only if image is selected
                                if($image_name !="")
                                {

                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/".$image_name;

                                // finally upload the image

                                $upload = move_uploaded_file($source_path, $destination_path);

                                // check whether the image is uploaded or not

                                if($upload==FALSE)
                                {
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                                    header("loaction:".SITEURL.'FOODZPAHH/admin/manage-category.php');

                                    die(); //to stop the data from being inserted after failing to upload image
                                }
                            // B. remove the current image if available

                                if($current_image!="")
                                {
                                    $remove_path = "../images/".$current_image;

                                    $remove = unlink($remove_path);

                                    // check whether the image is removed or not

                                    if($remove==FALSE)
                                    {
                                        // failed to remove the image
                                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                        header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
                                        die();
                                    }
                                }
                                
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                // update the database

                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                // redirect to manage-category
                    // check whether query has been executed or not

                    if($res2==TRUE)
                    {
                        $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                        header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                        header('location:'.SITEURL.'FOODZPAHH/admin/manage-category.php');
                    }

            }
        }

        ?>
    </div>
</div>










<?php include('partials/footer.php') ?>
