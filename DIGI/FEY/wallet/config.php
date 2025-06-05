<?php
// Database connection
$servername = "localhost";
$username = "satoshic_juned";
$password = "jasszx123X$$$";
$dbname = "satoshic_safe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
