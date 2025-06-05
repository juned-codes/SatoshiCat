<?php
session_start();
include '../includes/db.php';

if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && $password === $admin['password']) {
        $_SESSION['admin'] = true;
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Redirecting...',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Credentials',
                text: 'Please try again!'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SatoshiCat Blog</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #2c2c2e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .container h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #333;
        }

        .admin-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .admin-form button {
            width: 100%;
            padding: 10px;
            background-color: #FFD700;
            border: none;
            color: black;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .admin-form button:hover {
            background-color: #ffcc00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>SatoshiCat Blog - Admin Login</h2>
        <form class="admin-form" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>