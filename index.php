<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
} 
require("connection.php");

if(isset($_POST['Submit']))
{
if(!isset($_SESSION['CartItem']))
{
$nav="You have to place order first.";
}else{
$redirect="Checkout.php";
header("Location: ".$redirect);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu</title>
<link rel="shortcut icon" href="images/centro_Icon.ico">
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="styleTwo.css" media="all" />
</head>

<body>
<div id="header">
&nbsp;&nbsp;<img src="images/Centro_logo3.png" width="60" height="60"/>

<br />
</div>
<?php
$menu=mysqli_query($con,"select * from tbl_category order by ViewInStartUp ASC");
$MenuIDArr=array();
$index=0;
while ($menusID=mysqli_fetch_array($menu)) 
{
$MenuIDArr[$index]=$menusID['Category_ID'];
$index++;
}

$arrSize=count($MenuIDArr);
$index3=0;
$MenuIDArr2=array();

while($arrSize>0)
{
if($arrSize>=9){$n=9; }else{$n=$arrSize;}
for($index2=0;$index2<$n;$index2++)
{
$MenuIDArr2[$index2]=$MenuIDArr[$index3];
$index3++;
}
?>
<div id="menu">
<div id="menulinks">
<table border="0" cellspacing="0">
<tr>
<?php
for($index4=0;$index4<$n;$index4++)
{
$ID=$MenuIDArr2[$index4];
$arrSize--;
$menu2=mysqli_query($con,"select * from tbl_category where Category_ID='$ID'");
 while ($menus=mysqli_fetch_array($menu2)) 
{
?>
<td width="0" style="height:auto">
 <a CatID="<?php echo $menus['Category_ID']; ?>" class="Show" href="#?CatID="<?php echo $menus['Category_ID']; ?>"" style="text-decoration:none"><?php echo $menus['Category_Name']; ?></a><br />
  </td>
 <?php
 }//x
 }
?>
</tr>
</table>
 </div>
</div> <!--end of menu -->
<?php } ?>
<div id="Subcategory"><div id="result2"></div></div>
<!--<a href="thickbox.php" class="thickbox" title="">Try</a> -->
<div id="content">
<div id="result"></div>
</div>

<div id="sidebar" class="radius">
<div class="box-header">
<span class="box-header-title">My Orders</span>
</div>

  <div align="center">
    <div id="order-bax">
    <div id="ItemInCart"></div>
    </div>
  </div>
  
<a class="clear" href="#?">Clear cart</a>| 
<a class="mngItemPlcd" href="#?">Manage Order</a>
<div id="TotalPrice"></div>
    <form action="?" method="post">
      <label><div align="center">
	  <?php 
	  if(isset($nav)){
		  ?><div class="alert alert-danger"><?php
	  echo "<strong>".$nav."</strong>"; 
	  }
	  ?>
	  </div>
        <input type="submit" name="Submit" value="Proceed to checkout" style="width:280px; height:35px; background-color:#FFFF80; font-size:14px" />
		</div>
        </label>
    </form>
</div> <!--end of sidebar -->

<script>
PostStartUpSubCat();
PostStartUpItems();
PostRefreshCart();
$('body').delegate('.Show','click',function() { 
 var CatID=$(this).attr('CatID');
  $.post('MenuManipulation.php',{postCatID:CatID, ShowSubCat:1},
  function(data)
  {
  $('#result2').html(data);
  });
});	 


function PostStartUpItems()
 { 
  $.post('MenuManipulation.php',{ShowItemsSU:1},
  function(data)
  {
  $('#result').html(data);
  });
  }
  
  function PostStartUpSubCat()
 { 
  $.post('MenuManipulation.php',{ShowSubCatSU:1},
  function(data)
  {
  $('#result2').html(data);
  });
  }
  
   function PostRefreshCart()
 { 
  $.post('ItemPlaced.php',{postRefresh:1},
  function(data)
  {
  $('#ItemInCart').html(data);
  totalprice();
  });
  }

$('body').delegate('.Show','click',function() { 
 var CatID=$(this).attr('CatID');
  $.post('MenuManipulation.php',{postCatID:CatID, ShowItems:1},
  function(data)
  {
  $('#result').html(data);
  });
});
  
  $('body').delegate('.clear','click',function() { 
	if(confirm("Are you sure you want to clear the cart?")==true){
  $.post('ClearCart.php',{ClearCart:1},
  function(data)
  {
  $('#ItemInCart').html(data);
  totalprice();
  });
  }
});	

$('body').delegate('.mngItemPlcd','click',function() { 
  $.post('ManageItemPlaced.php',
  function(data)
  {
  $('#ItemInCart').html(data);
  });
});	 
		
$('body').delegate('.select','click',function() { 
 	var ItemID=$(this).attr('ItemIDSel');
	var ItemName=$(this).attr('ItemName');
	var Quantity= prompt("Enter quantity for "+ItemName,"1");
 	if(Quantity!=null){
  $.post('ItemPlaced.php',{postItemID:ItemID, postQty:Quantity, ItemSelected:1,},
  function(data)
  {
  if(data=="shortitem"){
  alert("Sorry, the quantity you entered\nis to much than the item availability\nor the item is not available.");}else{
  $('#ItemInCart').html(data);
  totalprice();}
  });
  }
});	 

function totalprice(){
$.post('TotalPrice.php',{ViewTotalPirce:1},
function(data){
$('#TotalPrice').html(data);
})
}

$('body').delegate('.deleteCartItem','click',function() { 
 var index=$(this).attr('index');
  $.post('ManageItemPlaced.php',{postIndex:index, postItemDel:1},
  function(data)
  {
  $('#ItemInCart').html(data);
  totalprice();
  });
  
});	 

$('body').delegate('.updateCartItem','click',function() { 
 var index=$(this).attr('index');
 var val=$('#textfield').val();
  $.post('ManageItemPlaced.php',{postVal:val, postIndex:index, postItemUpd:1},
  function(data)
  {
  $('#ItemInCart').html(data);
  totalprice();
  });
});	

</script>
<div id="footer">
<a style="padding-right:20px" href="ContactUs.php">Contact us </a>
</div>
</body>
</html>
