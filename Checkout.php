<?php 
require("connection.php");
if (!isset($_SESSION)) {
  session_start();
}

if(!isset($_POST['secure'])){
$_SESSION['secure']=rand(1000,9999);
}

if(isset($_POST['Submit']))
{
//data of tbl_deliveryinfo
$_SESSION['Contact_Num']=$_POST['txtPriNumber'];
$_SESSION['Address_type']=$_POST['selAddType'];
$_SESSION['Town']=$_POST['txtTown'];
$_SESSION['Street']=$_POST['txtStreet'];
$_SESSION['Landmark']=$_POST['txtLandMark'];
$_SESSION['Corner_Street']=$_POST['txtCorner'];
$_SESSION['Building']=$_POST['txtBuilding'];
$_SESSION['FloorDeptHouseNo']=$_POST['txtFloor'];
$_SESSION['Special_instruction']=$_POST['txtSpecIns'];
//end of data of tbl_deliveryinfo

//data for tbl_order
$_SESSION['PaymentType']=$_POST['selPaymentType'];
$_SESSION['Payment']=$_POST['txtPayAmount'];
//end of data for tbl_order

//data for tbl_customer
$_SESSION['txtLName']=$_POST['txtLName'];
$_SESSION['txtFName']=$_POST['txtFName'];
$_SESSION['chkoutEmail']=$_POST['txtEmail'];
//end of data for tbl_customer

$_SESSION['FullName']=$_POST['txtFName']." ".$_POST['txtLName'];
if($_SESSION['secure']==$_POST['secure']){

if($_POST['txtFName']!="" && $_POST['txtLName']!="" && $_POST['txtEmail']!="" && $_POST['txtPriNumber']!="" && $_POST['txtTown']!="" && $_POST['txtStreet']!="" && $_POST['txtFloor']!="")
{

 $MM_redirect = "OrderSummary.php";
 header("Location: ". $MM_redirect );

}else{
$prompt="<strong>"."Please fill all red fields."."</strong>";
}

}else{
$nav="The number you input, didn't match in the image above!";
$_SESSION['secure']=rand(1000,9999);
}

}
else if(isset($_POST['Back']))
{
 $MM_redirect = "index.php";
 header("Location: ". $MM_redirect );
}



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Checkout</title>
<link rel="shortcut icon" href="images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style3 {color: #0000FF; font-weight: bold; }
-->
</style>
</head>

<body>
<form action="Checkout.php" method="post">
<div id="container2">
  <label>
 <?Php
 if(isset($prompt)){
	 ?><div class="alert alert-danger"><?php
  echo $prompt; 
  ?></div><?php
 }
  ?>
</label>
  <div id="Cell">
  
<table width="879" border="0" cellspacing="0">
  <tr>
    <th height="35" colspan="6" style="background-color:#200020; color:#FFFFFF"><div align="left">Checkout</div></th>
  </tr>
  <tr>
    <td height="35" colspan="6" style="background-color:#FFFF99"><div align="center">Personal Information </div></td>
  </tr>

  <tr>
    <td width="193" height="44">
      <label>
      <div align="right">First Name      </div>
      </label>    </td> 
    <td width="265"><div align="left">
      <input name="txtFName" type="text" value="<?php 
	  if (isset($_SESSION['txtFName']))
	  { echo $_SESSION['txtFName'];} 
	  ?>" />
      <span class="style1">*</span></div></td>
    <td width="7">&nbsp;</td>
    <td width="134"><div align="right">Contact Number </div></td>
    <td colspan="2"><label>
      <input type="text" name="txtPriNumber" value="<?php 
	  if (isset($_SESSION['Contact_Num']))
	  { echo $_SESSION['Contact_Num']; } 
	   ?>" />
      <span class="style1">*</span></label></td>
  </tr>
  <tr>
    <td height="43"><label>
    <div align="right">Last Name</div>
    </label></td>
    <td><input type="text" name="txtLName" value="<?php  
	if (isset($_SESSION['txtLName']))
	  { echo $_SESSION['txtLName']; }
	 ?>" />
      <span class="style1">*</span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><label></label></td>
  </tr>
  <tr>
    <td height="40"><div align="right">e-mail</div></td>
    <td><label>
      <input type="text" name="txtEmail" value="<?php 
	  if (isset($_SESSION['chkoutEmail']))
	  { echo $_SESSION['chkoutEmail']; }
	    ?>" />
      <span class="style1">*</span></label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="53"><div align="right"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>	
  </tr>
  <tr>
    <td height="41" colspan="6" style="background-color:#FFFF99"><div align="center">Delivery Information </div></td>
  </tr>
  <tr>
    <td height="30" colspan="4"><span class="style3">Note: The delivery services is only in Kidapawan City Philippines</span></td>
    <td height="30" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="30"><div align="right">Address type</div></td>
    <td height="30"><label>
      <select name="selAddType" size="1" style="width:120px">
        <option>Home</option>
        <option>Work</option>
        <option>other</option>
      </select>
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30"><div align="right">Corner Street</div></td>
    <td height="30" colspan="2"><label>
      <input type="text" name="txtCorner" value="<?php 
	  if (isset($_SESSION['Corner_Street']))
	  { echo $_SESSION['Corner_Street']; }
	   ?>" />
    </label></td>
  </tr>
  <tr>
    <td height="30"><p align="right">Town/Subdivision/Village/Brgy </p>    </td>
    <td height="30"><label>
      <input type="text" name="txtTown" value="<?php 
	  if (isset($_SESSION['Town']))
	  { echo $_SESSION['Town']; }
	   ?>"/>
      <span class="style1">*</span></label></td>
    <td height="30">&nbsp;</td>
    <td height="30"><div align="right">Building </div></td>
    <td height="30" colspan="2"><label>
      <input type="text" name="txtBuilding" value="<?php 
	  if (isset($_SESSION['Building']))
	  { echo $_SESSION['Building']; }
	   ?>"/>
    </label></td>
  </tr>
  <tr>
    <td height="30"><div align="right">Street </div></td>
    <td height="30"><label>
      <input type="text" name="txtStreet" value="<?php
	  if (isset($_SESSION['Street']))
	  { echo $_SESSION['Street']; }
	    ?>"/>
      <span class="style1">*</span></label></td>
    <td height="30">&nbsp;</td>
    <td height="30"><div align="right">Floor/Dept/House No </div></td>
    <td height="30" colspan="2"><label>
      <input type="text" name="txtFloor" value="<?php
	  if (isset($_SESSION['FloorDeptHouseNo']))
	  { echo $_SESSION['FloorDeptHouseNo']; }
	  ?>"/>
      <span class="style1">*</span></label></td>
  </tr>
  <tr>
    <td height="30"><div align="right">Landmark</div></td>
    <td height="30"><label>
      <input type="text" name="txtLandMark" value="<?php 
	   if (isset($_SESSION['Landmark']))
	  { echo $_SESSION['Landmark']; }
	   ?>"/>
    </label></td>
    <td height="30">&nbsp;</td>
    <td height="30"><div align="right">Special Instruction </div></td>
    <td height="30" colspan="2"><label>
      <textarea name="txtSpecIns" style="height:60px"><?php
	  if (isset($_SESSION['Special_instruction']))
	  { echo $_SESSION['Special_instruction']; }
	   ?></textarea>
    </label></td>
  </tr>
  <tr>
    <td height="43" colspan="6" style="background-color:#FFFF99"><div align="center">Payment Information </div></td>
  </tr>
  <tr>
    <td height="30"><div align="right">Total Bill: </div></td>
    <td colspan="3"><?php echo "&nbsp;Php ".$_SESSION['TotalPrice']; ?></td>
    <td colspan="2">
	<div align="center"><br><img src="generate.php"  /></div><br />
	Input the number you see in image:    </td>
  </tr>
  <tr>
    <td height="24"><div align="right">Payment Type </div></td>
    <td colspan="3"><select name="selPaymentType">
      <option>Cash</option>
    </select></td>
    <td width="93">&nbsp;</td>
    <td width="175"><input type="text" size="6" name="secure" /></td>
    </tr>
  <tr>
    <td height="30"><div align="right">Payment Amount</div></td>
    <td colspan="3"><label>
      <input type="text" name="txtPayAmount" value="<?php echo $_SESSION['TotalPrice'];?>" />
    </label></td>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>

</div>
<label>
<div align="right">
<?php if (isset($nav)){
	?><div class="alert alert-danger"><?php
echo "<strong>".$nav."</strong>"; 
?></div><?php
}
?>
  <input type="submit" name="Back" value="Back" style="width:100px; height:45px; background-color:#FFFF80" />
  <input type="submit" name="Submit" value="Proceed to summary" style="width:190px; height:45px; background-color:#FFFF80" />
</div>
</label>
</div>
</form>
</body>
</html>
