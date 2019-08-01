<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manage Menu</title>
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
<script src="jquery-1.11.1.min.js"></script>
</head>

<body>
<div id="header">
&nbsp;&nbsp;<img src="images/Centro_logo3.png" width="60" height="60"/><br />
</div>
 <p> 
 <form>
  <table width="184" border="0" align="center">
    <tr>	
      <td><input id="menu" type="text" placeholder="Enter new category here..." style="height:30px" /></td>
    </tr>
    <tr>
      <td><input type="button" value="Save" onclick="PostInsertCat();" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<table width="510" border="1" align="center" bordercolor="#FFFF00">
   <thead>
   <tr><th colspan="2"><div align="center">Category</div></th>
     <th width="352"><div align="center">Items</div>
   </thead>
   <tr>
     <th width="350">Category Name </th>
     <th width="350">Action</th>
     <th>Item Name    </th>
  <tbody id="result">
  </tbody>
</table>

<script type="text/javascript">
PostDisplayMenu();
function PostInsertCat() { 
 var CatName=$('#menu').val();
  if(confirm("Are you sure you want to add "+CatName+"\nas new category?")==true)
  {
  $.post('DataManipulation.php',{postCatName:CatName, post:1},
  function(data)
  {
  $('#result').html(data);
  });
  }
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
