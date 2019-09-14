<html>
<head>

</head>
<body>
<div>
<form method="post"  action="">
<table width ="800" align="center"  >
<tr align="center">
<td colspan="4"><h2 style="font-size:20px;  ">Login Or Register To  Buy!</h2></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr >
<td align="right"><b>Email:</b></td> 
<td><input type="text" name ="email" placeholder="Enter Email"/><br></td>
<br></tr>
<tr>
<td><br></td>
</tr>
<tr >
<td align="right">Password:</td>
<td><input type="password" name ="password" placeholder="password"/><br></td>
</tr>
<tr >
<td colspan="3"><a href="checkout.php?forgot_pass">Forgot Password</a></td>
</tr>
<tr align="center">
<td colspan="4"><input type="submit" name ="login" value="login"/></td>
</tr>
</table>
<h2 style ="float:right;padding:15px;"><a href="customer_register.php" style="text-decoration:none;">Register Here</a></h2>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['login']))
{
include("admin/include/db.php");
$con=mysqli_connect("localhost","root","","ecommerce");

$email=$_POST['email'];
$pass=$_POST['password'];

$select="select * from customers where customer_email='$email' AND customer_pass='$pass'";
$run=mysqli_query($con,$select);

$check=mysqli_num_rows($run);

if($check==0)
{
echo "<script>alert('EMAIL AND PASSWORD NOT MATCH TRY AGAIN!!')</script>";
echo "<script>window.open('checkout.php','_self')</script>";
}
else
{
$_SESSION['customer_email']=$email;
echo "<script>alert('Login Successfully')</script>";

echo "<script>window.open('index.php','_self')</script>";
}


}
?>
