<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer order</title>
</head>


<body>
<?php

if(isset($_SESSION['u_id']))
{
   $id = $_SESSION['u_id'];
}

$sql = "SELECT * FROM tbl_order WHERE user_id=$id";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count>0)
{
    ?>

    <div class="order">
        <table class="order">
            <tr>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Cost</th>
                <th>Order date</th>
                <th>Recepient's name</th>
                <th>Contact No.</th>
                <th>Email</th>
                <th>Address</th>
            </tr>

            <?php
                while($row = mysqli_fetch_assoc($res))
                {
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];?>
                    <tr>
                        <td><?php echo $food; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                    </tr><?php
                }
            
        
?>
        </table>
    </div><?php
}
else
{
    echo "There has been no order placed by you yet.";
}
?>
</body>
</html>