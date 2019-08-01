<?php 
require("../connection.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>
<body>
<div id="container6">
<a href="ManageMenu.php">Manage menu</a>|<a href="Messages.php">Messages</a>|<a href="ReceivedOrder.php">Received orders</a>
<h1>Confirmed Orders</h1>
<div id="table1">
	<a href="ReceivedOrder.php">Back to received orders</a>
    <table width="521" border="0" style="width:500px;">
      <tr>
	 
        <th width="90">Order ID</th>
        <th width="101">Customer ID </th>
        <th width="130">Date Received</th>
        <th width="161"> Action</th>
		
      </tr>
      <?php
   $order=mysqli_query($con,"select * from tbl_order where status='confirmed' order by Order_DateTime desc"); 
   while($orderlist=mysqli_fetch_assoc($order)){
  ?>
      <tr>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Order_ID']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Customer_ID']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Order_DateTime']; ?></td>
        <td bgcolor="#FFFFFF"><a href="OrderDetails.php?OrderID=<?php echo $orderlist['Order_ID']; ?>&CustID=<?php echo $orderlist['Customer_ID']; ?>">Open</a>|<a href="#">Delete</a> </td>
      </tr>
      <?php 
  }
   ?>
    </table>
    </div>
    </div>
</body>
</html>