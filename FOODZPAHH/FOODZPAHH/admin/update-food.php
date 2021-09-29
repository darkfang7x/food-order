<?php include('partials/menu.php');?>

<?php
        if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
?>
<?php 
    //Check whether id is set or not
    if(isset($_GET['id']))
     {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the selected Food
         $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
         //execute the Query
         $res2 = mysqli_query($conn, $sql2);
         //get the value based on query executed
         $row2 = mysqli_fetch_assoc($res2);

         //Get the individual value of selected food
         $title = $row2['title'];
         $description = $row2['description'];
         $price = $row2['price'];
         $current_image = $row2['image_name'];
         $current_category = $row2['category_id'];
         $featured = $row2['featured'];
         $active = $row2['active'];


     }
     else
     {
        //Redirect to manage food
        header('location'.SITEURL.'admin/manage-food.php');
     }

?>
<div class ="main-content">
  <div class = "wrapper">
     <h1>Update Food</h1>

       <br><br>
       <form action="" method ="POST" entype="multipart/form.data">
       
       <table class ="tbl-30">
       
       <tr>
          <td>Title:</td>
          <td>
              <input type="text" name="title" value = "<?php echo $title; ?>" >
          </td>
       
       </tr>

       <tr>
          <td>Description:</td>
          <td>
              <textarea  name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
          </td>
       
       </tr>

       <tr>
          <td>Price:</td>
          <td>
              <input type="number" name="price" value = "<?php echo $price; ?>">
          </td>
       
       </tr>

       <tr>
          <td>Current Image:</td>
          <td>
              <?php
                 if($current_image == "")
                   {
                     //Image not Available
                      echo "<div class='error'>Image not Available.</div>";
                   }
                   else
                   { 
                      //Image Available
                      ?>
                      <img src="<?php echo SITEURL;?>FOODZPAHH/images/<?php echo $current_image;?>" alt="<?php echo $title;?>">
                      <?php
                   }
              ?>
          </td>
       
       </tr>

       
       <tr>
          <td>Select New Image:</td>
          <td>
              <input type="file" name="image">
          </td>
       
       </tr>


       <tr>
          <td>Category:</td>
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
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        ?>

                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

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
          <td>Featured:</td>
          <td>
               <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes 
               <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
          </td>
       
       </tr>

       <tr>
          <td>Active:</td>
          <td>
              <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
              <input <?php if($active=="No") {echo "checked";}?>type="radio" name="active" value="No">No
          </td>
       </tr>

       <tr>
          <td>
               <input type="hidden" name="id" value="<?php  echo $id; ?>">
               <input type="hidden" name="current_image" value="<?php  echo $current_image; ?>">
               <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
                $description =  $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
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

                                $image_name = "Food_name_".rand(000, 999).'.'.$ext;
                                
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
                                    header("loaction:".SITEURL.'FOODZPAHH/admin/manage-food.php');

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
                                        header('location:'.SITEURL.'FOODZPAHH/admin/manage-food.php');
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

                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price =  '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);

                // redirect to manage-category
                    // check whether query has been executed or not

                    if($res3==TRUE)
                    {
                        $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
                        header("location:".SITEURL.'FOODZPAHH/admin/manage-food.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
                        header("location:".SITEURL.'FOODZPAHH/admin/manage-food.php');
                    }

            }
        }

        ?>
   </div>
 </div>  


<?php include('partials/footer.php');?>