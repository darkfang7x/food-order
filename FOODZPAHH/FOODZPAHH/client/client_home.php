<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

    if(isset($_SESSION['log-in']))
    {
        echo $_SESSION['log-in'];
        unset($_SESSION['log-in']);
    }
    
    if(isset($_SESSION['user_id']))
    {
        $_SESSION['u_id'] = $_SESSION['user_id'];
    }
?>

<section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>FOODZPAHH/client/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-search">
            </form>

        </div>
</section>

<section>
    <div class="container">
    <h2 class="text-center enjoy">Enjoy our categories</h2>
    <?php
        
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $name = $row['title'];
                $image_name = $row['image_name'];
                ?>

                <a href="<?php echo SITEURL; ?>FOODZPAHH/client/food-category.php?category_id=<?php echo $id; ?>">
                    <div class="box-4 float-container">
                        <img src="<?php echo SITEURL;?>FOODZPAHH/images/<?php echo $image_name; ?>" alt="<?php echo $name; ?>" class="box">
                        <h3 class="text-name"><?php echo $name; ?></h3>
                    </div>
                </a>
                <?php
            }

            
        }
        else
        {
            echo "No categories have been added yet";
        }
    ?>

    </div>
</section>
<div class="categories">____________________________________________________________________________________________</div>
<?php include('partials-front/footer.php'); ?>