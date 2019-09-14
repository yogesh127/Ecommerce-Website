<?php
session_start();
include("functions/func.php");
?>
<html>
<head>
<link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
<div class="main_wrapper">
	<div class="header_wrapper">
	<a href="index.php"><img id="img1" src="images/banner.png"  >
	<img id="img1" src="images/log.png"  >
	<img id="img1" src="images/banner.png"  >
	<img id="img1" src="images/log.png"  ></a>
	</div>
	
	<div class="menubar"> 
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_product.php">All Products</a></li>
			<li><a href="customer/my_account.php">My Account</a></li>
			<li><a href="customer_register.php">Sign Up</a></li>
			<li><a href="cart.php">Shopping Cart</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="admin/admin.php">Admin</a></li>
			<?php
		if(!isset($_SESSION['customer_email']))
		{
		echo "<li><a href='checkout.php' > Login </a></li>";
		}
		else
		{
		echo "<li><a href='logout.php' > Log Out </a></li>";
		}
		?>
		
		</ul>
		<div id="form">
		<form method="POST" action="results.php" enctype="multipart/form-data">
		<input type="text" name="user_querry" placeholder="Search a Product"/>
		<input type="submit" name="search" value="Search"/>
		</form>
	 	</div>
	
	 </div>
	
	<div class="content_wrapper">
	
		<div id="sidebar">
			<div id="sidebar_title">categories</div>
			<ul id="cats">
				<?php getCats();?>
			</ul>
		
			<div id="sidebar_title">Brands</div>
			<ul id="cats">
				<?php getbrands();?>
			</ul>	
		</div>
		<div id="content_area">
		<?php cart(); ?>
		<div id="shopping_cart">
		<span style="float:right; font-size:18px; padding:5x; line-height:40px">Welcome :
		<?php
		if(isset($_SESSION['customer_email']))
		{
		$email=$_SESSION['customer_email'];
		echo  "$email";
		}
		else
		{
		echo "GUEST";
		}
		?>
		
		 <b style="color:yellow">Shopping Cart-- </b><b>Total Items:<?php total_items();?>
		Price : &#8377 <?php total_price()?></b> <a href="cart.php" style="color:yellow"> GO to Cart </a>
		
		</span>
		
		</div>
		<div id="product_box">
		<br>
		<form action=""method="post" enctype="multipart/form-data">
		<table algn="center" width="900" >
		
		<tr align="center" style="color:red; font-size:20;">
		
		<th>Remove</th>
		<th>Products</th>
		<th>Quantity</th>
		<th>Total Price</th>
		</tr>
		
		<?php
		$total=0;
		global $con;
		$ip=getIp();
		$sel_price = "select * from cart where ip_add='$ip'";
		$run_price=mysqli_query($con,$sel_price);
		while($p_price=mysqli_fetch_array($run_price))
		{
			$pro_id=$p_price['p_id'];
			$pro_price="select * from products where product_id='$pro_id'";
			$run_pro_price=mysqli_query($con,$pro_price);
			while($price=mysqli_fetch_array($run_pro_price))
			{
			$product_price=array($price['product_price']);
			$product_title=$price['product_title'];
			$product_image=$price['product_image'];
			$product_title=$price['product_title'];
			$product_price1=$price['product_price'];
			$values=array_sum($product_price);
			$total+=$values;
		?>
		<?php
		if(isset($_POST['qty']))
		{
		$qty=$_POST['qty'];
		$update="update cart set qty='$qty'";
		$run_qty=mysqli_query($con,$update);
		$_SESSION['qty']=$qty;
		echo $_SESSION['qty'];
		$total=$total*$qty;
		
		
		}
		?>
		<tr align="center">
		<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"</td>
		<td><?php echo $product_title ;?><br><img src="admin/product_images/<?php echo $product_image;?>" width="60" height="60"/></td>
		<td><input type ="text" size="6" name="qty" value="<?php echo $_SESSION['qty']; ?>" /></td>
		

		<td><?php echo $product_price1;?></td></tr>
		<?php
		}}
		?>
		<tr align="right">
		<td colspan="4"><b>SubTotal</b></td>
		<td colspan="4"><?php echo "$total";?></td>
		</tr>
		<tr align="center">
		<td colspan="2"><input type ="submit" name=update_cart value="Update Cart"</td>
		<td><input type ="submit" name=continue_cart value="Continue"</td>
		<td><button><a href="checkout.php" style ="text-decoration:none;color:black">Checkout</button></a></td>
		</tr>
		</table>
		</form>
		<?php
		function update()
		{
		global $con;
		$ip=getIp();
		{
		if(isset($_POST['update_cart']))
		foreach($_POST['remove'] as $remove_id)
		{
		$delete_pro="delete from cart where p_id='$remove_id' AND ip_add='$ip'";
		$run_delete=mysqli_query($con,$delete_pro);
		if($run_delete)
		echo "<script>window.open('cart.php','self')</script>";
				}
				}
				
			}
			
				if(isset($_POST['continue_cart']))
				{
				echo "<script>window.open('index.php','self')</script>";
				}
				
				@$update=update();
				
		?>
		
		</div>
		</div>
	</div>
	
	<div id="footer">
	<h2 style="text-align:center;padding-top:30px;">&copy:yogesh chaudhary</h2>
	</div>
</div>
	
	
</body>
</html>
