<?php include 'tracker.php'; ?>

<?php

session_start();

if(isset($_SESSION["user_id"]))
{
header("Location:https://satoshicat.org/DIGI/FEY/index.php");
}

?>



<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SatoshiCat | Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .navbar {
            background-color: #000;
            
        }
        .navbar-brand {
            color: #f1c40f;
            font-weight: bold;
            
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
    </style>
   </head>
<body>
<?php
			if(isset($_GET["register"]))
			{
				if($_GET["register"] == 'success')
				{
					echo '<script>alert("Registerd Successfully!")</script>';
				}
			}
			?>
			
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
                <a class="btn btn-warning mx-2" href="https://satoshicat.org/Auth/index.php">Register</a>
            </li>
           
           
            </ul>
        </div>
    </nav> 

  <div class="wrapper">
    <h2>Login</h2>
    <form method="POST" id="login_form">
      <div class="input-box" id="email_area">
        <input type="text" placeholder="Enter your email" name="user_email" id="user_email">
        <span id="user_email_error" class="text-danger"></span>
      </div>
      <div class="input-box" id="password_area" style="display:none;">
        <input type="password" placeholder="Enter your password" name="user_password" id="user_password">
        <span id="user_password_error" class="text-danger"></span>
      </div>
      <div class="input-box" id="otp_area" style="display:none;">
        <input type="text" placeholder="Enter your OTP" name="user_otp" id="user_otp">
        <span id="user_otp_error" class="text-danger"></span>
      </div>
      
    
      <div class="input-box button">
        
        <input type="hidden" name="action" id="action" value="email" />
	    <input type="submit" name="next" id="next" value="Next" />
      </div>
	  <div class="text">
        <h3>Remember Your Password? <a href="https://satoshicat.org/Auth/forget.php?step1">Forget Password</a></h>
      </div>

    </form>
  </div>
	


  <script>

$(document).ready(function(){
	$('#login_form').on('submit', function(event){
		event.preventDefault();
		var action = $('#action').val();
		$.ajax({
			url:"login_verify.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			beforeSend:function()
			{
				$('#next').attr('disabled', 'disabled');
			},
			success:function(data)
			{
				$('#next').attr('disabled', false);
				if(action == 'email')
				{
					if(data.error != '')
					{
						$('#user_email_error').text(data.error);
						
					}
					else
					{
						$('#user_email_error').text('');
						$('#email_area').css('display', 'none');
						$('#password_area').css('display', 'block');
					}
				}
				else if(action == 'password')
				{
					if(data.error != '')
					{
						$('#user_password_error').text(data.error);
					}
					else
					{
						$('#user_password_error').text('');
						$('#password_area').css('display', 'none');
						$('#otp_area').css('display', 'block');
					}
				}
				else
				{
					if(data.error != '')
					{
						$('#user_otp_error').text(data.error);
					}
					else
					{
						window.location.replace("https://satoshicat.org/DIGI/FEY/index.php");
					}
				}

				$('#action').val(data.next_action);
			}
		})
	});
});

</script>


</body>
</html>

