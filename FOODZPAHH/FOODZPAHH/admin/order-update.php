<?php include('partials/menu.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $order_id =  $_GET['id'];
    
        $sql = "SELECT * FROM tbl_order WHERE id='$order_id'";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count rows
        $count = mysqli_num_rows($res);
        //check whether food available or not
        if($count == 1)
        {
        //Details available
        //Get the value from database
        $row = mysqli_fetch_assoc($res);

        $food = $row['food'];
        $price = $row['price'];
        $qty = $row ['qty'];
        $status = $row ['status'];
        $customer_name = $row ['customer_name'];
        $customer_contact = $row ['customer_contact'];
        $customer_email = $row ['customer_email'];
        $customer_address = $row ['customer_address'];

        }
        else
        {
            //Details is not available
            //Redirect to Home page
            header('location:'.SITEURL.'FOODZPAHH/'.'admin/manage-order.php');
        }
    }
    else
    {
       //category not passed
       //Redirect to Home page
       header('location:'.SITEURL.'FOODZPAHH/'.'admin/manage-order.php');
    }

?>

<form action="" method="POST">
    <table class="tbl-order">
    <tr>
        <td>Food Name</td>
        <td><?php  echo $food; ?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><b>Rs.<?php  echo $price; ?>/-<b></td>
    </tr>
    <tr>
        <td>Qty</td>
        <td><?php  echo $qty; ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php  echo $status; ?></td>
        <td>
            <input type="radio" name="status" value="Ordered"> Ordered
            <input type="radio" name="status" value="Delivered"> Dellivered
            <input type="radio" name="status" value="Processsing"> Processing
            <input type="radio" name="status" value="Cancelled"> Cancelled
        </td>
    </tr>
    <tr>
        <td>Customer Name:</td>
        <td><?php  echo $customer_name; ?></td>
    </tr>
    <tr>
        <td>Customer Contact</td>
        <td><?php  echo $customer_contact; ?></td>
    </tr>
    <tr>
        <td>Customer Email</td>
        <td><?php  echo $customer_email; ?></td>
    </tr>
    <tr>
        <td>Customer Address</td>
        <td><?php  echo $customer_address; ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
        </td>
    </tr>
    </table>
</form>


<?php
    if(isset($_POST['submit']))
    {
        $id = $_POST['order_id'];
        $status = $_POST['status'];

        $sql2 = "UPDATE tbl_order SET
        status = '$status'
        WHERE id=$id   
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==TRUE)
        {
            $_SESSION['update'] = "<div class='success'>Order status updated successfully.</div>";
            header('location:'.SITEURL.'FOODZPAHH/admin/manage-order.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to order status.</div>";
            header('location:'.SITEURL.'FOODZPAHH/admin/order-update.php');
        }
    }
?>