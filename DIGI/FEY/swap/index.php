<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatoshiCat | Swap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@5.7.0/dist/ethers.umd.min.js"></script>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d0d;
            color: #fff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Positioning buttons */
        #connect-btn, #disconnect-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #ffcc00;
            color: #000;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        #connect-btn:hover, #disconnect-btn:hover {
            background-color: #e6b800;
        }

        #disconnect-btn {
            display: none;
            margin-top: 5px; /* 5px below the connect button */
        }

        .swap-container {
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .swap-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .swap-header h1 {
            font-size: 28px;
            color: #ffcc00;
        }

        .swap-form {
            display: flex;
            flex-direction: column;
        }

        .swap-input {
            background: #1a1a1a;
            color: #fff;
            border: 1px solid #ffcc00;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .swap-input select,
        .swap-input input {
            width: 100%;
            background: none;
            border: none;
            outline: none;
            color: #fff;
        }

        .swap-button {
            background-color: #ffcc00;
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
        }

        .swap-button:hover {
            background-color: #e6b800;
        }

        .swap-rate {
            text-align: center;
            font-size: 14px;
            color: #ccc;
            margin-top: 10px;
        }

        .loading-btn {
            background-color: #e6e6e6;
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            display: none;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .swap-container {
                padding: 20px;
            }

            .swap-header h1 {
                font-size: 24px;
            }

            .swap-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <button id="connect-btn">Connect</button>
    <button id="disconnect-btn">Disconnect</button>

    <div class="swap-container">
        <div class="swap-header">
            <h1>Crypto Swap</h1>
            <p>Swap your favorite cryptocurrencies instantly</p>
        </div>
        <form class="swap-form" id="swap-form">
            <div class="swap-input">
                <label for="from-coin">From:</label>
                <select name="from_coin" id="from-coin" required>
                      <option value="ethereum">Ethereum (ETH Sepolia)</option>
    <option value="base">Base Sepolia</option>
    <option value="optimism">Optimism</option>
    <option value="arbitrum">Arbitrum Sepolia</option>
   
                </select>
            </div>
            <div class="swap-input">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" placeholder="Enter amount to swap" required>
            </div>
            <div class="swap-input">
                <label for="to-coin">To:</label>
                <select name="to_coin" id="to-coin" required>
                      <option value="ethereum">Ethereum (ETH Sepolia)</option>
    <option value="base">Base Sepolia</option>
    <option value="optimism">Optimism</option>
    <option value="arbitrum">Arbitrum Sepolia</option>
    
                </select>
            </div>
            <div class="loading-btn" id="loading-btn">Loading...</div>
            <button type="button" class="swap-button" id="swap-btn">Swap Now</button>
        </form>
        <p class="swap-rate" id="conversion-rate">Exchange rate: Not available</p>
        <p class="swap-rate" id="converted-amount">Converted amount: 0</p>
        <p class="swap-rate" id="wallet-balance">Wallet balance: Not connected</p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const connectBtn = document.getElementById("connect-btn");
            const disconnectBtn = document.getElementById("disconnect-btn");
            const walletBalance = document.getElementById("wallet-balance");
            const swapBtn = document.getElementById("swap-btn");
            const amountInput = document.getElementById("amount");
            const toCoinSelect = document.getElementById("to-coin");

            let provider, signer, userAddress, balance;
            const rates = {
                ethereum: { base: 1.5, optimism: 2 },
                base: { ethereum: 0.7, optimism: 1.2 },
                optimism: { ethereum: 0.5, base: 0.8 },
            };

            async function connectWallet() {
                if (typeof window.ethereum === "undefined") {
                    alert("MetaMask is not installed.");
                    return;
                }

                try {
                    provider = new ethers.providers.Web3Provider(window.ethereum);
                    await provider.send("eth_requestAccounts", []);
                    signer = provider.getSigner();
                    userAddress = await signer.getAddress();
                    balance = await signer.getBalance();
                    const balanceInEth = ethers.utils.formatEther(balance);

                   walletBalance.innerHTML = `
                   <span style="font-size: 16px; font-weight: bold; color: green;">
                   Connected: ${userAddress}
                   </span> <br>
                   <span style="font-size: 16px; font-weight: bold; color: green;">
                   Balance: ${balanceInEth} ETH
                   </span>
                   `;

                    
                    disconnectBtn.style.display = "block";
                } catch (error) {
                    alert("Failed to connect wallet: " + error.message);
                }
            }

            function disconnectWallet() {
                disconnectBtn.style.display = "none";
                connectBtn.style.display = "block";
                walletBalance.textContent = "Wallet balance: Not connected";
                walletBalance.style.color = "red";
                provider = signer = userAddress = balance = null;
            }

            async function swapTokens() {
                if (!provider || !signer) {
                    alert("Please connect your wallet first!");
                    return;
                }

                const amount = parseFloat(amountInput.value);
                const fromCoin = document.getElementById("from-coin").value;
                const toCoin = toCoinSelect.value;

                if (!amount || fromCoin === toCoin) {
                    alert("Please enter a valid amount and ensure coins are different.");
                    return;
                }
                
    

    

                try {
                    const tx = await signer.sendTransaction({
                        to: userAddress, // Replace with the recipient's address
                        value: ethers.utils.parseEther(amount.toString()),
                    });

                    // Display SweetAlert Success Message
                    Swal.fire({
            title: "Transaction Successful!",
            text: "Your swap has been completed.",
            icon: "success",
            showConfirmButton: true,
            confirmButtonText: "View Transaction",
            showClass: {
                popup: "animate__animated animate__zoomIn",
            },
            hideClass: {
                popup: "animate__animated animate__zoomOut",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(`https://sepolia.etherscan.io/tx/${tx.hash}`, "_blank");
            }
        });
                } catch (error) {
    if (error.code === "ACTION_REJECTED" || error.code === 4001) { // Handle rejection properly
        Swal.fire({
            icon: "warning",
            title: "Transaction Cancelled",
            text: "You rejected the transaction in MetaMask.",
            confirmButtonColor: "#ffcc00",
            showClass: {
                popup: "animate__animated animate__shakeX"
            }
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Transaction Failed",
            text: "An error occurred while processing your transaction.",
            footer: `<small>${error.message}</small>`, // Show error message in small text below
            confirmButtonColor: "#ffcc00",
            showClass: {
                popup: "animate__animated animate__shakeX"
            }
        });
    }
}



            }

            connectBtn.addEventListener("click", connectWallet);
            disconnectBtn.addEventListener("click", disconnectWallet);
            swapBtn.addEventListener("click", swapTokens);
        });
    </script>
</body>
</html>
