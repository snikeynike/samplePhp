<?php
require("connection.php");
session_start();

if(isset($_POST['ItemSelected'])) 
{
$itemID=$_POST['postItemID'];
$qty=$_POST['postQty'];

$available=mysqli_query($con,"select * from tbl_items where Item_ID='$itemID'");
$available=mysqli_fetch_array($available);
$available=$available['Qnty_Available'];

if($available >= $qty){
	
if(isset($_SESSION['size'])){
	for($x=0;$x<$_SESSION['loopnum'];$x++)
{
if(isset($_SESSION['CartItem'][$x]))
{	
if($_SESSION['CartItem'][$x]==$itemID)
	{
	$_SESSION['qty'][$x]=$_SESSION['qty'][$x]+$qty;
	$hasDuplicate=1;
	break;
	}
}	
}
	
	}	
	
if(!isset($_SESSION['CartItem']))
	{
$_SESSION['CartItem']=array();
$_SESSION['qty']=array();
$_SESSION['index']=0;
}

if(!isset($hasDuplicate))
{
$_SESSION['CartItem'][$_SESSION['index']]=$itemID;
$_SESSION['qty'][$_SESSION['index']]=$qty;
$_SESSION['size']=count($_SESSION['CartItem']);
$_SESSION['index']++;
}
}else{
	$ShortAvailable=0;
	}

}//end of if(isset($_POST['ItemSelected']))

else if(isset($_POST['postRefresh']))
{
	if(!isset($_SESSION['size']))
	{
		$_SESSION['size']=0;
	}	
}//end of if(isset($_POST['postRefresh']))

if (!isset($ShortAvailable)){
	
$total2=0;
if(isset($_SESSION['unseted'])){
$_SESSION['loopnum']=$_SESSION['size']+$_SESSION['unseted'];
}else{
$_SESSION['loopnum']=$_SESSION['size'];
	}
	?>
	<table width="259" style="border-spacing:0"">
	<?php
for($x=0;$x<$_SESSION['loopnum'];$x++){
	if(isset($_SESSION['CartItem'][$x])){
$Item=mysqli_query($con,"select * from tbl_items where Item_ID='".$_SESSION['CartItem'][$x]."'");
$Item=mysqli_fetch_array($Item);
?>

<tr>
<td width="192" style="border-bottom:solid 1px"><?php echo $Item["Item_Name"]; ?></td>
<td width="57" style="border-bottom:solid 1px"><?php echo " x ".$_SESSION['qty'][$x]."<br>"; ?></td>
</tr>

<?php
/*echo $Item["Item_Name"]." x ".$_SESSION['qty'][$x]."<br>";*/

$total=$Item['Price']*$_SESSION['qty'][$x];
$total2=$total2+$total;
}}
?>
</table>
<?php
$_SESSION['TotalPrice']= $total2;

}	
else{
	
	echo "shortitem";
	
	}
?>