<?php
require("../connection.php");
$order=mysqli_query($con,"Select count(*) as total from tbl_order where status=''");
$order=mysqli_fetch_array($order);
echo $order['total'];
?>