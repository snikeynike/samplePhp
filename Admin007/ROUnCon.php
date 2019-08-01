<?php
require("../connection.php");

$order=mysqli_query($con,"select * from tbl_order where status='' order by Order_DateTime"); 
while($orderlist=mysqli_fetch_assoc($order)){
  ?>
      <tr>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Order_ID']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Customer_ID']; ?></td>
        <td bgcolor="#FFFFFF"><?php echo $orderlist['Order_DateTime']; ?></td>
        <td bgcolor="#FFFFFF"><a href="OrderDetails.php?OrderID=<?php echo $orderlist['Order_ID']; ?>&CustID=<?php echo $orderlist['Customer_ID']; ?>">Open</a>|<a href="?Confirm=1&Cust_ID=<?php echo $orderlist['Customer_ID']; ?>&OrderID=<?php echo $orderlist['Order_ID']; ?>">Sent Confirmation</a> </td>
      </tr>
      <?php 
  }
   ?>