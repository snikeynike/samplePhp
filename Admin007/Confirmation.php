<?php 
require("../connection.php");
session_start();

if(isset($_POST['Send']))
{
//Email
   $to = $_POST['email'];
   $subject = "This is from Centro Resto House";
   $message=$_POST['header']."\n\n".$_POST['orderdetails'];
   $header = "From:admin007@centrorestohousedelivery.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
//end or Email

 //SMS
 require("class-Clockwork.php");
 $apikey="da06231fc8e203cec4f8d9516d5bf9a4d0ea66db";
 $clockwork = new Clockwork($apikey);
 
 $ContNo=$_POST['CellNo'];
 $sms=array('to' => '$ContNo', 'message' => '$message');
 $done = $clockwork->send($sms);
 //end of SMS
   
   if( $retval == true || $done == true)  
   {
     $nav="Confirmation message sent successfully";
	 $color="#227BDD";

$item=mysqli_query($con,"select * from tbl_item_placed where Order_ID='".$_SESSION['OrderID_Confirm']."'");	
while($list=mysqli_fetch_array($item)){
$itemID=$list['Item_ID'];
$qty=$list['Quantity'];

$x=mysqli_query($con,"select * from tbl_items where Item_ID='$itemID'");
$y=mysqli_fetch_array($x);
$z=$y['Qnty_Available'];
$newqty=$z-$qty;
mysqli_query($con,"update tbl_items set Qnty_Available='$newqty' where Item_ID='$itemID'");
}
mysqli_query($con,"update tbl_order set status='confirmed' where Order_ID='".$_SESSION['OrderID_Confirm']."'");
   }
   else
   {
      $nav="Confirmation message could not be sent...";
	   $color="red";
   }  
}else if(isset($_POST['Back'])){
$redirect="ReceivedOrder.php";
header("Location: ".$redirect);

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Confirmation</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"> -->
</head>

<body>
<?php 

	$CustDetail=mysqli_query($con,"Select tbl_customer.*, tbl_deliveryinfo.* from tbl_customer inner join tbl_deliveryinfo on tbl_customer.Customer_ID=tbl_deliveryinfo.Customer_ID where tbl_customer.Customer_ID='".$_SESSION['Cust_ID']."'");
	$x=mysqli_fetch_array($CustDetail);
	$email=$x['email'];
	$name=$x['FName']." ".$x['LName'];
	$CellNo=$x['Contact_Num'];
?>
 <form action="?" method="post">
<div id="container8">
  <table width="604" border="0">
    <tr>
      <td>To &nbsp;<?php echo $email."  ".$CellNo; ?></td>
    </tr>
   
      <tr>
        <td height="113"><label>
          <textarea name="header" style="height:120px; width:590px">
Hellow! <?php echo $name; ?>,

Your order from Centro Resto House is confirmed successfully.
The following are you're order/s details:
</textarea>
          <textarea name="orderdetails" style="height:0px; width:590px; visibility:hidden">
    <?php  
	
     $x=mysqli_query($con,"select * from tbl_item_placed where Order_ID='".$_SESSION['OrderID_Confirm']."'");
   while($a=mysqli_fetch_array($x)){
   $z=$a['Item_ID'];
   $y=mysqli_query($con,"select * from tbl_items where Item_ID='$z'");
   $b=mysqli_fetch_array($y);   
echo $b['Item_Name']." x ".$a['Quantity']."\n";
   } 
 
    echo "_______________________________________________\n";
	$q=mysqli_query($con,"select * from tbl_order where Order_ID='".$_SESSION['OrderID_Confirm']."'");
	$bill=mysqli_fetch_array($q);
	echo "Total Bill: Php ".$bill['Bill']; 
	
    ?> 
	</textarea>
<textarea name="" style="height:120px; width:590px; background-color:#FFFFFF" disabled="disabled">
   <?php  
  
     $x=mysqli_query($con,"select * from tbl_item_placed where Order_ID='".$_SESSION['OrderID_Confirm']."'");
   while($a=mysqli_fetch_array($x)){
   $z=$a['Item_ID'];
   $y=mysqli_query($con,"select * from tbl_items where Item_ID='$z'");
   $b=mysqli_fetch_array($y);   
echo $b['Item_Name']." x ".$a['Quantity']."\n";
   } 
 
    echo "_______________________________________________\n";
	$q=mysqli_query($con,"select * from tbl_order where Order_ID='".$_SESSION['OrderID_Confirm']."'");
	$bill=mysqli_fetch_array($q);
	echo "Total Bill: Php ".$bill['Bill']; 
    
	?>
</textarea>
          <input type="hidden" name="email" value="<?php echo $email; ?>" />
           <input type="hidden" name="CellNo" value="<?php echo $CellNo; ?>" />
        </label></td>
      </tr>
  </table>
  <div style="padding:10px; color:<?php if(isset($color)){ echo $color;} ?>;">
  <div align="right">
  <?php    
		if(isset($color)){ 
		echo "<div class='alert alert-info'>";
		echo $nav;
		echo "</div>";
		}
	?>
	</div>
	</div>
  <div align="right">
      <input type="submit" name="Send" value="Send" style="width:100px; height:35px; background-color:#FFFF80" />
      <input type="submit" name="Back" value="Back" style="width:100px; height:35px; background-color:#FFFF80" />
  </div>
</div>
 </form>
</body>
</html>
