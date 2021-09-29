<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Catalogue</title>
</head>
<body>
<!-- <div class="cata-bg"> -->
   <h1 class="text-center">PRESENTING OUR DELICIOUS MENU</h1>
   <br><br>
   <div >
        <?php
        if(isset($_SESSION['u_id']))
        {
           $user_id = $_SESSION['u_id'];
        }

        $sql ="SELECT * FROM tbl_food";
        //Execute the query
        $res= mysqli_query($conn, $sql);
        //Count the  rows
        $count = mysqli_num_rows($res);
        //check whether food available or not
        if($count >0)
        {
            //food  is available
            while($row = mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
        <div>
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
                        <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="food-menu-image" width=100px height=100px>
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
<!-- </div> -->
</body>
</html>


<div class="categories">-----------------</div>

<?php include('partials-front/footer.php'); ?>