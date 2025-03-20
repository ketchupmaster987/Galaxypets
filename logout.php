<?php 
session_start();
?>
<!DOCTYPE html>

<html>

<head>
<title> </title>
<link href="icon.jpg" type = "image/jpg">
<link rel="stylesheet" type= "text/css" href="../Assets/css/style.css">

</head>

<body>

	<?php
		// Initialize the session
		session_start();
		 
		// Unset all of the session variables
		$_SESSION = array();
		// Destroy the session.
		session_destroy();

        session_start();
        $isLoggedIn = false;

        echo "<script>alert('Logged out successfully')</script>";
		// Redirect to login page
		header("location: index.php");
		exit;
	?>
</div>

</body>
</html>