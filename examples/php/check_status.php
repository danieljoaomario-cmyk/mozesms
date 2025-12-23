<?php
/**
 * MozeSMS API - Check SMS Status
 * 
 * Example showing how to check the delivery status of a specific message
 */

require_once 'config.php';

$config = include 'config.php';

/**
 * Check SMS status by message ID
 */
function checkStatus($config, $messageId) {
    $url = $config['base_url'] . '/sms/status/' . $messageId;
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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
$messageId = 'msg_123456789'; // Replace with actual message ID

echo "Checking SMS status...\n";
echo "Message ID: $messageId\n\n";

$result = checkStatus($config, $messageId);

if ($result['success']) {
    echo "✅ Status retrieved successfully!\n\n";
    echo "Message ID: " . $result['data']['message_id'] . "\n";
    echo "Phone: " . $result['data']['phone'] . "\n";
    echo "Status: " . $result['data']['status'] . "\n";
    echo "Sent At: " . $result['data']['sent_at'] . "\n";
    
    if (isset($result['data']['delivered_at'])) {
        echo "Delivered At: " . $result['data']['delivered_at'] . "\n";
    }
    
    if (isset($result['data']['error_message'])) {
        echo "Error: " . $result['data']['error_message'] . "\n";
    }
    
    // Status meanings
    echo "\n📊 Status Meanings:\n";
    echo "  • pending: Message queued for delivery\n";
    echo "  • sent: Message sent to carrier\n";
    echo "  • delivered: Message delivered to recipient\n";
    echo "  • failed: Message delivery failed\n";
    
} else {
    echo "❌ Failed to get status\n";
    echo "Error: " . ($result['error'] ?? $result['data']['message'] ?? 'Unknown error') . "\n";
}

echo "\nFull Response:\n";
print_r($result);
