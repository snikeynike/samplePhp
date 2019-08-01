<?php
require("connection.php");

if (isset($_POST['ShowSubCat']))
{
$CatID=$_POST['postCatID'];
$CategoryName=mysqli_query($con,"select * from tbl_category where Category_ID='$CatID'");
$CategoryName=mysqli_fetch_assoc($CategoryName);
echo $CategoryName['Category_Name'];
}
if (isset($_POST['ShowSubCatSU']))
{
$CategoryName=mysqli_query($con,"select * from tbl_category where ViewInStartUp='1'");
$CategoryName=mysqli_fetch_assoc($CategoryName);
echo $CategoryName['Category_Name'];
}

else if (isset($_POST['ShowItemsSU']))
{
$CatID=mysqli_query($con,"select * from tbl_category where ViewInStartUp='1'");
$IDMenu=mysqli_fetch_array($CatID);
$IDMenu=$IDMenu['Category_ID'];
}
else if (isset($_POST['ShowItems']))
{
//$CustID=$_POST['postCustID'];
$IDMenu=$_POST['postCatID'];
}
if(isset($IDMenu)){
$MenuDetail=mysqli_query($con,"select * from tbl_items where Category_ID='$IDMenu'");
$Category=mysqli_query($con,"select * from tbl_category where Category_ID='$IDMenu'");
$Category=mysqli_fetch_assoc($Category);

?>
<br />
<?php
$arrayItemID=array();
$indexNo=0;
while($List=mysqli_fetch_assoc($MenuDetail))
{
$arrayItemID[$indexNo]=$List['Item_ID'];
$indexNo++;
}
$arraySize2=count($arrayItemID);
$indexNo3=0;
$arraySelectItemID=array();
while($arraySize2>0)
{
if($arraySize2>=5){$n=5; }else{$n=$arraySize2;}
for($indexNo2=0;$indexNo2<$n;$indexNo2++)
{
$arraySelectItemID[$indexNo2]=$arrayItemID[$indexNo3];//for items to display
$indexNo3++;
}?>

<table border="0" cellspacing="0" style="width: 25%; height:15p%">
<tr><?php
for($indexNo4=0;$indexNo4<$n;$indexNo4++)
{
$ItemID=$arraySelectItemID[$indexNo4];
$arraySize2--;
$ItemID2=mysqli_query($con,"select * from tbl_items where Item_ID='$ItemID'");
while($Item=mysqli_fetch_array($ItemID2))
{
?>
<td style="width:auto;" align="center">
<h3>
<a ItemIDSel="<?php echo $Item['Item_ID']; ?>" ItemName="<?php echo $Item['Item_Name']; ?>" class="select" href="#?ItemIDSel="<?php echo $Item['Item_ID']; ?>"" ><img style="border-radius:8px; box-shadow: 0px 1px 8px #5E5E5E" src="ShowImage.php?id=<?php echo $Item['Item_ID']; ?>" width="170" height="185"/></a>

</h3>


<h2 align="center" style="text-shadow: 0px 1px 1px #000000">
<a ItemIDSel="<?php echo $Item['Item_ID']; ?>" ItemName="<?php echo $Item['Item_Name']; ?>" href="#?ItemIDSel="<?php echo $Item['Item_ID']; ?>"" style="text-decoration:none;"><?php echo $Item['Item_Name']."<br>";?></a>
 </h2>

  <?php  
echo $Item['Description']."<br>";
echo "<br>";
echo "Php ".$Item['Price']."<br>";
echo "<br>";
echo "Availability: ".$Item['Qnty_Available']."<br>";
?>
<br>
<br>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<?php
}
}?>
</tr>
</table>

<?php
}}//mysqli_close($con);
?>
