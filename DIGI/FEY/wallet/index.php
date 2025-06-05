<?php
// Define your API key
$apiKey = '8a75e689fe483451b9b6c345e34aefc3be245140222fa3bed49cef180b257493'; // Replace with your actual API key


// Function to make API requests
function api_request($endpoint, $params = []) {
    global $apiKey;
    $url = 'https://faucetpay.io/api/v1' . $endpoint;
    $params['api_key'] = $apiKey;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Get supported currencies
$currencies = api_request('/currencies', []);

// Initialize response variables
$response = [];
$transactions = [];

// Read transactions from the file
$transactions_file = 'transactions.txt';
if (file_exists($transactions_file)) {
    $transactions = file($transactions_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    if ($action === 'get_balance') {
        $currency = $_POST['currency'] ?? 'BTC';
        $response = api_request('/balance', ['currency' => $currency]);
    } elseif ($action === 'send_payment') {
        $to = $_POST['to'] ?? '';
        $amount = $_POST['amount'] ?? 0;
        $currency = $_POST['currency'] ?? 'BTC';
        $referral = isset($_POST['referral']) ? 1 : 0;
        $ip_address = $_POST['ip_address'] ?? '';

        $response = api_request('/send', [
            'to' => $to,
            'amount' => $amount,
            'currency' => $currency,
            'referral' => $referral,
            'ip_address' => $ip_address
        ]);

        if (isset($response['status']) && $response['status'] === 200) {
            // Payment was successful, save the payout ID and user transaction hash to file
            $payout_id = $response['payout_id'] ?? 'N/A';
            $payout_user_hash = $response['payout_user_hash'] ?? 'N/A';

            $transaction_data = "Payout ID: $payout_id, User Hash: $payout_user_hash, Currency: $currency, Amount: $amount\n";
            file_put_contents($transactions_file, $transaction_data, FILE_APPEND);

            echo "<script>Swal.fire('Success', 'Payment sent successfully!', 'success');</script>";

            // Update transactions
            $transactions = file($transactions_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        } else {
            // Payment failed
            echo "<script>Swal.fire('Error', 'Failed to send payment: " . htmlspecialchars($response['message'] ?? 'Unknown error') . "', 'error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satoshicat | Wallet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
       /* Existing styles here */
         body {
            font-family: Arial, sans-serif;
            background-color: #0d0d0d;
            color: #fff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .wallet-container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .wallet-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            color: #ccc;
            flex-wrap: wrap;
        }

        .account-info {
            display: flex;
            align-items: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .account-icon {
            margin-right: 10px;
        }

        .connection-status {
            color: green;
            font-size: 14px;
        }

        .network-info {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .network-info select {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #ffcc00;
            border-radius: 4px;
            padding: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .balance-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .balance-info h1 {
            font-size: 36px;
            margin: 0;
            color: #fff;
        }

        .wallet-address {
            color: #888;
            font-size: 14px;
        }

        .wallet-actions {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .btn {
            background-color: #F7F9F2;
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            flex: 1 1 45%;
            margin: 5px;
            text-align: center;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #e6b800;
        }
        
         .btn-connect {
        padding: 8px 16px;
        background-color: #e6b800;
        color: black;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-connect:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

      .coins-section {
    background-color: #0d0d0d;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    max-height: 300px; /* Adjust height as needed */
    overflow-y: auto; /* Enables vertical scrolling */
}

.coins-list {
    max-height: 250px; /* Adjust height to fit within the section */
    overflow-y: auto; /* Enables vertical scrolling */
    margin-top: 15px;
}

.coins-header {
    margin-bottom: 15px;
    text-align: center;
}


        .coins-tab {
            background: none;
            border: none;
            color: #fff;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            border-bottom: 2px solid #ffcc00;
        }

        
        .coin-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .coin-icon {
            font-size: 28px;
            margin-right: 15px;
        }

        .coin-details {
            font-size: 16px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .wallet-container {
                padding: 20px;
                max-width: 95%;
            }

            .balance-info h1 {
                font-size: 28px;
            }

            .btn {
                padding: 12px;
                font-size: 14px;
            }
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .modal-content input{
             
            margin: 15px 0;
            padding: 15px;
            width: 80%;
            border-radius: 4px;
            border: 1px solid #ffcc00;
            background: #1a1a1a;
            color: #fff;
        
        }
        .modal-content select,
        .modal-content button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ffcc00;
            background: #1a1a1a;
            color: #fff;
        }

        .modal-content button {
            background: #ffcc00;
            color: #000;
            cursor: pointer;
        }

        .modal-content button:hover {
            background: #e6b800;
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .modal-footer button.cancel-btn {
            background: #e6e6e6;
            color: #000;
        }

        .modal-footer button.cancel-btn:hover {
            background: #ccc;
        }
    </style>
</head>
<body>
    <div class="wallet-container">
        <div class="wallet-header">
            
           <div class="account-info">
    <button id="connect-button" class="btn-connect">Connect</button>
    <span id="connection-status" class="connection-status" style="display: none;"><b>Connected</b></span>
</div>

            
            <div class="network-info">
                <form method="POST">
                    <label for="currency-select">Select Currency:</label>
                    <select id="currency-select" name="currency">
                        <?php if (isset($currencies['currencies'])): ?>
                            <?php foreach ($currencies['currencies'] as $currency): ?>
                                <option value="<?php echo htmlspecialchars($currency); ?>" <?php echo isset($response['currency']) && $response['currency'] === $currency ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($currency); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    
                </form>
            </div>
        </div>

        <div class="balance-info">
            <h1 id="balance-amount">
    0 <!-- Default value shown before fetching the balance -->
            </h1>
            <p class="wallet-address">0x427c2....6ca9</p>
        </div>

        <div class="wallet-actions">
            <button class="btn btn-receive" type="button">Receive</button>
            <button class="btn btn-send" type="button" id="send-button">Send</button>
        </div>
        
        <!-- Modal for Receiving Payment -->
<div id="receive-modal" class="modal">
    <div class="modal-content">
        <h2>Receive Payment</h2>
        <p id="gmail-address">mohdjunedshaikh83@gmail.com</p>
        <button id="copy-button" class="btn">Copy Gmail</button>
        <div class="modal-footer">
            <button type="button" class="cancel-btn" id="close-receive-modal">Close</button>
        </div>
    </div>
</div>

        <div class="coins-section">
            <div class="coins-header">
                <button class="coins-tab" type="button">Transactions</button>
            </div>
            <div class="coins-list">
                <table>
                    <thead>
                        <tr>
                            <th>Payout ID</th>
                            <th>User Hash</th>
                            <th>Currency</th>
                            <th>Amount (satoshi)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <?php list($payout_id, $user_hash, $currency, $amount) = explode(',', $transaction); ?>
                            <tr>
                                <td><?php echo htmlspecialchars($payout_id); ?></td>
                                <td><?php echo htmlspecialchars($user_hash); ?></td>
                                <td><?php echo htmlspecialchars($currency); ?></td>
                                <td><?php echo htmlspecialchars($amount); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Sending Payment -->
    <div id="send-modal" class="modal">
        <div class="modal-content">
            <h2>Send Payment</h2>
            <form id="send-form" action="index.php" method="POST">
                <input type="hidden" name="action" value="send_payment">
                <label for="amount">Amount (in satoshi):</label>
                <input type="number" id="amount" name="amount" required>

                <label for="to">Recipient Address or Email:</label>
                <input type="text" id="to" name="to" required>

                <label for="currency">Currency:</label>
                <select id="currency" name="currency">
                    <?php if (isset($currencies['currencies'])): ?>
                        <?php foreach ($currencies['currencies'] as $currency): ?>
                            <option value="<?php echo htmlspecialchars($currency); ?>"><?php echo htmlspecialchars($currency); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label for="referral">Confirm</label>
                <input type="checkbox" id="referral" name="referral">

                <button type="submit">Send Payment</button>
                <div class="modal-footer">
                    <button type="button" class="cancel-btn" id="cancel-button">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('send-button').addEventListener('click', function() {
            document.getElementById('send-modal').style.display = 'flex';
        });

        document.getElementById('cancel-button').addEventListener('click', function() {
            document.getElementById('send-modal').style.display = 'none';
        });
    </script>
    <script>
    // Open the "Receive" modal
    document.querySelector('.btn-receive').addEventListener('click', function() {
        document.getElementById('receive-modal').style.display = 'flex';
    });

    // Close the "Receive" modal
    document.getElementById('close-receive-modal').addEventListener('click', function() {
        document.getElementById('receive-modal').style.display = 'none';
    });

    // Copy Gmail address functionality
    document.getElementById('copy-button').addEventListener('click', function() {
        const gmailText = document.getElementById('gmail-address').textContent;
        navigator.clipboard.writeText(gmailText).then(function() {
            Swal.fire('Copied!', 'Gmail address copied to clipboard', 'success');
        }, function(err) {
            Swal.fire('Error', 'Failed to copy the Gmail address', 'error');
        });
    });
</script>

<script>
    document.getElementById('currency-select').addEventListener('change', function () {
        const currency = this.value;

        // Make an AJAX request to fetch the balance
        fetch('fetch_balance.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `currency=${currency}`
        })
        .then(response => response.json())
        .then(data => {
            const balanceElement = document.getElementById('balance-amount');
            if (data.status === 200) {
                // Update the balance dynamically
                balanceElement.textContent = `${new Intl.NumberFormat().format(data.balance)} ${data.currency}`;
            } else {
                // Handle errors gracefully
                balanceElement.textContent = 'Failed to fetch balance';
                Swal.fire('Error', data.message || 'Failed to fetch balance', 'error');
            }
        })
        .catch(error => {
            console.error('Error fetching balance:', error);
            Swal.fire('Error', 'Failed to fetch balance', 'error');
        });
    });
</script>

<script>
    // Check connection status on page load
    window.addEventListener('DOMContentLoaded', function () {
        const connectButton = document.getElementById('connect-button');
        const connectionStatus = document.getElementById('connection-status');

        // Check if user is already connected
        const isConnected = localStorage.getItem('isConnected');
        if (isConnected === 'true') {
            // If connected, hide the button and show the "Connected" text
            connectButton.style.display = 'none';
            connectionStatus.style.display = 'inline';
        }

        // Add click event to the "Connect" button
        connectButton.addEventListener('click', function () {
            // Disable the button and show "Connecting..." text
            connectButton.disabled = true;
            connectButton.textContent = 'Connecting...';

            // Simulate a 2-second connection process
            setTimeout(() => {
                // Mark user as connected
                localStorage.setItem('isConnected', 'true');

                // Hide the button and show "Connected" text
                connectButton.style.display = 'none';
                connectionStatus.style.display = 'inline';

                // Re-enable the button after 30 minutes (optional cleanup if needed)
                setTimeout(() => {
                    localStorage.removeItem('isConnected');
                }, 30 * 60 * 1000); // 30 minutes in milliseconds
            }, 2000);
        });
    });
</script>


</body>
</html>
