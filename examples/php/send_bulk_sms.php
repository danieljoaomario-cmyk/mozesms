<?php
/**
 * MozeSMS API - Send Bulk SMS
 * 
 * Example showing how to send SMS to multiple recipients
 */

require_once 'config.php';

$config = include 'config.php';

/**
 * Send bulk SMS to multiple recipients
 */
function sendBulkSMS($config, $messages) {
    $url = $config['base_url'] . '/sms/bulk';
    
    $data = ['messages' => $messages];
    
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

// Example usage - Send to multiple recipients
$messages = [
    [
        'phone' => '258840000001',
        'message' => 'Olá João! Promoção especial: 20% de desconto hoje!',
        'sender_id' => $config['sender_id']
    ],
    [
        'phone' => '258840000002',
        'message' => 'Olá Maria! Não perca nossa oferta exclusiva.',
        'sender_id' => $config['sender_id']
    ],
    [
        'phone' => '258840000003',
        'message' => 'Olá Carlos! Visite nossa loja hoje e ganhe brindes.',
        'sender_id' => $config['sender_id']
    ]
];

echo "Sending Bulk SMS...\n";
echo "Total messages: " . count($messages) . "\n\n";

$result = sendBulkSMS($config, $messages);

if ($result['success']) {
    echo "✅ Bulk SMS sent successfully!\n";
    echo "Total sent: " . $result['data']['total'] . "\n";
    echo "Successful: " . $result['data']['sent'] . "\n";
    echo "Failed: " . $result['data']['failed'] . "\n\n";
    
    if (!empty($result['data']['results'])) {
        echo "Individual results:\n";
        foreach ($result['data']['results'] as $index => $res) {
            echo "  [" . ($index + 1) . "] Phone: " . $res['phone'] . " - ";
            echo "Status: " . $res['status'] . " - ";
            echo "ID: " . ($res['message_id'] ?? 'N/A') . "\n";
        }
    }
} else {
    echo "❌ Failed to send bulk SMS\n";
    echo "Error: " . ($result['error'] ?? $result['data']['message'] ?? 'Unknown error') . "\n";
}

echo "\nFull Response:\n";
print_r($result);
