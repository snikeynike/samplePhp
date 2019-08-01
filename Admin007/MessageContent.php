<?php 
require("../connection.php");
session_start();

if(isset($_POST['Send']))
{
   /*$to = $_POST['email'];
   $subject = "This is from Centro Resto House";
   $message = $_POST['textMessage'];
   $header = "From:admin007@centrorestohousedelivery.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )  
   {*/
      $alert_info="E-mail sent successfully...";
   /*}
   else
   {
      $alert_danger="Message could not be sent...";
   }*/
}
if(!isset($_SESSION["msgID"])){
$_SESSION["msgID"]=$_GET['msgID'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Message Content</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideDown("slow");
  });
});

</script>
<style> 
#panel,#flip
{
padding:5px;
}
#panel
{
width:610px;
padding:0px;
display:none;
}
</style>
</head>

<body>
<div id="container8">
<?php
if(isset($alert_info))
{
?>
<div class="alert alert-info">
<?php
echo $alert_info;
?>
</div>
<?php	
}if(isset($alert_danger)){
?>
<div class="alert alert-danger">
<?php
echo $alert_danger;
?>
</div>
<?php	
	}
 ?>

<table width="604">
<?php 
$select=mysqli_query($con,"select * from tbl_messages where Message_ID='".$_SESSION["msgID"]."'");
$y=mysqli_fetch_array($select);

?>
  <tr>
    <td width="594" height="53" style="border-bottom:solid 1px"><?php echo $y['subject']; ?></td>
  </tr>
  <tr>
    <td height="52" style="border-bottom:solid 1px">From &nbsp;<?php echo $y['email']; ?></td>
  </tr>
  <tr>
    <td height="142" style="border-bottom:solid 1px; background-color:#FFFFFF"><?php echo $y['message']; ?></td>
  </tr>
  <tr>
    <td height="36"><a href="#"><div id="flip">Reply</div></a></td>
  </tr>
</table>

<div id="panel">
<table width="604" border="0">
  <tr>
    <td>To &nbsp;<?php echo $y['email']; ?></td>
  </tr>
  <form action="?" method="post">
  <tr>
    <td height="113"><label>
      <textarea name="textMessage" style="width:590px; height:170px"></textarea>
	  <input type="hidden" name="email" value="<?php echo $y['email']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="Send" value="Send" style="width:100px; height:35px; background-color:#FFFF80" />
    </label></td>
  </tr>
  </form>
</table>
</div>
<form action="Messages.php">
&nbsp;<input type="submit" name="Back" value="Back" style="width:100px; height:35px; background-color:#FFFF80" />
</form>
</div>
<!--<div id="flip">Reply</div>
<div id="panel">hello</div> -->
</body>
</html>
