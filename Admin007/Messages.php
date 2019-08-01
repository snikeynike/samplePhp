<?php 
require("../connection.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Messages</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
</head>

<body>
<div id="container9">
<a href="ManageMenu.php">Manage menu</a>|<a href="Messages.php">Messages</a>|<a href="ReceivedOrder.php">Received orders</a>
<div id="table1">
<table width="964" >
  <tr>
    <th width="88"><div align="center">MsgID</div></th>
    <th width="209"><div align="center">From</div></th>
    <th width="243"><div align="center">Subject</div></th>
    <th width="240"><div align="center">message</div></th>
    <th width="150"><div align="center">Received</div></th>
  </tr>
  <?php 
  $selectMsg=mysqli_query($con,"select * from tbl_messages");
  while($x=mysqli_fetch_array($selectMsg)){
  ?>
  <tr>
    <td><a href="MessageContent.php?msgID=<?php echo $x['Message_ID']; ?>"><?php echo $x['Message_ID']; ?></a></td>
    <td><a href="MessageContent.php?msgID=<?php echo $x['Message_ID']; ?>"><?php echo $x['email']; ?></a></td>
    <td><a href="MessageContent.php?msgID=<?php echo $x['Message_ID']; ?>"><?php echo $x['subject']; ?></a></td>
    <td><a href="MessageContent.php?msgID=<?php echo $x['Message_ID']; ?>"><?php echo $x['message']; ?></a></td>
    <td><a href="MessageContent.php?msgID=<?php echo $x['Message_ID']; ?>"><?php echo $x['msgdate']; ?></a></td>
  </tr>
  <?php }
   ?>
</table>
</div>
</div>
</body>
</html>
