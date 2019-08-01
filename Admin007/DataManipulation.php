<?php 
require("../connection.php");
session_start();

if (isset($_POST['post']))
{
$CatName=mysqli_real_escape_string($con,$_POST['postCatName']);
$sql="insert into tbl_category (Category_Name, ViewInStartUp) values ('$CatName','2')";
if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
}
else if (isset($_POST['postUpdt']))
{
$CatName=$_POST['postCatName'];
mysqli_query($con,"update tbl_category set Category_Name='$CatName' where Category_ID='".$_SESSION['CatIDE']."'");

}

else if (isset($_POST['postdel']))
{
$CatID=$_POST['postCatID'];
mysqli_query($con,"delete from tbl_category where Category_ID='$CatID'");
mysqli_query($con,"delete from tbl_items where Category_ID='$CatID'");
}
else if (isset($_POST['postItemDel']))
{
$ItemID=$_POST['postItemID'];
mysqli_query($con,"delete from tbl_items where Item_ID='$ItemID'");
}
else if (isset($_POST['postCatShow']))
{
$CatID=$_POST['postCatID2'];
mysqli_query($con,"update tbl_category set ViewInStartUp='2' where ViewInStartUp='1'");
mysqli_query($con,"update tbl_category set ViewInStartUp='1' where Category_ID='$CatID'");
}

$info=mysqli_query($con,"Select * from tbl_category");
while($list=mysqli_fetch_array($info))
{
?>

<tr>
	 <td width="17"><div align="center"><?php echo $list['Category_Name']; ?>
     </div></td>
	 <td width="102">
     <a href="?CatIDE=<?php echo $list['Category_ID']; ?>" >Edit</a>|
	 <a CatIDD="<?php echo $list['Category_ID']; ?>" class="delete" href="#?CatIDD="<?php echo $list['Category_ID']; ?>"" >Delete</a>|
	 <a CatIDS="<?php echo $list['Category_ID']; ?>" class="ShowNStartUp"  href="#?CatIDS="<?php echo $list['Category_ID']; ?>"">Show in start up</a>	</td>
	
	 <td width="185">
    <?php
	 $CatID=$list['Category_ID'];
	 $info2=mysqli_query($con,"Select * from tbl_items where Category_ID='$CatID'");
	 
	  while($list2=mysqli_fetch_array($info2))
	  { 
	  echo $list2['Item_Name']."&nbsp;&nbsp;&nbsp;&nbsp;";
	  ?>
<a href="ManageItem.php?ItemInfo=<?php echo $list2['Item_ID']; ?>">Edit</a>|
<a ItemIDD="<?php echo $list2['Item_ID']; ?>" class="deleteItem" href="#?ItemIDD="<?php echo $list2['Item_ID']; ?>"">Delete</a><?php
	  echo "<br>";
	  }
	 ?>	 
    <form action="ManageItem.php" method="post">
	   <input type="hidden" value="<?php echo $list['Category_ID']; ?>" name="CatID"  />
	   <input name="submit" type="submit" id="additem" value="Add Items" style="height:20px; width:75px; padding:0px 10px; font-size:12px" />
    </form>	 </td>
  </tr>
<?php }

 ?>
