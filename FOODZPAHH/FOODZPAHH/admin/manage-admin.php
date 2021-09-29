<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
    <h1>MANAGE ADMIN</h1>
       <br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];      //displaying session message
            unset($_SESSION['add']);    //removing session message
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br><br><br>
       <!-- button to add admin -->
       <a href="add-admin.php" class="btn-primary">ADD ADMIN</a>
       <br><br><br>
    <div class="clearfix">
    <table class="tbl-full">
    <tr>
        <th>Serial No.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>

    <?php
    $sql = "SELECT * FROM tbl_admin";
    $res = mysqli_query($conn, $sql);
    if($res==TRUE)
    {
        // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($res);  //function to get all the rows in database
        
        $sn=1;

        if($count>0)
        {
            while($rows=mysqli_fetch_assoc($res))
            {
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $username=$rows['username'];

                // display the value in table
                ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/update-password.php?id=<?php echo $id; ?>" class='btn-primary'>Change Password</a>
                        <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo SITEURL; ?>FOODZPAHH/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>

                <?php
            }
        }
        else
        {

        }
    }
    ?>

    </table>
    </div>
    </div>
    </div>
</body>
</html>
<?php include('partials/footer.php') ?>
