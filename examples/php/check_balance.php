<?php
/**
 * MozeSMS API - Check Account Balance
 * 
 * Example showing how to check your account balance
 */

require_once 'config.php';

$config = include 'config.php';

/**
 * Get account balance
 */
function getBalance($config) {
    $url = $config['base_url'] . '/account/balance';
    
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
echo "Checking account balance...\n\n";

$result = getBalance($config);

if ($result['success']) {
    echo "✅ Balance retrieved successfully!\n\n";
    echo "Current Balance: " . $result['data']['balance'] . " MZN\n";
    echo "SMS Credits: ~" . floor($result['data']['balance'] / 1.35) . " messages\n";
    echo "Currency: " . $result['data']['currency'] . "\n";
} else {
    echo "❌ Failed to get balance\n";
    echo "Error: " . ($result['error'] ?? $result['data']['message'] ?? 'Unknown error') . "\n";
}

echo "\nFull Response:\n";
print_r($result);
