<?php include('partials-front/menu.php');?>

<!--food search section starts here-->
<section class="food-search text-center">
 <div class="container">
  <?php
    //Get the search keyword
    $search = $_POST['search'];

  ?>

   <h2>Foods on Your Search <a href ="#" class ="text-white">"<?php echo $search;?>"</a></h2>

   </div>
   </section>
   <!--food search section ends here-->


<div class="main-content">
<section class = "food-menu">
<div class = "container">
  <h2 class = "text-center">Food Menu</h2>
  <?php
     
     //SQL Query to get foods based on search keyword
     $sql ="SELECT * FROM tbl_food WHERE title LIKE'%$search%' OR description LIKE '%$search%' ";
     //Execute the query
     $res= mysqli_query($conn,$sql);
     //Count rows
     $count = mysqli_num_rows($res);
     //check whether food available or not
     if($count >0)
     {
         //food available
         while($row = mysqli_fetch_assoc($res))
         {
             //Get the details
             $id = $row['id'];
             $title = $row['title'];
             $price = $row['price'];
             $description = $row['description'];
             $image_name = $row ['image_name'];
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
                        <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="food-menu-image" width=100px height=100px>
                        <?php
                    }
                    ?>
                    </div>
                    <div class ="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class = "food-detail">
                        <?php echo $description; ?>
                        </p>
                        <br>
                        <a href= "<?php echo SITEURL; ?>FOODZPAHH/order.php?food_id.<?php echo $id; ?>" class ="btn btn-primary">Order Now</a>

            </div>
            </div>
                 <?php    
         }
     }
     else
     {
         //Food not available
         echo " <div class ='error'>food not found.</div>";
     }
     ?>

    </section>
</div>
<!-- food menu section starts here --->


    <div class="categories">-----------------</div>

    <?php include('partials-front/footer.php'); ?>