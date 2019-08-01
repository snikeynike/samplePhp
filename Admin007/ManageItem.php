<?php 
require("../connection.php");

if(isset($_POST["CatID"])){
$CatID = $_POST["CatID"];
$CatName=mysqli_query($con,"select * from tbl_category where Category_ID='$CatID'");
$CatName=mysqli_fetch_array($CatName);
	}

if(isset($_GET["ItemInfo"])){
$ItemID = $_GET["ItemInfo"];

$ItemInfo=mysqli_query($con,"select * from tbl_items where Item_ID='$ItemID'");
$ItemInfo=mysqli_fetch_array($ItemInfo);
$name=$ItemInfo['Item_Name'];
$desc=$ItemInfo['Description'];
$Price=$ItemInfo['Price'];
$Qnty_Available=$ItemInfo['Qnty_Available'];
$imageData=$ItemInfo['image'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manage Item</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
</head>

<body>
<center>
  <p>&nbsp;</p>
<p><a href="ManageMenu.php">Manage menu</a>|<a href="Messages.php">Messages</a>|<a href="ReceivedOrder.php">Received orders</a></p>
<?php if(isset($_GET["ItemInfo"])){	?>
<img src="../ShowImage.php?id=<?php echo $ItemID; ?>" width="100" height="100"/>
<?php } ?>
  <p><?php 
   if(isset($_POST["CatID"])){ echo $CatName["Category_Name"];} 
      ?></p>
  
  <table width="472" height="379" border="0">
  <form action="ManageItem.php" method="post" enctype="multipart/form-data">
    <tr>
      <td width="129">Meal Name: </td>
      <td width="333"><label>
        <input type="text" name="MealName" value="<?php if(isset($_GET["ItemInfo"])){echo $name;} ?>" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <?php if(isset($_POST["CatID"])){ ?>
      <label><input name="CatID" type="hidden" value="<?php
	    echo $CatID;
       ?>" /></label>
       <?php } ?>
       <?php if(isset($_GET["ItemInfo"])){ ?>
       <label><input name="ItemID" type="hidden" value="<?php
	    echo $ItemID; 
       ?>" /></label>
       <?php } ?>
       </td>
    </tr>
    <tr>
      <td>Description:</td>
      <td><textarea name="Description" cols="40" rows="5"><?php if(isset($_GET["ItemInfo"])){echo $desc;} ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="30">Price:</td>
      <td><label>
        <input type="text" name="Price" value="<?php if(isset($_GET["ItemInfo"])){echo $Price;} ?>" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="31">Quantity Available: </td>
      <td><label>
        <input type="text" name="QtyAvailable" value="<?php if(isset($_GET["ItemInfo"])){echo $Qnty_Available;} ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="16">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="48">Image:</td>
      <td><label>
        <input type="file" name="file" id="file"/>
      </label></td>
    </tr>
    <tr>
      <td rowspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" style="height:30px; width:75px; padding:0px 10px; font-size:18px" name="SubmitItemDetails" value="<?php 
		if(isset($_GET["ItemInfo"])){echo "Update";} if(isset($_POST["CatID"])){echo "Save";}
		 ?>" /></td>
    </tr>
	</form>
  </table>
  <p>&nbsp;  </p>
  <?php
if (isset($_POST['SubmitItemDetails']))
{	
 $MealName=mysqli_real_escape_string($con, $_POST['MealName']);
 $Description=mysqli_real_escape_string($con, $_POST['Description']);
 $Price=mysqli_real_escape_string($con, $_POST['Price']);
 $QtyAvailable=mysqli_real_escape_string($con, $_POST['QtyAvailable']);
 
 $image=addslashes(file_get_contents($_FILES['file']['tmp_name']));
	
$allowedExts = array("gif", "jpeg", "jpg", "JPG", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg "|| "image/JPG")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 8000000)
&& in_array($extension, $allowedExts))
 {
 if ($_FILES["file"]["error"]>0)
 {
 echo "Return code:". $_FILES["file"]["error"]."<br>";
 }
 else
 {

if(isset($_POST["CatID"]))
{
$CatID=$_POST['CatID'];
	 }
if($_POST['SubmitItemDetails']=="Save"){
$sql="insert into tbl_items (Category_ID, Item_Name, Description, Price, Qnty_Available, image) values ('$CatID','$MealName','$Description','$Price','$QtyAvailable','$image')";
echo "Item successfully added.";
}
if($_POST['SubmitItemDetails']=="Update"){
$ItemID=mysqli_real_escape_string($con, $_POST['ItemID']);
$sql="update tbl_items set Item_Name='$MealName', Description='$Description', Price='$Price', Qnty_Available='$QtyAvailable', image='$image' where Item_ID='$ItemID' ";
echo "Item successfully updated.";
	}
if (!mysqli_query($con,$sql))
{
die('Error: '.mysqli_error($con));
}
 }
 }
 else
 {
 echo "Invalid image";
 }
}
	 ?>
</center>
</body>
</html>
