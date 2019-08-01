<?php 
require("connection.php");

if(isset($_POST['Submit'])){
if($_POST['textLName']!="" || $_POST['textFName']!="" || $_POST['textEmail']!="" || $_POST['textSubject']!="" || $_POST['textMessage']!="")
{
$lname=mysqli_real_escape_string($con,$_POST['textLName']);
$fname=mysqli_real_escape_string($con,$_POST['textFName']);
$email=mysqli_real_escape_string($con,$_POST['textEmail']);
$subject=mysqli_real_escape_string($con,$_POST['textSubject']);
$message=mysqli_real_escape_string($con,$_POST['textMessage']);
mysqli_query($con,"insert into tbl_messages (lname, fname, email, subject, message, msgdate) values ('$lname', '$fname', '$email', '$subject', '$message', NOW())");
$promptSuccess="Thank you! your message has been sent.";
}else{
$promptFaild="Filling all fields are required";
}
}
else if(isset($_POST['Back']))
{
$Redirect="index.php";
header("Location: ".$Redirect);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact us</title>
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
<!--<link rel="stylesheet" type="text/css" href="bootstrap.min.css" media="all" />-->
</head>

<body>
<div id="container7">
<div align="right"><?php
 if(isset($promptFaild)){
 echo $promptFaild; }
 ?></div>
<form action="?" method="post">
<table width="250" border="0">
  <tr>
    <th height="40" style="background-color:#000000; color:#FFFFFF"><div align="left">Customer message</div></th>
  </tr>
  <tr>
    <td><label>Last Name</label></td>
  </tr>
  <tr>
    <td><input style="width:500px" type="text" name="textLName" class="input-lg" /></td>
  </tr>
  <tr>
    <td><label>First Name</label></td>
  </tr>
  <tr>
    <td><input style="width:500px" type="text" name="textFName" /></td>
  </tr>
  <tr>
    <td><label>E-mail address </label></td>
  </tr>
  <tr>
    <td><input style="width:500px" type="text" name="textEmail" /></td>
  </tr>
  <tr>
    <td><label>Subject</label></td>
  </tr>
  <tr>
    <td><input style="width:500px" type="text" name="textSubject" /></td>
  </tr>
  <tr>
    <td><label>Message</label></td>
  </tr>
  <tr>
    <td><textarea style="height:100px; width:518px" name="textMessage" cols="" rows=""></textarea></td>
  </tr>
</table>
<?php
if(isset($promptSuccess)){
 echo $promptSuccess;} ?>
  <div align="right">
    <input type="submit" name="Back" style="width:100px; height:35px; background-color:#FFFF80" value="Back" />
  <input type="submit" name="Submit" style="width:140px; height:35px; background-color:#FFFF80" value="Send Message" />
  </div>
</form>
</div>
<p>&nbsp;</p>
</body>
</html>
