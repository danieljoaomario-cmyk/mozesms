# MozeSMS API

**Professional SMS Gateway API for Mozambique**

MozeSMS provides a reliable, high-performance REST API for sending SMS messages in Mozambique. Designed for developers and businesses who need a simple, secure, and scalable messaging solution.

## Features

- **REST API** - Modern JSON-based API
- **Single & Bulk SMS** - Send one or thousands of messages
- **Real-time Delivery** - Fast message delivery across all Mozambican networks
- **Balance Management** - Real-time balance queries
- **Message History** - Complete message tracking and history
- **Delivery Reports** - Track message delivery status
- **Multiple Authentication** - Bearer Token, API Keys, or JWT
- **Unicode Support** - Full support for special characters and emojis
- **High Availability** - 99.9% uptime SLA

## Quick Start

### 1. Get Your Credentials

Sign up at [https://my.mozesms.com](https://my.mozesms.com) to receive:
- User ID
- API Key

### 2. Send Your First SMS

```bash
curl -X POST https://api.mozesms.com/v2/sms/send \
  -H "Authorization: Bearer YOUR_USER_ID:YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "phone": "258847001234",
    "message": "Hello from MozeSMS API",
    "sender_id": "YourBrand"
  }'
```

### 3. Response

```json
{
  "success": true,
  "data": {
    "id": "msg_abc123",
    "phone": "258847001234",
    "status": "sent",
    "cost": 1.35,
    "remaining_balance": 98.65
  }
}
```

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/v2/sms/send` | Send single SMS |
| POST | `/sms/bulk` | Send bulk SMS |
| GET | `/account/balance` | Check account balance |
| GET | `/sms/history` | Get message history |
| GET | `/sms/status/:id` | Check delivery status |

## Authentication

All API requests require authentication using one of these methods:

### Bearer Token (Recommended)
```http
Authorization: Bearer {user_id}:{api_key}
```

### API Headers
```http
X-API-Key: {api_key}
X-API-Secret: {user_id}:{api_key}
```

## Code Examples

### PHP
```php
$ch = curl_init('https://api.mozesms.com/v2/sms/send');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer 12:YOUR_API_KEY',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'phone' => '258847001234',
    'message' => 'Hello World',
    'sender_id' => 'YourBrand'
]));
$response = curl_exec($ch);
curl_close($ch);
```

### Python
```python
import requests

response = requests.post(
    'https://api.mozesms.com/v2/sms/send',
    headers={
        'Authorization': 'Bearer 12:YOUR_API_KEY',
        'Content-Type': 'application/json'
    },
    json={
        'phone': '258847001234',
        'message': 'Hello World',
        'sender_id': 'YourBrand'
    }
)
print(response.json())
```

### Node.js
```javascript
const axios = require('axios');

axios.post('https://api.mozesms.com/v2/sms/send', {
    phone: '258847001234',
    message: 'Hello World',
    sender_id: 'YourBrand'
}, {
    headers: {
        'Authorization': 'Bearer 12:YOUR_API_KEY',
        'Content-Type': 'application/json'
    }
}).then(response => {
    console.log(response.data);
});
```

## Pricing

| Service | Price (MZN) |
|---------|-------------|
| SMS (Standard) | 1.35 per message |
| Minimum Balance | 100.00 |

*Long messages are split into multiple parts (160 characters for standard text, 70 for Unicode). Each part is charged separately.*

## Rate Limits

- **100 requests per minute** per account
- **1000 SMS per minute** for bulk sending

## Support

- **Email**: support@mozesms.com
- **Website**: [https://www.mozesms.com](https://www.mozesms.com)
- **Developer Portal**: [https://my.mozesms.com](https://my.mozesms.com)

## Status & Uptime

Check our API status at: [https://status.mozesms.com](https://status.mozesms.com)

## Terms of Service

By using this API, you agree to our [Terms of Service](https://www.mozesms.com/terms) and [Privacy Policy](https://www.mozesms.com/privacy).

---

**© 2025 MozeSMS. All rights reserved.**
