<?php
session_start();
include("functions/func.php");
include("admin/include/db.php");
?>
<html>
<head>
<script src="myscript.js"></script>
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
		
		<form action="customer_register.php" method="post" enctype="multipart/form-data">
		<table align="center" width="900" height="500" >
		<tr style="text-decoration:underline;font-size:20px;">
		<td align="center" colspan="6">Create An Account:</td>
		</tr>
		<tr><td><br></td></tr>
		
		<tr>
		<td align="right">Customer Name:</td>
		<td><input type="text" name="c_name" id="name" required/></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">Customer Email:</td>
		<td><input type="text" name="c_email" id="email" required/></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">Password:</td>
		<td><input type="text" name="c_pass" id="password" required/></td>
		</tr>
		<tr><td><br></td></tr>
		<td align="right">Customer Image:</td>
		<td><input type="file" name="c_image"/></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">Country:</td>
		<td><select name="c_country">
		<option>India</option>
		<option>USA</option>
		<option>CANADA</option>
		<option>RUSSIA</option>
		<option>AUSTRALIA</option>
		</td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">City:</td>
		<td><input type="text" name="c_city" required/></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">Contact No:</td>
		<td><input type="text" name="c_contact" id="contact" required/></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
		<td align="right">Address:</td>
		<td><textarea cols="20" rows="10" name="c_address" id="address" required/></textarea></td>
		</tr>
		<tr><td><br></td></tr>
		<tr align="center">
		<td colspan="6"><input type="submit" name="submit" value="Create Account"  id="submit" onclick="f1(this.form)" </td>
		</tr>
		<tr><td><br></td></tr>
		</table>
		</form>
		</div>
	</div>
	
	<div id="footer">
	<h2 style="text-align:center;padding-top:30px;">&copy:yogesh chaudhary</h2>
	</div>
</div>
	
	
</body>
</html>
<?php
if(isset($_POST['submit']))
{
	$ip=getIP();
$con=mysqli_connect("localhost","root","","ecommerce");
	$c_name=$_POST['c_name'];
	$c_email=$_POST['c_email'];
	$c_pass=$_POST['c_pass'];
	$c_country=$_POST['c_country'];
	$c_city=$_POST['c_city'];
	$c_address=$_POST['c_address'];
	$c_image=$_FILES['c_image']['name'];
	$c_image_tmp=$_FILES['c_image']['tmp_name'];
	$c_contact=$_POST['c_contact'];
	move_uploaded_file($c_image_tmp,"customer/images/$c_image");
	$insert="insert into customers(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image)
	 values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	 $run=mysqli_query($con,$insert);

	$sel="select * from cart where ip_add='$ip'";
	$run_cart=mysqli_query($con,$sel);
	$check=mysqli_num_rows($run_cart);
	if($check==0)
	{
	$_SESSION['customer_email']=$c_email;
	echo "<script>alert('Account Has Been Created Successfully')</script>";
	echo "<script>window.open('index.php','self')</script>";
	}
	else
	{
	$_SESSION['customer_email']=$c_email;
	echo "<script>alert('Account Has Been Created Successfully')</script>";
	echo "<script>window.open('checkout.php','self')</script>";
	}
	
	}

?>
