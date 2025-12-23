<?php
/**
 * MozeSMS API - Send Single SMS
 * 
 * Example showing how to send a single SMS message
 */

require_once 'config.php';

$config = include 'config.php';

/**
 * Send a single SMS message
 */
function sendSMS($config, $phone, $message, $senderId = null) {
    $url = $config['base_url'] . '/v2/sms/send';
    
    $data = [
        'phone' => $phone,
        'message' => $message,
    ];
    
    if ($senderId) {
        $data['sender_id'] = $senderId;
    }
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'X-API-Key: ' . $config['api_key'],
        'X-API-Secret: ' . $config['api_secret']
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, $config['timeout']);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $config['connect_timeout']);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        return [
            'success' => false,
            'error' => 'cURL Error: ' . $error
        ];
    }
    
    $result = json_decode($response, true);
    
    return [
        'success' => $httpCode === 200,
        'http_code' => $httpCode,
        'data' => $result
    ];
}

// Example usage
$phone = '258840000000'; // Replace with recipient's phone number
$message = 'Olá! Esta é uma mensagem de teste do MozeSMS API.';
$senderId = $config['sender_id'];

echo "Sending SMS...\n";
echo "Phone: $phone\n";
echo "Message: $message\n\n";

$result = sendSMS($config, $phone, $message, $senderId);

if ($result['success']) {
    echo "✅ SMS sent successfully!\n";
    echo "Message ID: " . $result['data']['message_id'] . "\n";
    echo "Status: " . $result['data']['status'] . "\n";
} else {
    echo "❌ Failed to send SMS\n";
    echo "Error: " . ($result['error'] ?? $result['data']['message'] ?? 'Unknown error') . "\n";
}

echo "\nResponse:\n";
print_r($result);
