<?php
require("connection.php");
session_start();

 ?>
 
 
<?php if(!isset($_SESSION['sendorderSent'])) {?>

<div id="container3">
<a href="index.php">Go to menu</a>
<div id="Cell">
<table width="609px" border="0" cellspacing="1">
  <tr>
    <th height="40" style="background-color:#000000; color:#FFFFFF"><div align="left">Checkout</div></th>
  </tr>
  <tr>
    <td width="755" height="40" style="background-color:#FFFF99"><div align="center" class="style1"> Summary </div></td>
  </tr>
  <tbody>
  <tr>
     <td colspan="2"><h1 align="justify">Order Details</h1>
     <?php
 /*while($y=mysqli_fetch_array($Orders)){*/
 foreach($_SESSION['CartItem'] as $key => $value){
 $Meal=mysqli_query($con,"select * from tbl_items where Item_ID='$value'");
 $z=mysqli_fetch_array($Meal);
 
 echo "<p align='justify'>";
 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  echo $z['Item_Name']." x ".$_SESSION['qty'][$key]."<br>";
  echo "</p>";
 }
  echo "<hr />";
  echo "<p align='justify'>";
   echo "Total price:";
  echo "Php ".$_SESSION['TotalPrice']."<br>";
  echo "</p>";
 ?></td>
   </tr>
   
    <tr>
     <td width="17" align="justify">
     <h1 align="justify">Customer Details</h1> 
   <?php
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
   echo "Name: ".$_SESSION['FullName']."<br>"; 
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "E-mail: ".$_SESSION['chkoutEmail']."<br>"; 
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "Primary Number: ".$_SESSION['Contact_Num']."<br>"; 
     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "Address type: ".$_SESSION['Address_type']."<br>"; 
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  	echo "Town/Subdivision/Village/Brgy: ".$_SESSION['Town']."<br>"; 
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "Street: ".$_SESSION['Street']."<br>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  	echo "Landmark: ".$_SESSION['Landmark']."<br>";
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
   	echo "Corner Street: ".$_SESSION['Corner_Street']."<br>";
     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Building: ".$_SESSION['Building']."<br>"; 
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "Floor/Dept/HouseNo: ".$_SESSION['FloorDeptHouseNo']."<br>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "Special instruction: ".$_SESSION['Special_instruction']."<br>"; 

?>
     </td>
   </tr>
  </tbody>
</table>
</div>
<div align="right">
<form action="?" method="post">
   <p>
     <input type="submit" name="Back" value="Back" style="width:100px; height:35px; background-color:#FFFF80" />
     <input type="button" name="Send" value="Send" style="width:100px; height:35px; background-color:#FFFF80" onclick="functionSend()" />
  </p>
</form>
</div>
</div>



<?php 
}else{
require("LastPage.php");
}?>