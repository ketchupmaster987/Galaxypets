<!DOCTYPE html>

<html>

<head>
<title>Galaxy Pets</title>
</head>

<body>

<?php
$servername = "127.0.0.1";
$username = "ketchupmaster987";
$password = "";
$dbName = "galaxyPets";
// Create connection
$link = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

?>

</body>
</html>