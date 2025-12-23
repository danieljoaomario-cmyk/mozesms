<?php
/**
 * MozeSMS API Configuration
 * 
 * Copy this file to config.php and fill in your credentials
 */

return [
    // Get your credentials from https://my.mozesms.com
    'api_key' => 'YOUR_API_KEY',
    'api_secret' => 'YOUR_API_SECRET',
    
    // API Base URL
    'base_url' => 'https://api.mozesms.com',
    
    // Default sender ID (optional)
    'sender_id' => 'MozeSMS',
    
    // Timeout settings
    'timeout' => 30,
    'connect_timeout' => 10,
];
