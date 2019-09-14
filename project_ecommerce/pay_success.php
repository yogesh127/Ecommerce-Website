<?php
session_start()
?>
<head>
</head>
<body>
<h2>Welcome <?php echo $_SESSION['customer_email'];?></h2>
<h3>Your Payment Was Successful ,Go to Your Account</h3>
<h3><a href="index.php">GO BACK </a>
</body>
</html>
