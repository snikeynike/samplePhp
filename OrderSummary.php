<?php
if (!isset($_SESSION)) {
  session_start();
}
require("connection.php");

if(isset($_POST['Back']))
{
$MM_Redirect="Checkout.php";

header("Location: ". $MM_Redirect );

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Summary</title>
<link rel="shortcut icon" href="images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 20px}
-->
</style>
</head>

<body id="cont"> 

<script>
 OrderSummary();
function OrderSummary()
{
$.post('ViewSummary.php',{ViewSummary:1},
function(data){
		$('#cont').html(data);
		})
}

function functionSend()
{
if (confirm("Are you sure you want to send?")==true)
{
$.post('sendOrder.php',{Send:1},
function(data){
$('#cont').html(data);
});
}
}
</script>
</body>
</html>
