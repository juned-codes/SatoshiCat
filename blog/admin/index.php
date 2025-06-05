<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>
        setTimeout(() => {
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'You must log in first!'
            }).then(() => {
                window.location.href = 'login.php';
            });
        }, 100);
    </script>";
    exit();
}
include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 2000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            background: #FFD700;
            color: #fff;
            border-radius: 5px;
            margin: 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .blog-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 5px solid #FFD700;
        }
        .admin-actions {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="add-blog.php" class="btn">Add New Blog</a>
        
        <?php
        $stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
        $blogs = $stmt->fetchAll();
        ?>
        
        <?php foreach ($blogs as $blog): ?>
            <div class="blog-card">
                <h3><?= htmlspecialchars($blog['title']) ?></h3>
                <p><?= htmlspecialchars(substr($blog['content'], 0, 100)) ?>...</p>
                <div class="admin-actions">
                    <a href="edit-blog.php?id=<?= $blog['id'] ?>" class="btn">Edit</a>
                    <a href="#" class="btn delete-btn" onclick="confirmDelete(<?= $blog['id'] ?>)">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete-blog.php?id=${id}`;
                }
            });
        }
    </script>
</body>
</html>
