<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="40" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Price">
                    </td>
                </tr>
                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //  php code to display categories from database

                                // sql query to get all active categories 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No active category</option>
                                    <?php
                                }

                                // display on dropdown
                            ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name= "featured" value="Yes"> Yes
                        <input type="radio" name= "featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name= "active" value="Yes"> Yes
                        <input type="radio" name= "active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            // 1. get data from form

            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

                // check whether radio buttons are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

            // 2. upload the image if selected

            if(isset($_FILES['image']['name']))
            {
                // get the details of the selected image
                $image_name = $_FILES['image']['name'];

                // upload only if image is selected
                if($image_name!="")
                {
                    // a. rename the image
                    $ext = end(explode('.', $image_name));

                    $image_name = "Food_name_".rand(0000, 9999).'.'.$ext;
                    
                    // upload image only if image is selected
                    if($image_name !="")
                    {

                    $src = $_FILES['image']['tmp_name'];

                    $dest = "../images/".$image_name;
                    }

                    // b. upload the image
                    $upload = move_uploaded_file($src, $dest);

                    // c. check whether image is uploaded or not
                    if($upload==FALSE)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                        header("loaction:".SITEURL.'FOODZPAHH/admin/add-food.php');

                        die(); //to stop the data from being inserted after failing to upload image
                    }

                }
            }
            else
            {
                $image_name = "";
            }
            // 3.insert into database

            $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'            
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2==TRUE)
            {
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                header("location:".SITEURL.'FOODZPAHH/admin/manage-food.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                header("location:".SITEURL.'FOODZPAHH/admin/add-food.php');
            }

        }
        else
        {

        }

        ?>
    </div>
</div>





<?php include('partials/footer.php'); ?>
