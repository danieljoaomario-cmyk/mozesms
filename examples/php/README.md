# PHP Examples - MozeSMS API

Ready-to-use PHP examples for the MozeSMS API.

## 📋 Requirements

- PHP 7.4 or higher
- cURL extension enabled
- Valid MozeSMS API credentials

## 🚀 Quick Start

1. **Copy configuration file:**
   ```bash
   cp config.example.php config.php
   ```

2. **Edit config.php with your credentials:**
   ```php
   return [
       'api_key' => 'your_actual_api_key',
       'api_secret' => 'your_actual_api_secret',
       'base_url' => 'https://api.mozesms.com',
       'sender_id' => 'YourBrand',
   ];
   ```

3. **Run an example:**
   ```bash
   php send_single_sms.php
   ```

## 📚 Available Examples

### 1. Send Single SMS
**File:** `send_single_sms.php`

Send a single SMS message to one recipient.

```bash
php send_single_sms.php
```

### 2. Send Bulk SMS
**File:** `send_bulk_sms.php`

Send SMS to multiple recipients in a single request.

```bash
php send_bulk_sms.php
```

### 3. Check Balance
**File:** `check_balance.php`

Check your account balance and remaining SMS credits.

```bash
php check_balance.php
```

### 4. Get SMS History
**File:** `get_history.php`

Retrieve your SMS history with optional filters.

```bash
php get_history.php
```

### 5. Check SMS Status
**File:** `check_status.php`

Check the delivery status of a specific message.

```bash
php check_status.php
```

### 6. Legacy API Examples
**File:** `legacy_api.php`

Examples using the legacy endpoints (v2, v3 formats).

```bash
php legacy_api.php
```

## 🔐 Configuration

All examples use the `config.php` file for credentials and settings:

```php
return [
    'api_key' => 'YOUR_API_KEY',          // Required
    'api_secret' => 'YOUR_API_SECRET',    // Required
    'base_url' => 'https://api.mozesms.com',
    'sender_id' => 'MozeSMS',              // Optional
    'timeout' => 30,
    'connect_timeout' => 10,
];
```

## 📱 Phone Number Format

Always use international format without the + sign:
- ✅ Correct: `258840000000`
- ❌ Wrong: `+258840000000`, `840000000`

## 🔍 Error Handling

All examples include comprehensive error handling:

```php
$result = sendSMS($config, $phone, $message);

if ($result['success']) {
    // Success handling
    echo "Message ID: " . $result['data']['message_id'];
} else {
    // Error handling
    echo "Error: " . ($result['error'] ?? 'Unknown error');
}
```

## 💡 Tips

1. **Test in sandbox first** - Use sandbox.mozesms.com for testing
2. **Handle errors gracefully** - Always check the response status
3. **Use sender ID** - Brand your messages with your company name
4. **Monitor balance** - Check balance regularly to avoid service interruption
5. **Validate phone numbers** - Ensure correct format before sending

## 📖 Documentation

- [API Reference](../../API_REFERENCE.md)
- [Main Documentation](../../README.md)

## 🆘 Support

- Email: support@mozesms.com
- WhatsApp: +258 84 123 4567
- Portal: https://my.mozesms.com
