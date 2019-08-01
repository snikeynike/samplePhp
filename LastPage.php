<?php 
require("connection.php");
if (!isset($_SESSION)) {
  session_start();
}
if(isset($_POST['reorder']))
{
$MM_Redirect="index.php";
header("Location: ". $MM_Redirect );
session_destroy();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
<style type="text/css">
<!--
.style5 {font-size: x-large}
-->
</style>
</head>

<body>
<div id="container3">
<a href="index.php"></a>
<div id="Cell">
<table width="609px" border="0" cellspacing="1">
  <tr>
    <th height="40" style="background-color:#000000; color:#FFFFFF"><div align="left">
      <h3>Centro Resto House Delivery</h3>
    </div></th>
  </tr>
 <tr>
 <td>
 <h1>Thank you, <?php echo $_SESSION['FullName']; ?>, for using Centro Resto House Online Ordering</h1> </td>
 </tr>
 <tr>
   <td>Please expect an email from admin@centrorestohousedelivery.com in a few minutes as confirmation of your order. </td>
 </tr>
 <tr>
 <td>
 <div id="receipt">
   <span class="style5"><strong>Order Summary </strong></span><br>
 <label>Reference No. <?php 
 if(isset($_SESSION['OrderID'])){
 echo $_SESSION['OrderID'];}
  ?>
   </label>
   <hr/>
 <?php
	$SelectItem=mysqli_query($con,"select * from tbl_item_placed where Order_ID='".$_SESSION['OrderID']."' ");
	?>
 <table width="271">
 <?php while($Details=mysqli_fetch_array($SelectItem)){ 
 $ItemID=$Details['Item_ID'];
	$Items=mysqli_query($con,"select * from tbl_items where Item_ID='$ItemID'");
	$ItemName=mysqli_fetch_array($Items);
 ?>
   <tr> 
  <td> 
  <div align="left"><?php  echo $ItemName['Item_Name']." x ".$Details['Quantity'];  ?></div>
  </td>
      <td>
	  <div align="right"><?php echo $ItemName['Price']; ?></div>
	  </td>
  </tr>
  <?php } ?>
 </table>
<hr/>
	  <?php 
	  $sel=mysqli_query($con,"select * from tbl_order where Order_ID='".$_SESSION['OrderID']."'");
	$z=mysqli_fetch_array($sel);
	  ?>
	  <table width="268">
	  <tr>
	 <td width="35">
	   <div align="left">Total</div>
	   </td>
	 <td width="43">
	  <div align="right"><?php  echo $z['Bill']; ?></div>	
	  </td>
	  </tr>
	  </table>
 </div> 
 </td>
 </tr>
</table>
</div>
<div align="right">
  <label>
  <form action="LastPage.php" method="post">
  <input type="submit" name="reorder" style="width:100px; height:35px; background-color:#FFFF80" value="New order" />
  </form>
  </label>
</div>
</div>
<h2>&nbsp;</h2>
</body>
</html>