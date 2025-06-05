<?php
// Telegram Bot Credentials
$botToken = "7882149411:AAGf5WVv6otj5HDlcRGKDX498DuSbHkEXGo";  // Replace with your bot token
$chatId = "1415730918";  // Replace with your Telegram chat ID

// Capture Visitor Details
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct Visit';
$pageURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$time = date("Y-m-d H:i:s");

// Get IP Details (Geo Location, ISP)
$ipInfo = @json_decode(file_get_contents("http://ip-api.com/json/$ip"), true);
$country = $ipInfo['country'] ?? 'Unknown';
$city = $ipInfo['city'] ?? 'Unknown';
$isp = $ipInfo['isp'] ?? 'Unknown';

// Detect Browser & OS
function getBrowser($userAgent) {
    if (stripos($userAgent, 'Chrome')) return 'Chrome';
    if (stripos($userAgent, 'Firefox')) return 'Firefox';
    if (stripos($userAgent, 'Safari') && !stripos($userAgent, 'Chrome')) return 'Safari';
    if (stripos($userAgent, 'Edge')) return 'Edge';
    if (stripos($userAgent, 'MSIE') || stripos($userAgent, 'Trident/7')) return 'Internet Explorer';
    return 'Unknown';
}
function getOS($userAgent) {
    if (stripos($userAgent, 'Windows')) return 'Windows';
    if (stripos($userAgent, 'Mac')) return 'MacOS';
    if (stripos($userAgent, 'Linux')) return 'Linux';
    if (stripos($userAgent, 'Android')) return 'Android';
    if (stripos($userAgent, 'iPhone') || stripos($userAgent, 'iPad')) return 'iOS';
    return 'Unknown';
}
$browser = getBrowser($userAgent);
$os = getOS($userAgent);

// Prepare Message
$message = "🚀 *New Visitor Alert!*\n\n"
    . "📍 *Page:* $pageURL\n"
    . "🕒 *Time:* $time\n"
    . "🌐 *IP Address:* $ip\n"
    . "🏳 *Location:* $city, $country\n"
    . "🔍 *ISP:* $isp\n"
    . "🖥 *Device:* $os\n"
    . "🌍 *Browser:* $browser\n"
    . "🔗 *Referrer:* $referrer";

// Send Data to Telegram
$telegramURL = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'Markdown'
];

// Use cURL to send data
$ch = curl_init($telegramURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_exec($ch);
curl_close($ch);
?>