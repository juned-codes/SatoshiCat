<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Get the blog ID from the URL
$id = $_GET['id'];

// Delete the blog from the database
$stmt = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
$stmt->execute([$id]);

// Delete associated comments (optional)
$stmt = $pdo->prepare("DELETE FROM comments WHERE blog_id = ?");
$stmt->execute([$id]);

// Redirect back to the admin dashboard
header("Location: index.php");
exit();
?>