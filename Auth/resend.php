<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include('database_connection.php');

$message = '';
session_start();

if (isset($_SESSION["user_id"])) {
    header("location:home.php");
}

if (isset($_POST["resend"])) {
    if (empty($_POST["user_email"])) {
        $message = '<div class="alert alert-danger">Email Address is required</div>';
    } else {
        $user_email = trim($_POST["user_email"]);

        $query = "SELECT * FROM register_user WHERE user_email = :user_email";
        $statement = $connect->prepare($query);
        $statement->execute([':user_email' => $user_email]);

        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll();
            foreach ($result as $row) {
                if ($row["user_email_status"] == 'verified') {
                    $message = '<div class="alert alert-info">Email Address already verified, you can log in</div>';
                } else {
                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';

                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'mail.satoshicat.org';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'support@satoshicat.org';  // Set your SMTP username
                        $mail->Password = 'jasszx123X$$$';           // Set your SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('support@satoshicat.org', 'SatoshiCat');
                        $mail->addAddress($row["user_email"]); // Fix here

                        $mail->isHTML(true);
                        $mail->Subject = 'Verification Code - SatoshiCat';
                        $mail->Body = '
                            <p>Enter this verification code when prompted: <b>' . $row["user_otp"] . '</b>.</p>
                            <p>Sincerely,</p>
                            <p>SatoshiCat Team</p>
                        ';

                        if ($mail->send()) {
                            echo '<script>alert("Please check your email for the verification code.")</script>';
                            echo '<script>window.location.replace("register_verify.php?code=' . $row["user_activation_code"] . '");</script>';
                        } else {
                            $message = '<div class="alert alert-danger">Mail could not be sent. Error: ' . $mail->ErrorInfo . '</div>';
                        }
                    } catch (Exception $e) {
                        $message = '<div class="alert alert-danger">Mailer Error: ' . $mail->ErrorInfo . '</div>';
                    }
                }
            }
        } else {
            $message = '<div class="alert alert-danger">Email Address not found in our record</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatoshiCat | Resend</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .navbar { background-color: #000; }
    .navbar-brand { color: #f1c40f; font-weight: bold; }
    .navbar-nav .nav-link { color: #fff; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="https://satoshicat.org">SatoshiCat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="https://satoshicat.org/#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="https://satoshicat.org/#importance">Why Us?</a></li>
                <li class="nav-item"><a class="nav-link" href="https://satoshicat.org/#about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="https://satoshicat.org/#contact">Contact</a></li>
                <li class="nav-item">
                    <a class="btn btn-outline-light mx-2" href="https://satoshicat.org/Auth/login.php">Login</a>
                </li>
                <br>
                <li class="nav-item">
                    <a class="btn btn-warning mx-2" href="https://satoshicat.org/Auth/index.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>    

    <div class="wrapper">
        <h2>Resend Email</h2>
        <?php echo $message; ?>
        <form method="post">
            <div class="input-box">
                <input type="email" placeholder="Enter your Email" name="user_email">
            </div>
            <div class="input-box button">
                <input type="Submit" name="resend" value="Send">
            </div>
        </form>
    </div>
</body>
</html>
