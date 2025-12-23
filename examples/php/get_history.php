<?php
/**
 * MozeSMS API - Get SMS History
 * 
 * Example showing how to retrieve your SMS history with filters
 */

require_once 'config.php';

$config = include 'config.php';

/**
 * Get SMS history
 */
function getHistory($config, $filters = []) {
    $url = $config['base_url'] . '/sms/history';
    
    // Add query parameters if provided
    if (!empty($filters)) {
        $url .= '?' . http_build_query($filters);
    }
    
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

// Example 1: Get recent messages (default)
echo "=== Example 1: Get Recent Messages ===\n\n";
$result = getHistory($config);

if ($result['success']) {
    echo "✅ History retrieved successfully!\n";
    echo "Total messages: " . $result['data']['total'] . "\n";
    echo "Page: " . $result['data']['page'] . " of " . $result['data']['pages'] . "\n\n";
    
    if (!empty($result['data']['messages'])) {
        echo "Recent messages:\n";
        foreach (array_slice($result['data']['messages'], 0, 5) as $msg) {
            echo "  • ID: " . $msg['id'] . "\n";
            echo "    Phone: " . $msg['phone'] . "\n";
            echo "    Status: " . $msg['status'] . "\n";
            echo "    Date: " . $msg['created_at'] . "\n\n";
        }
    }
}

// Example 2: Get messages with filters
echo "\n=== Example 2: Get Messages with Filters ===\n\n";

$filters = [
    'status' => 'delivered',
    'limit' => 10,
    'page' => 1,
    'date_from' => date('Y-m-d', strtotime('-7 days')),
    'date_to' => date('Y-m-d')
];

echo "Filters:\n";
print_r($filters);
echo "\n";

$result = getHistory($config, $filters);

if ($result['success']) {
    echo "✅ Filtered history retrieved successfully!\n";
    echo "Total delivered messages (last 7 days): " . $result['data']['total'] . "\n";
}

echo "\nFull Response:\n";
print_r($result);
