<?php include('partials-front/menu.php');?>
<?php
   if(isset($_GET['user_id']))
   {
       $user_id = $_GET['user_id'];
   }
   //check whether id is set or not
   if(isset($_GET['food_id']))
   {
       //food id is set and get the id
       $food_id = $_GET['food_id'];
       //Get the details of the selected food
       $sql = "SELECT * FROM tbl_food WHERE id =$food_id";
       //Execute the Query
       $res = mysqli_query($conn, $sql);
       //Count rows
       $count = mysqli_num_rows($res);
       //check whether food available or not
        if($count ==1)
        {
            //food available
            //Get the value from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row ['image_name'];

        }
        else
        {
            //food is not available
            //Redirect to Home page
            header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
        }
    }
    else
    {
        //category not passed
        //Redirect to Home page
        header('location:'.SITEURL.'FOODZPAHH/client/user-login.php');
    }
?>

<!--Food search section starts here-->
<section class="Food-search">
<div class ="container">

  <h2 class ="text-name">Fill this form to confirm your order.</h2>

  <form action="" method ="POST" class ="order">
  <fieldset>
   <legend>Selected Food</legend>
   <div class="food-menu-img">
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
                   <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="food-menu-img">
                   <?php
               }
               ?>
        
   </div>

   <div class="food-menu-desc">
               <h3><?php echo $title;?></h3>
               <input type="hidden" name="food" value="<?php echo $title;?>">

               <p class="food-price">Rs. <?php echo $price; ?></p>
               <input type="hidden" name = "price" value ="<?php echo $price; ?>">

   <div class="order-label">Quantity</div>
   <input type="number" name="qty" class="input-responsive" value="1" required>

   </div>
   </fieldset>

   <fieldset>
        <legend> Delivery Details</legend>
        <div class="order-label">Full Name</div>
        <input type="text" name="full-name" placeholder="E.g.Rupam Chowdhury" class="input-responsive" reqired> 

        <div class="order-label">Phone Number</div>
        <input type="tel" name="contact" placeholder="E.g. 8478xxxxxx" class="input-responsive" reqired> 

        <div class="order-label">Email</div>
        <input type="email" name="email" placeholder="E.g. hello@gmail.com" class="input-responsive" reqired>

        <div class="order-label">Address</div>
        <textarea name="address" rows="10" placeholder="E.g.Street, City, Country" class="input-responsive" reqired></textarea>

        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
    </fieldset>

    </form>

    <?php 
      
       //check whether submit button is clicked or not
       if(isset($_POST['submit']))
       {
           //Get all the details from the form
           echo $food = $_POST['food'];
           echo $price = $_POST['price'];
           echo $qty = $_POST['qty'];
           echo $total = $price * $qty;
           echo $order_date = date("y-m-d h:i:sa");
           echo $status = "Ordered";
           echo $customer_name = $_POST['full-name'];
           echo $customer_contact = $_POST['contact'];
           echo $customer_email = $_POST['email'];
           echo $customer_address = $_POST['address'];

           //save the order in database
           //create sql to save the data
           $sql2 = "INSERT INTO tbl_order SET
                user_id = '$user_id',
                food = '$food',
                price = '$price',
                qty = '$qty',
                total= '$total',
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
           ";

           //execute the query
           $res2 = mysqli_query($conn, $sql2);

           //check whether query executed successfully or not
           if($res2 == true)
           {
               //query executed and order saved 
               $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
               header('location:'.SITEURL.'FOODZPAHH/client/client_home.php');
           }
           else
           {
               //Failed to save order
               $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div> ";
               header('location:'.SITEURL.'FOODZPAHH/client/client_home.php');

           }

       }

    ?>


    </div>
    </section>
    <!--food search section ends here-->
    
    <?php include('partials-front/footer.php'); ?>


             