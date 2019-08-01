<?php
require("../connection.php");
session_start();
if(isset($_GET['CatIDE']))
{
	$catInfo=mysqli_query($con,"select * from tbl_category where Category_ID='".$_GET['CatIDE']."'");
	$catInfo=mysqli_fetch_array($catInfo);
	$_SESSION['CatIDE']=$_GET['CatIDE'];
	$catName=$catInfo['Category_Name'];
	$btnName="Update";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manage Menu</title>
<link rel="shortcut icon" href="../images/centro_Icon.ico">
<link rel="stylesheet" type="text/css" href="../styleTwo.css" media="all" />
<script src="../jquery-1.11.1.min.js"></script>
</head>

<body>
 <p> 
 <center>
 <a href="ManageMenu.php">Manage menu</a>|<a href="Messages.php">Messages</a>|<a href="ReceivedOrder.php">Received orders</a>
 </center><br>
 <form>
  <table width="184" border="0" align="center">
    <tr>	
      <td><input id="menu" type="text" placeholder="Enter new category here..." value="<?php if(isset($_GET['CatIDE'])){echo $catName;} ?>" style="height:30px" /></td>
    </tr>
    <tr>
      <td><input id="btn" type="button" style="height:32px" value="<?php if(isset($btnName)){echo $btnName;}else{echo "Save";} ?>" onclick="PostInsertCat();"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<div id="table1">
<table width="510" align="center">
   <thead>
   <tr><th colspan="2"><div align="center">Category</div></th>
     <th width="352"><div align="center">Items</div></th>
   </thead>
   
     <td  style="background-color:#8CC4ED" width="350">Category Name </td>
     <td style="background-color:#8CC4ED" width="350">Action</td>
     <td style="background-color:#8CC4ED">Item Name    </td>
  <tbody id="result">
  </tbody>
</table>
</div>
<script type="text/javascript">
PostDisplayMenu();
function PostInsertCat() { 
 var CatName=$('#menu').val();
 var btn=$('#btn').val();
 if(btn=="Update")
 {
	if(confirm("Are you sure you want to update this category?")==true)
  {
	  
  $.post('DataManipulation.php',{postCatName:CatName, postUpdt:1},
  function(data)
  {
  $('#result').html(data);
   $('#btn').html('Save');
  });
  } 
	 }else{
  if(confirm("Are you sure you want to add "+CatName+"\nas new category?")==true)
  {
  $.post('DataManipulation.php',{postCatName:CatName, post:1},
  function(data)
  {
  $('#result').html(data);
  });
  }}
}	 
$('body').delegate('.delete','click',function() { 
 var CatID=$(this).attr('CatIDD');
  if(confirm("Are you sure you want to delete this category?")==true)
  {
  $.post('DataManipulation.php',{postCatID:CatID, postdel:1},
  function(data)
  {
  $('#result').html(data);
  });
  }
});	 

$('body').delegate('.deleteItem','click',function() { 
 var ItemIDD=$(this).attr('ItemIDD');
  if(confirm("Are you sure you want to delete this item?")==true)
  {
  $.post('DataManipulation.php',{postItemID:ItemIDD, postItemDel:1},
  function(data)
  {
  $('#result').html(data);
  });
  }
});	 

$('body').delegate('.ShowNStartUp','click',function() { 
 var CatIDS=$(this).attr('CatIDS');
  if(confirm("Show this category\nin start up?")==true)
  {
  $.post('DataManipulation.php',{postCatID2:CatIDS, postCatShow:1},
  function(data)
  {
  $('#result').html(data);
  });
  }
});	 

function PostDisplayMenu() { 
  $.post('DataManipulation.php',
  function(data)
  {
  $('#result').html(data);
  });
  }


</script>
 
</body>

</html>
