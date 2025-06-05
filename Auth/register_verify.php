<?php
session_start();
include('database_connection.php');

if (isset($_GET["code"])) {
    $user_activation_code = $_GET["code"];

    if (isset($_POST["submit"])) {
        $user_otp = trim($_POST["user_otp"]);

        // Validate OTP
        $stmt = $connect->prepare("SELECT * FROM register_user WHERE user_activation_code = :activation_code AND user_otp = :user_otp");
        $stmt->execute([':activation_code' => $user_activation_code, ':user_otp' => $user_otp]);

        if ($stmt->rowCount() > 0) {
            // Update email status
            $stmt = $connect->prepare("UPDATE register_user SET user_email_status = 'verified' WHERE user_activation_code = :activation_code");
            if ($stmt->execute([':activation_code' => $user_activation_code])) {
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'title' => 'Verification Successful!',
                    'text' => 'Redirecting to login page...',
                    'redirect' => 'login.php?register=success'
                ];
            } else {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'title' => 'Verification Failed',
                    'text' => 'Something went wrong. Try again.'
                ];
            }
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'title' => 'Invalid OTP',
                'text' => 'You have entered the wrong OTP. Please check and try again.'
            ];
        }
    }
} else {
    $_SESSION['alert'] = [
        'type' => 'error',
        'title' => 'Invalid URL',
        'text' => 'Invalid verification link.'
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Registration</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="wrapper">
        <h2>Verify Registration</h2>
        <form method="post">
            <div class="input-box">
                <input type="text" name="user_otp" placeholder="Enter Your OTP" required>
            </div>
            <div class="input-box button">
                <input type="submit" name="submit" value="Verify">
            </div>
        </form>
    </div>

    <?php
    // Display SweetAlert2 notification if available
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        echo "<script>
            Swal.fire({
                icon: '{$alert['type']}',
                title: '{$alert['title']}',
                text: '{$alert['text']}'
            }).then(() => { 
                " . (isset($alert['redirect']) ? "window.location.href = '{$alert['redirect']}';" : "") . "
            });
        </script>";
        unset($_SESSION['alert']); // Clear alert after displaying
    }
    ?>

</body>
</html>
