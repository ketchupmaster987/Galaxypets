<!DOCTYPE html>

<html>

<head>
<title>Galaxy Pets</title>
</head>

<body>

<?php
$servername = "sql210.epizy.com";
$username = "epiz_23154020";
$password = "";
$dbName = "epiz_23154020_galaxyPets";

// Create connection
$link = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

?>

</body>
</html>