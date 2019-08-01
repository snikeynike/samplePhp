<?php
session_start();

if(isset($_POST['ClearCart']))
{
unset($_SESSION['CartItem']);	
unset($_SESSION['qty']);
unset($_SESSION['TotalPrice']);
unset($_SESSION['size']);
}
?>

