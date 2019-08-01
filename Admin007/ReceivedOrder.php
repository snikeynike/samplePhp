<?php
session_start();
require("../connection.php");
 ?>
<?php 

if(isset($_GET['Confirm']))
{
$_SESSION['Cust_ID']=$_GET['Cust_ID'];
$_SESSION['OrderID_Confirm']=$_GET['OrderID'];
$redirect="Confirmation.php";
header("Location: ".$redirect);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Inbox</title>
</head>

<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>

<body>
<div id="container6">
 <a href="ManageMenu.php">Manage menu</a>|<a href="Messages.php">Messages</a>|<a href="ReceivedOrder.php">Received orders</a>
 <h1>Received orders&nbsp;<span class="badge" id="total"></span></h1>
    <div id="table1">
     <a href="ROConfirmed.php">Go to confirmed orders</a>
    <table width="521" style="width:500px;">
     <tr>
        <th width="90">Order ID</th>
        <th width="101">Customer ID </th>
        <th width="130">Date Received</th>
        <th width="161"> Action</th>
		
          <tbody id="ROcontent">
      <!--<div id="ROcontent"></div>-->
      </tbody>
      </tr>
    </table>
    </div>
</div>
<script type="text/javascript">
Count();
ROContent();
	var z=0;
function Count()
 { 
  $.post('autoRefQuery.php',
  function(data)
  {
  z=data;
  $('#total').html(data);
  });
  }

function ROContent()
 { 
  $.post('ROUnCon.php',
  function(data)
  {
  $('#ROcontent').html(data);
  });
  }
  
  autoRef();
function autoRef()
 { 
  $.post('autoRefQuery.php',
  function(data)
  {
	if(z!=data)
	{
		 z=data;
		 $('#total').html(data);
		 ROContent();
	}
	autoRef();
  });
  }

</script>
</body>
</html>
