<?php 
     include('../config/constant.php');
     
    //echo"Delete Food Page";
      if(isset($_GET['id']) && isset($_GET['image_name']))
      {
          //process to delete
         // echo"Process to Delete";

         //Get ID and Image name
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];

         //remove the image if avaiable
         //check whether the  image is available or not and Delete Only if available
         if($image_name != "")
         {
             //It has image and need to remove from folder
             //Get the image Path
             $path ="../images/".$image_name;
             //Remove the image file
             $remove = unlink($path);
             //check whether the image is remove or not
             if($remove==false)
             {
                 //failed to remove image
                 $_SESSION['upload']= "<div class='error'>Failed to remove image file.</div>";
                 //redirect to Manage food
                 header('location:'.SITEURL.'FOODZPAHH/admin/manage-food.php');
                 //stop the process of Deleting food
                 die();
             } 
         }

         //Delete food from Database
       $sql = "DELETE FROM tbl_food WHERE id =$id";
       //Execute the Query
       $res = mysqli_query($conn, $sql);
       //check whether the query executedor not and set the session message respectively
       //redirect to manage food with session message
       if($res == true)
           {
               //food deleted
               $_SESSION['delete'] = "<div class='success text-center'>Food deleted Successfully.</div>";
               header('location:'.SITEURL.'FOODZPAHH/admin/manage-food.php');
           }
           else
           {
               //Failed to delete food
               $_SESSION['delete'] = "<div class = 'error text-center'>Failed to Delete Food.</div> ";
               header('location:'.SITEURL.'FOODZPAHH/admin/manage-food.php');

           }

      }
      else
      {
          //redirect to Manage Food Page
          $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
          header('location:'.SITEURL.'FOODZPAHH/'.'admin/manage-food.php');
      }

?>