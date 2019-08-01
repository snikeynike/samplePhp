<?php
require("connection.php");
session_start();

if(isset($_POST['Send'])){
$OrderID=mysqli_query($con,"Select max(Order_ID) as maxID from tbl_item_placed");
$OrderID=mysqli_fetch_array($OrderID);
$OrderID=$OrderID['maxID'];
if($OrderID==""){
$OrderID="1";
}else{
$OrderID=$OrderID+1;
$OrderID=$OrderID;
}

$CustID=mysqli_query($con,"Select max(Customer_ID) as maxCID from tbl_customer");
$CustID=mysqli_fetch_array($CustID);
$CustID=$CustID['maxCID'];
if($CustID==""){
$CustID="1";
}else{
$CustID=$CustID+1;
$CustID=$CustID;
}


//insert tbl_customer
mysqli_query($con,"insert into tbl_customer (Customer_ID, LName, FName, email) values ('$CustID', '".$_SESSION['txtLName']."', '".$_SESSION['txtFName']."', '".$_SESSION['chkoutEmail']."')");

//insert tbl_deliveryinfo
mysqli_query($con,"insert into tbl_deliveryinfo (Customer_ID, Contact_Num, Address_type, Town, Street, Landmark, Corner_Street, Building, FloorDeptHouseNo, Special_instruction) values ('$CustID', '".$_SESSION['Contact_Num']."', '".$_SESSION['Address_type']."', '".$_SESSION['Town']."', '".$_SESSION['Street']."', '".$_SESSION['Landmark']."', '".$_SESSION['Corner_Street']."', '".$_SESSION['Building']."', '".$_SESSION['FloorDeptHouseNo']."', '".$_SESSION['Special_instruction']."')");

//send order
foreach($_SESSION['CartItem'] as $key => $value){
mysqli_query($con,"insert into tbl_item_placed (Order_ID, Item_ID, Customer_ID, Quantity) values ('$OrderID','$value','$CustID','".$_SESSION['qty'][$key]."')");

}

mysqli_query($con,"insert into tbl_order (Order_ID, Bill, Order_DateTime, Delivery_ideal_time, Payment_type, Payment, Customer_ID) values ('$OrderID', '".$_SESSION['TotalPrice']."', NOW() , '', '".$_SESSION['PaymentType']."', '".$_SESSION['Payment']."', '$CustID')");

//clear cart
unset($_SESSION['CartItem']);
unset($_SESSION['qty']);

$_SESSION['OrderID']=$OrderID;
 }

$_SESSION['sendorderSent']="1";
require("LastPage.php");
 ?>
  
 

