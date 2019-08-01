<?php
session_start();
if(isset($_POST['ViewTotalPirce'])){
if(isset($_SESSION['TotalPrice'])){
$total=$_SESSION['TotalPrice'];
}
}
if(isset($total)){
echo "Total price: Php ".$total; 
}else{
	echo "Total price: ";
	}
?> 