<?php
require("../connection.php");
session_start();
 $OrderID=$_GET['OrderID']."<br>";
 $CustID=$_GET['CustID'];
  
  $Select=mysqli_query($con,"select * from tbl_customer where Customer_ID='$CustID' ");
  $CustDetails=mysqli_fetch_array($Select);
  $Name=$CustDetails['FName']." ".$CustDetails['LName'];
  $Email=$CustDetails['email'];
   
  $Select2=mysqli_query($con,"select * from tbl_deliveryinfo where Customer_ID='$CustID' ");
  $CustDetails2=mysqli_fetch_array($Select2);
  $Contact_Num=$CustDetails2['Contact_Num'];
  $Address_type=$CustDetails2['Address_type'];
  $Town=$CustDetails2['Town'];
  $Street=$CustDetails2['Street'];
  $Landmark=$CustDetails2['Landmark'];
  $Corner_Street=$CustDetails2['Corner_Street'];
  $Building=$CustDetails2['Building'];
  $FloorDeptHouseNo=$CustDetails2['FloorDeptHouseNo'];
  $Special_instruction=$CustDetails2['Special_instruction'];
  
  if(isset($_POST['Back']))
{
$MM_Redirect="ReceivedOrder.php";
header("Location: ". $MM_Redirect );
}
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Info</title>
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 20px}
-->
</style>
</head>

<body>
<div id="container3">
<h2><?php echo "Order ID: ".$OrderID; ?></h2>
<div id="Cell">
<table width="609px" border="0" cellspacing="1">
  <tr>
    <td height="40" colspan="2" style="background-color:#FFFF99"><div align="center" class="style1"> Order Details </div></td>
  </tr>
  <?php
	$SelectItem=mysqli_query($con,"select * from tbl_item_placed where Order_ID='$OrderID' ");
  while($Details=mysqli_fetch_array($SelectItem)){
   ?>
    <tr><td width="297" height="40" ><div align="right">
	<?php
	$ItemID=$Details['Item_ID'];
	$Items=mysqli_query($con,"select * from tbl_items where Item_ID='$ItemID'");
	$ItemName=mysqli_fetch_array($Items);
	
	 echo $ItemName['Item_Name']; ?>
	</div>
	 </td>
	 <td width="305" ><?php echo " x ".$Details['Quantity']; ?></td>
	  <?php }?>
	
  </tr>
  <tr>
    <td height="40" colspan="2" style="background-color:#FFFF99"><div align="center" class="style1">Customer Details </div></td>
    </tr>
  <tr>
    <td height="auto" ><div align="right">Name:</div></td>
    <td height="auto" ><?php echo $Name; ?></td>
  </tr>
  <tr>
    <td height="auto" ><div align="right">E-mail:</div></td>
    <td height="auto" ><?php echo $Email; ?></td>
  </tr>
  <tr>
    <td height="auto" ><div align="right">Primary Number:</div></td>
    <td height="auto" ><?php echo $Contact_Num; ?></td>
  </tr>
   <tr>
    <td height="auto" ><div align="right">Address type:</div></td>
    <td height="auto" ><?php echo $Address_type; ?></td>
  </tr>
   <tr>
    <td height="auto" ><div align="right">Town/Subdivision/Village/Brgy:</div></td>
    <td height="auto" ><?php echo $Town; ?></td>
  </tr>
  <tr>
    <td height="auto" ><div align="right">Street:</div></td>
    <td height="auto" ><?php echo $Street; ?></td>
  </tr>
  <tr>
    <td height="auto" ><div align="right">Landmark:</div></td>
    <td height="auto" ><?php echo $Landmark; ?></td>
  </tr>
   <tr>
    <td height="auto" ><div align="right">Corner street:</div></td>
    <td height="auto" ><?php echo $Corner_Street; ?></td>
  </tr>
   <tr>
    <td height="auto" ><div align="right">Building:</div></td>
    <td height="auto" ><?php echo $Building; ?></td>
  </tr>
   <tr>
    <td height="auto" ><div align="right">Floor/Dept/HouseNo:</div></td>
    <td height="auto" ><?php echo $FloorDeptHouseNo; ?></td>
  </tr>
  <tr>
    <td height="auto" ><div align="right">Special instruction:</div></td>
    <td height="auto" ><?php echo $Special_instruction;  ?></td>
  </tr>
</table>
</div>

<div align="right">
<form action="?" method="post">
  <input type="submit" name="Back" value="Back" style="width:100px; height:35px; background-color:#FFFF80" />
</form>
</div>
</div>
<script>
 OrderSummary();
function OrderSummary()
{
$.post('../ViewSummary.php',{ViewSummary:1},
function(data){
		$('#OrderSummary').html(data);
		})
}

function functionSend()
{
if (confirm("Are you sure you want to send?")==true)
{
$.post('sendOrder.php',{Send:1},
function(data){
alert(data);
});
}
}
</script>
</body>
</html>
