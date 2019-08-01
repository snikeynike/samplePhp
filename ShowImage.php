<?php
require("connection.php");
if (isset($_GET['id']))
{
$id=$_GET['id'];
$pq=mysqli_query($con,"select * from tbl_items where Item_ID='$id'");
while($row=mysqli_fetch_array($pq))
{
$imagedata=$row['image'];
}
header('content-type: image/png');
echo $imagedata;
}
 else
{
echo "error!";
} 
?>