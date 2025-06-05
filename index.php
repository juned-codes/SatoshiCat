<?php include 'tracker.php'; ?>
<?php
session_start(); // Start the session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$status = ""; // Variable to hold the message status

// Check if the user has already submitted the form in this session
if (isset($_SESSION['email_sent']) && $_SESSION['email_sent'] === true) {
    $status = "already_sent"; // Indicate the message was already sent
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0; // Disable verbose debug output
            $mail->isSMTP();
            $mail->Host       = 'mail.satoshicat.org';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@satoshicat.org'; // Your Gmail address
            $mail->Password   = 'jasszx123X$$$'; // App-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('support@satoshicat.org', 'SatoshiCat');
            $mail->addAddress('juned92727@gmail.com', 'Admin'); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Message';
            $mail->Body    = "Name: $name <br>Email: $email <br>Message: $message";
            $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

            $mail->send();
            $_SESSION['email_sent'] = true; // Set session flag to indicate email was sent
            $status = "success"; // Message has been sent
        } catch (Exception $e) {
            $status = "error"; // Message could not be sent
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatoshiCat | Wallet & Crypto Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        /* Global styles */
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #1c1c1e;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #f8f9fa;
        }

        p {
            color: #ccc;
        }

        /* Navbar styles */
        .navbar {
            background-color: #000;
        }

        .navbar-brand {
            color: #f1c40f;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

         /* Carousel styles */
    .carousel-item {
        height: 60vh;
        min-height: 300px;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .carousel-item {
            height: 50vh;
        }
        .carousel-caption h3 {
            font-size: 1.2rem;
        }
        .carousel-caption p {
            font-size: 0.9rem;
        }
    }

        /* Services section */
        .service-card {
            background-color: #2c2c2e;
            border: none;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .service-card h5 {
            color: #f1c40f;
        }

        /* Importance section */
        .importance-section {
            padding: 60px 20px;
            background-color: #000;
            text-align: center;
        }

        .importance-section h2 {
            color: #f1c40f;
            margin-bottom: 30px;
        }

        /* About and Contact Us styles */
        .card {
            background-color: #2c2c2e;
            border: none;
            color: #fff;
        }

        .card h5 {
            color: #f1c40f;
        }

        .bullet-points {
            list-style-type: disc;
            margin-left: 20px;
        }

        /* Contact form */
        .contact-card input, .contact-card textarea {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .contact-card input::placeholder, .contact-card textarea::placeholder {
            color: #bbb;
        }

        /* Footer styles */
        .footer {
            background-color: #000;
            color: #aaa;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #f1c40f;
        }

        .success-message {
            background-color: #50fa7b;
            color: #000;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
            display: none; /* Hide by default */
        }

        .error-message {
            background-color: #ff5555;
            color: #000;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
            display: none; /* Hide by default */
        }

        /* Trusted Partners Section */
        .trusted-partners {
            background-color: #000;
            padding: 40px 0;
            text-align: center;
        }

        .trusted-partners img {
            width: 130px;
            margin: 10px 20px;
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }

        .trusted-partners img:hover {
            filter: grayscale(0%);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="homeimg/logo.png" alt="SatoshiCat Logo"> SatoshiCat
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#importance">Why Us?</a></li>
                <li class="nav-item"><a class="nav-link" href="https://satoshicat.org/blog/">Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item">
                    <a class="btn btn-outline-light mx-2" href="https://satoshicat.org/Auth/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-warning mx-2" href="https://satoshicat.org/Auth/index.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>

     <!-- Carousel -->
    <div id="cryptoCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1: Secure Crypto Transactions -->
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1622630998477-20aa696ecb05?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                     alt="Crypto Security" 
                     class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Secure Crypto Transactions</h3>
                    <p>Military-grade encryption for all your transactions</p>
                </div>
            </div>
           
            <!-- Slide 4: Crypto Mining -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                     alt="Crypto Faucet" 
                     class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Start Crypto Faucet</h3>
                    <p>Earn crypto Faucet with our easy-to-use tools</p>
                </div>
            </div>
            <!-- Slide 5: Market Analysis -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1639754390580-2e7437267698?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                     alt="Market Analysis" 
                     class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Advanced Market Analysis</h3>
                    <p>Get real-time insights and trends in the crypto market</p>
                </div>
            </div>
            <!-- Slide 6: Beginner-Friendly Tools -->
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" 
                     alt="Beginner-Friendly Tools" 
                     class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Beginner-Friendly Tools</h3>
                    <p>Learn and grow with our easy-to-use crypto tools</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#cryptoCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#cryptoCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Services Section -->
    <section id="services" class="container my-5">
        <div class="text-center mb-5">
            <h2>Our Services</h2>
            <p>Explore our range of services to get started in the world of cryptocurrency.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-wallet fa-3x my-3"></i>
                    <h5>Wallet Transfers</h5>
                    <p>Secure and fast crypto wallet transfers with ease.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-chart-line fa-3x my-3"></i>
                    <h5>Market Analysis</h5>
                    <p>Get the latest insights and trends in the crypto market.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-faucet fa-3x my-3"></i>
                    <h5>Crypto Faucet</h5>
                    <p>Start small and learn with our beginner-friendly crypto faucet.</p>
                </div>
            </div>
            <!-- New Services -->
            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-exchange-alt fa-3x my-3"></i>
                    <h5>Crypto Swap</h5>
                    <p>Swap your cryptocurrencies instantly with low fees.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-book fa-3x my-3"></i>
                    <h5>Blog for Beginners</h5>
                    <p>Learn the basics of cryptocurrency with our beginner-friendly blog.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="service-card card text-center">
                    <i class="fas fa-shield-alt fa-3x my-3"></i>
                    <h5>Security to Ecosystem</h5>
                    <p>Ensure the safety and integrity of your crypto ecosystem.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Partners Section -->
    <section class="trusted-partners">
        <div class="container">
            <h2>Trusted Providers</h2>
            <div class="d-flex justify-content-center flex-wrap">
                <img src="homeimg/Bitcoiner.png" alt="Bitcoin">
                <img src="homeimg/faucetpay1.png" alt="FaucetPay">
                <img src="homeimg/coingecko.png" alt="CoinGecko">
                <img src="homeimg/coinmarket.png" alt="CoinMarketCap">
                <img src="homeimg/feyorra.png" alt="Feyorra">
                <img src="homeimg/ads.png" alt="A-Ads">
                
            </div>
        </div>
    </section>

    <!-- Importance Section -->
    <section id="importance" class="importance-section">
        <div class="container">
            <h2>Why Are These Services Important?</h2>
            <p>For beginners in cryptocurrency, understanding the basics is crucial. Wallet transfers help users manage their funds securely, while market analysis gives insights to make informed decisions. A faucet allows users to get hands-on experience without significant risk.</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about-us" class="container my-5">
        <div class="card p-4">
            <h5 class="text-center">About Us</h5>
            <ul class="bullet-points">
                <li>We aim to provide user-friendly tools to make cryptocurrency accessible to everyone.</li>
                <li>Our platform focuses on secure wallet transfers, market insights, and learning tools.</li>
                <li>SatoshiCat is perfect for beginners, allowing them to explore and grow in the crypto world.</li>
            </ul>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="container my-5">
        <div class="card p-4 contact-card">
            <h5 class="text-center">Contact Us</h5>
            <form id="contact-form" action="" method="POST" onsubmit="disableSubmitButton()">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button id="submitBtn" type="submit" class="btn btn-warning btn-block">Send Message</button>
            </form>

            <!-- Success message -->
            <div class="success-message" id="successMessage">
                Message has been sent successfully!
            </div>

            <!-- Error message -->
            <div class="error-message" id="errorMessage">
                Message could not be sent. Please try again later.
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 SatoshiCat. All Rights Reserved. | <a href="#">Privacy Policy</a></p>
    </footer>

  <script>
    var status = "<?php echo $status; ?>";

    var hasReloaded = false; // Track if the page has already reloaded

    if (status === "success") {
        document.getElementById('successMessage').style.display = 'block';
        setTimeout(function() {
            if (!hasReloaded) {
                hasReloaded = true;
                window.location.href = "#contact"; // Navigate to contact section after 5 seconds
            }
        }, 5000); // Delay for 5 seconds before refreshing
    } else if (status === "error") {
        document.getElementById('errorMessage').style.display = 'block';
        setTimeout(function() {
            if (!hasReloaded) {
                hasReloaded = true;
                window.location.reload(); // Reload the page after 5 seconds
            }
        }, 5000); // Delay for 5 seconds before refreshing
    } else if (status === "already_sent") {
        document.getElementById('successMessage').innerHTML = "Message has already been sent.";
        document.getElementById('successMessage').style.display = 'block';
    }

    // Function to disable submit button after form submission
    function disableSubmitButton() {
        document.getElementById('submitBtn').disabled = true; // Disable the button
    }
</script>

            
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
