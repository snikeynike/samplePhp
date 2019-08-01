<?php require_once('../Connections/logincon.php'); 
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Uname'])) {
  $loginUsername=$_POST['Uname'];
  $password=$_POST['Pword'];
  $MM_fldUserAuthorization = "User_Type";
  $MM_redirectLoginSuccess = "ReceivedOrder.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($logincon, $database_logincon);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM tbl_user WHERE Username='%s' AND Password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($logincon, $LoginRS__query) or die(mysqli_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<style type="text/css">
body {
	background-image: url();
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<div id="LoginSidebar" class="radius">
<div class="box-header">
<div class="box-header-title">Login</div>
</div>
<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" name="loginuser">
<table width="200" border="0" align="center" cellspacing="0">
  <tr>
    <td>Username </td>
  </tr>
  <tr>
    <td><label>
      <input type="text" name="Uname" />
    </label></td>
  </tr>
  <tr>
    <td><label>Password</label></td>
  </tr>
  <tr>
    <td><input type="password" name="Pword" /></td>
  </tr>
  <tr>
    <td><label>
      <input type="submit" name="Submit" value="Login" style="height:32px" />
    </label></td>
  </tr>
</table>
</form>
</div>

</body>
</html>
