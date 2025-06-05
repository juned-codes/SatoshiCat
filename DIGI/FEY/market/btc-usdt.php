
<html lang="en">
    <head><meta charset="windows-1252">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        
        <title><?= $settings['name'];?></title>
        
        <link rel="canonical" href="<?= $settings['domain'];?>">
    	<?= ( $_GET['r'] || $_GET['theme'])? '<meta name="robots" content="noindex,nofollow">' : ''; ?>
    	
    	<!-- Favicon -->
        <link rel="icon" href="https://gr8.cc/assets/coins/<?= strtolower($settings['currency']);?>.webp">
        <!-- Bootswatch Themes -->
        <link rel="stylesheet" href="<?= (($settings['theme']) && $settings['theme'] != 'default')? 'https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/'.$settings['theme'].'/bootstrap.min.css': 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css';?>">
        <!-- Font Awesome -->
    		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <!-- Base CSS -->
        <link rel="stylesheet" href="libs/css/base.css">
        <style><?= $settings['css'];?></style>

     


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 <style>
        /* Ensure the widget container takes full height and width */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .tradingview-widget-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100vh; /* Full viewport height */
        }

        .tradingview-widget-container__widget {
            flex: 1; /* Takes up remaining space */
            width: 100%;
        }

        .tradingview-widget-copyright {
            text-align: center;
            padding: 8px;
            background-color: rgba(0, 0, 0, 0.8); /* Semi-transparent background for readability */
            color: white;
            font-size: 12px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .tradingview-widget-copyright {
                font-size: 10px; /* Smaller font size for smaller screens */
                padding: 6px; /* Reduced padding for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .tradingview-widget-copyright {
                font-size: 8px; /* Further reduced font size for very small screens */
                padding: 4px; /* Further reduced padding for very small screens */
            }
        }
         /* Full width back button */
        .back-button-container {
            width: 100%;
            padding: 10px;
            background-color: #f8f9fa; /* Light background */
            text-align: center;
            color:#060606;
        }

        .back-button-container button {
            width: 100%;
            max-width: 100%;
            font-size: 18px;
            padding: 10px;
            
        }

        /* Full width back button on smaller screens */
        @media (max-width: 768px) {
            .back-button-container button {
                font-size: 16px;
            }
        }
    </style>




    </head>

    <!-- START BODY -->
    <body class="d-flex flex-column">

    <!-- Full-Length Back Button -->
    <div class="back-button-container">
        <button class="btn btn-dark btn-block" onclick="window.history.back();">Go Back</button>
    </div>

        <!--CoinGecko Maquee API -->
        <script src="https://widgets.coingecko.com/gecko-coin-price-marquee-widget.js"></script>
<gecko-coin-price-marquee-widget locale="en" dark-mode="false" outlined="true" coin-ids="polygon-ecosystem-token,matic-network,dogs-2,bitcoin,solana,zcash,binancecoin,arbitrum" initial-currency="usd"></gecko-coin-price-marquee-widget>
        <!--End API -->

        <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <div class="tradingview-widget-copyright">
            <a href="https://www.satoshicat.org/" rel="noopener nofollow" target="_blank">
                <span class="blue-text">SatoshiCat</span>
            </a>
        </div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
        {
        "autosize": true,
        "symbol": "BINANCE:BTCUSDT",
        "interval": "D",
        "timezone": "Etc/UTC",
        "theme": "dark",
        "style": "1",
        "locale": "en",
        "allow_symbol_change": true,
        "calendar": false,
        "support_host": "https://www.tradingview.com"
        }
        </script>
    </div>
    <!-- TradingView Widget END -->

        <!-- Footer -->
        <footer class="py-3">
            <div class="container text-center">
                <div class="col-12 col-md-6 col-lg-7 float-md-left">
                    <div class="text-center text-md-left">
                        Copyright&copy; <?= date('Y');?> <a href="<?= $settings['domain'];?>"><?= $settings['name'];?></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 float-md-right">
                    <div class="text-center text-md-right">
                        Powered by <a href=""><b>DIGI</b> Community</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JQUERY -->
    	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    	<!-- BOOTSTRAP -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <!-- AntiBot -->
        <?php if($_SESSION[$faucetID]['status'] == 'login'){ $antibotlinks->get_js($antibotClass); } ?>

        <!-- Start Adblock check -->
        <script>
            var show_ads_gr8_lite = false;
        </script>
        <script type="text/javascript" src="libs/show_ads.js"></script>

        <!-- Misc JS -->
        <script type="text/javascript" charset="utf-8">

            // Check Adblocker
            if(!show_ads_gr8_lite) {
            	$('div.flex-grow').html('<div class="row m-2"><div class="col-12 alert alert-danger py-5 text-center"><h1 class="display-4 font-weight-bold">Please disable your AdBlocker</h1><p class="lead">Advertisements help fund <?= $settings['name'];?>, so we can reward users like you!</p></div></div>');
            }

            // Disable Enter
            $(function() {
                $("form").keypress(function(e) {
                    if (e.which == 13) {
                        return false;
                    }
                });
            });

        	// Switch Captchas
        	$('#switch').on('click', function() {
        		var captcha = $('#captcha').val();
        		var captchas = ['solvemedia','recaptcha'];
                if (captcha == captchas[0]) {
                    $('#'+captchas[0]).addClass('d-none');
                    $('#'+captchas[1]).removeClass('d-none');
                    $('#captcha').val('recaptcha');
                    $('#switch').text('Switch to SolveMedia');
                }
                else {
                    $('#'+captchas[1]).addClass('d-none');
                    $('#'+captchas[0]).removeClass('d-none');
                    $('#captcha').val('solvemedia');
                    $('#switch').text('Switch to reCaptcha');
                }
            });


            console.log('%cScript: GR8 Faucet Script Lite v<?= $settings['version'];?>','font: 1.5em roboto; color: #5bc0de;');
            console.log('%cFunctions: v<?= $fv;?>','font: 1.5em roboto; color: #5bc0de;');
            console.log('%cCore: v<?= $cv;?>','font: 1.5em roboto; color: #5bc0de;');
            console.log('%cDownload this script at https://gr8.cc','font: 1.5em roboto; color: #5bc0de;');
            console.log('%cThanks for using GR8 Faucet Script Lite! ðŸ˜Š','font: 2em roboto; color: #5bc0de;');
        </script>

    </body>
</html>
