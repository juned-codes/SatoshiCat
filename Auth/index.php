<?php include 'tracker.php'; ?>
<?php
session_start();
include('database_connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$message = '';

if (isset($_POST["submit"])) {
    $user_name = trim($_POST["user_name"]);
    $user_email = trim($_POST["user_email"]);
    $user_password = password_hash(trim($_POST["user_password"]), PASSWORD_DEFAULT);
    $user_activation_code = md5(rand());
    $user_otp = rand(100000, 999999);

    // Convert OTP to string to access each digit
    $user_otp_str = strval($user_otp);

    // Check if email already exists
    $stmt = $connect->prepare("SELECT * FROM register_user WHERE user_email = :user_email");
    $stmt->execute([':user_email' => $user_email]);

    if ($stmt->rowCount() > 0) {
        $message = '<p class="error">Email Already Registered</p>';
    } else {
        // Insert user into database
        $insertQuery = "INSERT INTO register_user (user_name, user_email, user_password, user_activation_code, user_otp) 
                        VALUES (:user_name, :user_email, :user_password, :user_activation_code, :user_otp)";
        $stmt = $connect->prepare($insertQuery);

        $result = $stmt->execute([
            ':user_name' => $user_name,
            ':user_email' => $user_email,
            ':user_password' => $user_password,
            ':user_activation_code' => $user_activation_code,
            ':user_otp' => $user_otp
        ]);

        if ($result) {
            // Send OTP Email
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'mail.satoshicat.org';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'support@satoshicat.org';
            $mail->Password = 'jasszx123X$$$';  // Consider storing this securely
            $mail->SMTPSecure = 'tls';

            $mail->From = 'support@satoshicat.org';
            $mail->FromName = 'SatoshiCat';
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email (SatoshiCat)';

            // Email Template
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Email Verification</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 20px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                        text-align: center;
                        justify-content:center;
                        align-items:center;
                    }
                    .logo {
                        width: 100px;
                        margin: 0 auto;
                    }
                    .otp-container {
                        display: flex;
                        justify-content: center;
                        gap: 15px;
                        margin-top: 20px;
                    }
                    .otp-box {
                        width: 50px;
                        height: 50px;
                        line-height: 50px;
                        font-size: 24px;
                        font-weight: bold;
                        text-align: center;
                        border-radius: 5px;
                        background-color: #f4f4f4;
                        border: 2px solid #ddd;
                    }
                    .message {
                        font-size: 16px;
                        color: #555;
                        margin-top: 10px;
                    }
                    .verify-btn {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 10px 20px;
                        font-size: 16px;
                        color: #fff;
                        background-color: #007BFF;
                        text-decoration: none;
                        border-radius: 5px;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <img src="https://satoshicat.org/Auth/images/logo.png" class="logo" alt="SatoshiCat Logo">
                    <h2>Email Verification</h2>
                    <p class="message">Your OTP code for email verification is:</p>
                    <div class="otp-container">
                        <div class="otp-box">' . $user_otp_str[0] . '</div>
                        <div class="otp-box">' . $user_otp_str[1] . '</div>
                        <div class="otp-box">' . $user_otp_str[2] . '</div>
                        <div class="otp-box">' . $user_otp_str[3] . '</div>
                        <div class="otp-box">' . $user_otp_str[4] . '</div>
                        <div class="otp-box">' . $user_otp_str[5] . '</div>
                    </div>
                    <a href="https://satoshicat.org/Auth/register_verify.php?code=' . $user_activation_code . '" class="verify-btn">Verify Email</a>
                </div>
            </body>
            </html>';

            if ($mail->send()) {
                header("Location: register_verify.php?code=$user_activation_code");
                exit();
            } else {
                $message = '<p class="error">Email Sending Failed: ' . $mail->ErrorInfo . '</p>';
            }
        } else {
            $message = '<p class="error">Registration Failed. Please try again.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

</head>
<body>
    <div class="wrapper">
        <h2>Register</h2>
        <?php echo $message; ?>
        <form method="post">
            <div class="input-box">
                <input type="text" name="user_name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-box">
                <input type="email" name="user_email" placeholder="Enter Your Email" required>
            </div>
            <div class="input-box">
                <input type="password" name="user_password" placeholder="Enter Your Password" required>
            </div>
            <div class="input-box button">
                <input type="submit" name="submit" value="Register">
            </div>
            <div class="text">
                <h3>Didn't receive OTP? <a href="resend.php">Resend OTP</a></h3>
            </div>
        </form>
    </div>
</body>
</html>
