<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
    <h1>MANAGE FOOD</h1>
    <br><br>

    <?php
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

    ?>
    <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/add-food.php" class="btn-primary">ADD FOOD</a>
       <br><br><br>
       <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
       ?>
    <div class="clearfix"></div>
    <table class="tbl-full">
    <tr>
        <th>Serial No.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th hidden>Actions 1</th>
        <th hidden>Actions 2</th>


    </tr>

    <?php
        // create sql query to get all the foods

        $sql = "SELECT * FROM tbl_food";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        $sn=1;

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <?php 
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not added.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>FOODZPAHH/images/<?php echo $image_name; ?>"width="100px" height="80px">
                                <?php
                            }
                        ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/update-food.php?id=<?php echo $id; ?> " class="btn-secondary">Update Food</a>
                    </td>
                    <td>
                    <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                    </td>
                </tr>
                

                <?php
            }
        }
        else
        {
            echo "<tr><td colspan='8' class='error'>Food not added yet.</td></tr>";
        }

    ?>
    </table>   
    <div class="clearfix"></div>
    </div>
    </div>
</body>
</html>
<?php include('partials/footer.php') ?>
