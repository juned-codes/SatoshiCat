<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

// Fetch the blog to edit
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $video_url = $_POST['video_url'];

        $stmt = $pdo->prepare("UPDATE blogs SET title = ?, content = ?, video_url = ? WHERE id = ?");
        $stmt->execute([$title, $content, $video_url, $id]);
        
        // Return JSON response for AJAX
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'message' => 'Blog updated successfully!'
        ]);
        exit();
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Error updating blog: ' . $e->getMessage()
        ]);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-color: #FFD700;
            --dark-color: #1a1a1a;
            --light-color: #ffffff;
            --secondary-color: #2c2c2e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--dark-color);
            color: var(--light-color);
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        .admin-form {
            background-color: var(--secondary-color);
            padding: 30px;
            border-radius: 10px;
            border: 2px solid var(--primary-color);
        }

        .admin-form h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .admin-form input,
        .admin-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background-color: #333;
            border: 1px solid var(--primary-color);
            color: var(--light-color);
            border-radius: 5px;
            font-size: 16px;
        }

        .admin-form textarea {
            height: 200px;
            resize: vertical;
        }

        .btn {
            background-color: var(--primary-color);
            color: #000;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 16px;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 10px;
            }
            
            .admin-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="admin-form" id="editForm" method="POST">
            <h2>Edit Blog</h2>
            <input type="text" name="title" placeholder="Blog Title" value="<?= htmlspecialchars($blog['title']) ?>" required>
            <textarea name="content" placeholder="Blog Content" required><?= htmlspecialchars($blog['content']) ?></textarea>
            <input type="text" name="video_url" placeholder="YouTube Video URL" value="<?= htmlspecialchars($blog['video_url']) ?>">
            <button type="submit" class="btn">Update Blog</button>
        </form>
    </div>

    <script>
    // Handle form submission
    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        
        try {
            const response = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();

            if (result.status === 'success') {
                await Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: result.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                window.location.href = 'index.php'; // Redirect to admin panel
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: result.message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An unexpected error occurred'
            });
        }
    });
    </script>
</body>
</html>