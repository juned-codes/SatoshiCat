<?php

//login_verify.php

include('database_connection.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$error = '';
$next_action = '';

sleep(2);

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'email') {
        if ($_POST["user_email"] != '') {
            $data = array(
                ':user_email' => $_POST["user_email"]
            );

            $query = "
            SELECT * FROM register_user 
            WHERE user_email = :user_email
            ";

            $statement = $connect->prepare($query);
            $statement->execute($data);
            $total_row = $statement->rowCount();

            if ($total_row == 0) {
                $error = 'Email Address not found';
                $next_action = 'email';
            } else {
                $result = $statement->fetchAll();
                foreach ($result as $row) {
                    $_SESSION["register_user_id"] = $row["register_user_id"];
                    $_SESSION["user_name"] = $row["user_name"];
                    $_SESSION['user_email'] = $row["user_email"];
                    $_SESSION["user_password"] = $row["user_password"];
                }
                $next_action = 'password';
            }
        } else {
            $error = 'Email Address is Required';
            $next_action = 'email';
        }
    }

    if ($_POST["action"] == 'password') {
        if ($_POST["user_password"] != '') {
            // Ensure password_verify works with your password storage
            if (password_verify($_POST["user_password"], $_SESSION["user_password"])) {
                $login_otp = rand(100000, 999999);

                $data = array(
                    ':user_id' => $_SESSION["register_user_id"],
                    ':login_otp' => $login_otp,
                    ':last_activity' => date('d-m-y h:i:s')
                );

                $query = "
                INSERT INTO login_data 
                (user_id, login_otp, last_activity) 
                VALUES (:user_id, :login_otp, :last_activity)
                ";

                $statement = $connect->prepare($query);

                if ($statement->execute($data)) {
                    $_SESSION['login_id'] = $connect->lastInsertId();
                    $_SESSION['login_otp'] = $login_otp;

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';
                    require 'PHPMailer/src/POP3.php';

                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host = 'mail.satoshicat.org';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'support@satoshicat.org'; // Replace with your email
                    $mail->Password = 'jasszx123X$$$'; // Replace with your app-specific password
                    $mail->SMTPSecure = 'tls';

                    $mail->From = 'support@satoshicat.org'; // Your email
                    $mail->FromName = 'SatoshiCat';
                    $mail->AddAddress($_SESSION["user_email"]);
                    $mail->WordWrap = 50;
                    $mail->IsHTML(true);
                    $mail->Subject = 'Verification code for Login';
                    $otp_digits = str_split($login_otp);
                    $message_body = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <title>Email Verification</title>
                        <style>
                            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                            .email-container { max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; }
                            .logo { width: 100px; }
                            .otp-container { display: flex; justify-content: center; gap: 15px; margin-top: 20px; }
                            .otp-box { width: 50px; height: 50px; line-height: 50px; font-size: 24px; font-weight: bold; text-align: center; border-radius: 5px; background-color: #f4f4f4; border: 2px solid #ddd; }
                            .message { font-size: 16px; color: #555; margin-top: 10px; }
                        </style>
                    </head>
                    <body>
                        <div class='email-container'>
                            <img src='https://satoshicat.org/Auth/images/logo.png' class='logo' alt='SatoshiCat Logo'>
                            <h2>Email Verification</h2>
                            <p class='message'>Your OTP code for email verification is:</p>
                            <div class='otp-container'>
                                <div class='otp-box'>{$otp_digits[0]}</div>
                                <div class='otp-box'>{$otp_digits[1]}</div>
                                <div class='otp-box'>{$otp_digits[2]}</div>
                                <div class='otp-box'>{$otp_digits[3]}</div>
                                <div class='otp-box'>{$otp_digits[4]}</div>
                                <div class='otp-box'>{$otp_digits[5]}</div>
                            </div>
                        </div>
                    </body>
                    </html>";

                    $mail->Body = $message_body;

                    if ($mail->Send()) {
                        $next_action = 'otp';
                    } else {
                        $error = '<label class="text-danger">' . $mail->ErrorInfo . '</label>';
                        $next_action = 'password';
                    }
                }
            } else {
                $error = 'Wrong Password';
                $next_action = 'password';
            }
        } else {
            $error = 'Password is Required';
            $next_action = 'password';
        }
    }

    if ($_POST["action"] == "otp") {
        if ($_POST["user_otp"] != '') {
            if ($_SESSION['login_otp'] == $_POST["user_otp"]) {
                $_SESSION['user_id'] = $_SESSION['register_user_id'];
                unset($_SESSION["register_user_id"]);
                unset($_SESSION["user_email"]);
                unset($_SESSION["user_password"]);
                unset($_SESSION["login_otp"]);
                $next_action = ''; // Login successful
            } else {
                $error = 'Wrong OTP Number';
                $next_action = 'otp';
            }
        } else {
            $error = 'OTP Number is required';
            $next_action = 'otp';
        }
    }

    $output = array(
        'error' => $error,
        'next_action' => $next_action
    );

    echo json_encode($output);
}

?>
