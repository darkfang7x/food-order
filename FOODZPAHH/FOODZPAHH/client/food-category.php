<?php include('partials-front/menu.php');?>
<?php
     if(isset($_SESSION['u_id']))
     {
        $user_id = $_SESSION['u_id'];
     }
     
     //check whether id is passed or not
     if(isset($_GET['category_id']))
     {
         //category id is set and get the id
         $category_id = $_GET['category_id'];
         //Get the category title based on category id 
         $sql = "SELECT title FROM tbl_category WHERE id =$category_id";
         //Execute the Query
         $res = mysqli_query($conn, $sql);
         //Get the value from database
         $row = mysqli_fetch_assoc($res);
         //Get the title
         $category_title = $row['title'];
     }
     else
     {
         //category not passed
         //Redirect to Home page
         header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
     }
?>





<!--food search section starts here-->
<section class="food-search text-center">
 <div class="container">
  

   <h2>Foods on Your Serach <a href ="#" class ="text-white">"<?php echo $category_title;?>"</a></h2>

   </div>
   </section>
   <!--food search section ends here-->



<! food menu section starts here --->
<section class = "food-menu">
<div class = "container">
  <h2 class = "text-center">Food Menu</h2>
  <?php
     
     //create sql query to get food based on selected category
     
     $sql2 ="SELECT * FROM tbl_food WHERE category_id=$category_id ";
     //Execute the query
     $res2= mysqli_query($conn, $sql2);
     //Count the  rows
     $count2 = mysqli_num_rows($res2);
     //check whether food available or not
     if($count2 >0)
     {
         //food  is available
         while($row2 = mysqli_fetch_assoc($res2))
         {
             $id = $row2['id'];
             $title = $row2['title'];
             $price = $row2['price'];
             $description = $row2['description'];
             $image_name = $row2['image_name'];
             ?>
             
             <div class ="food-menu-box">
               <div class ="food-menu-img">
                <?php
                    //check whether image name is available or not
                    if($image_name=="")
                    {
                        //Image not available
                        echo "<div class ='error'>Image not available.</div>";
                    }
                    else
                    {
                        //image available
                        ?>
                        <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" width=100px height=100px>
                        <?php
                    }
                    ?>
                    </div>
                    <div class ="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">Rs.<?php echo $price; ?>/-</p>
                    <p class = "food-detail">
                        <?php echo $description; ?>
                        </p>
                        <br>
                        <a href="<?php echo SITEURL; ?>FOODZPAHH/client/order.php?food_id=<?php echo $id; ?>&user_id=<?php echo $user_id; ?>" class ="btn btn-primary">Order Now</a>

            </div>
            </div>
                 <?php    
         }
     }
     else
     {
         //Food not available
         echo "<div class='error'>Food not available.</div>";
     }
     ?>

    </section>


    <div class="categories">-----------------</div>

    <?php include('partials-front/footer.php'); ?>