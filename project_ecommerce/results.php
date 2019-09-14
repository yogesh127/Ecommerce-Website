<?php
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
		<?php
		if(isset($_POST['search']))
		{
		$userquerry=$_POST['user_querry'];
		$get_pro="select * from products where product_keywords like'%$userquerry%'";
	$run_pro=mysqli_query($con,$get_pro);
	while($row_pro=mysqli_fetch_array($run_pro))
	{
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
		
		echo "
			<div id='single_product'>
			<h3>$pro_title</h3>
			<img src='admin/product_images/$pro_image' width='150' height='150'/>
			<p></b> RS-$pro_price</b></p>
			<a href='detail.php?pro_id=$pro_id' style='float:left'>Details</a>
			<a href='index.php?pro_id=$pro_id'> <button style='float:right'>Add to cart</button></a>
			</div>
		
		";
	}
	}
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
