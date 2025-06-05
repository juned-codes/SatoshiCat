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

// Handle the AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currency = $_POST['currency'] ?? 'BTC';

    // Fetch balance from API
    $response = api_request('/balance', ['currency' => $currency]);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
