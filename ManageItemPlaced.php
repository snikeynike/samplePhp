<?php
require("connection.php");
session_start();

if(isset($_POST['postItemDel'])){
	$index=$_POST['postIndex'];
	unset($_SESSION['CartItem'][$index]);
	unset($_SESSION['qty'][$index]);
	if(!isset($_SESSION['unseted'])){
	$_SESSION['unseted']=0;
	}
	$_SESSION['unseted']++;
	}if(isset($_SESSION['CartItem'])){
	$size=count($_SESSION['CartItem']);
	}else{$size=0;}
	if($size==0)
	{
		unset($_SESSION['CartItem']);
	unset($_SESSION['qty']);
		}
	
if(isset($_POST['postItemUpd'])){

	$_SESSION['qty'][$_POST['postIndex']]=$_POST['postVal'];
	/*$_SESSION['TotalPrice']=$_SESSION['TotalPrice'] - $total;*/
	}
$total2=0;
?>
<table style="border-spacing:0" >
<?php
for($x=0;$x<$_SESSION['loopnum'];$x++){
	if(isset($_SESSION['CartItem'][$x])){
$Item=mysqli_query($con,"select * from tbl_items where Item_ID='".$_SESSION['CartItem'][$x]."'");
$Item=mysqli_fetch_array($Item);
	
?>
  <tr>
<td style="border-bottom:solid 1px;"><label for="textfield"><?php echo $Item['Item_Name']." x "; ?></label></td>
<td style="border-bottom:solid 1px;"><input id="textfield" type="text" style="height:15px;padding:2px 2px;font-size:15px;line-height:1.33;border-radius:1px; width:25px;" value="<?php echo $_SESSION['qty'][$x];?>"></td>
<td style="border-bottom:solid 1px;">
<a index="<?PHP echo $x; ?>" class="updateCartItem" href="#?index="<?PHP echo $x; ?>"">Update</a>|
  <a index="<?PHP echo $x; ?>" class="deleteCartItem" href="#?index="<?PHP echo $x; ?>"">Remove</a>
</td>
</tr>

<?php
$total=$Item['Price']*$_SESSION['qty'][$x];
$total2=$total2+$total;
}}
$_SESSION['TotalPrice']= $total2;
?>
</table>
<!--<input type="button" onClick="PostRefreshCart();" value="Back" style="width:46px; height:20px; font-size:15px">-->
<a href="#" onClick="PostRefreshCart();">Close the order manager</a>

