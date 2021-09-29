<?php include('partials/menu.php'); ?>

    <div class="main-content">
    <div class="wrapper">
        <h1> Change Password </h1>
        <br><br>
        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>








        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
    </div>

    <?php

        // check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            // get data from form

            $id = $_POST['id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // check whether the user with current id and password exists or not

            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            $res = mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    if($new_password==$confirm_password)
                    {
                        $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2==TRUE)
                        {
                            $_SESSION['change-pwd'] = "<div class='success'> PASSWORD UPDATED SUCCESSFULLY. </div>";
                            header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
                        }
                        else
                        {
                            $_SESSION['change-pwd'] = "<div class='error'> FAILED TO CHANEG PASSWORD. PLEASE TRY AGAIN LATER. </div>";
                            header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pwd-not-match'] = "<div class='error'> PASSWORD DID NOT MATCH. </div>";
                        header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['user-not-found'] = "<div class='error'> User Not Found. </div>";
                    header('location:'.SITEURL.'FOODZPAHH/admin/manage-admin.php');
                }
            }

            // check whether the new password and confirm password matches or not



            // change password if all above are true


        }

    ?>








<?php include('partials/footer.php'); ?>