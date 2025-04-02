<!DOCTYPE html>

<html>

<head>
<title>Galaxy Pets</title>
</head>

<body>

<?php
$servername = "jsk3f4rbvp8ayd7w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "umkb1af2onvvapku";
$password = "hzmx4zf1gcdokm27";
$dbName = "adlh9xv255m2sxnj";
// Create connection
$link = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

?>

</body>
</html>
