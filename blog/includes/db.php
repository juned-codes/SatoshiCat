<?php
$host = 'localhost';
$dbname = 'satoshic_safe';
$user = 'satoshic_juned';
$pass = 'jasszx123X$$$';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>