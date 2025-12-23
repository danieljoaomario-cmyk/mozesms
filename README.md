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

### Core Endpoints (Recommended)

| Method | Endpoint | Authentication | Description |
|--------|----------|----------------|-------------|
| POST | `/v2/sms/send` | Bearer Token | Send single SMS message |
| POST | `/sms/bulk` | API Headers/Bearer | Send bulk SMS (multiple recipients) |
| GET | `/account/balance` | Any | Check current account balance |
| GET | `/sms/history` | Any | Retrieve message history with filters |
| GET | `/sms/status/:id` | Any | Check delivery status of specific message |
| POST | `/auth/login` | None | Obtain JWT token (email/password) |
| POST | `/auth/refresh` | Refresh Token | Renew expired JWT access token |

### Legacy Endpoints (Backward Compatibility)

For existing integrations using our older API format:

| Method | Endpoint | Format | Description |
|--------|----------|--------|-------------|
| POST | `/message/v2` | Form-data | Legacy single SMS (v2) |
| POST | `/message/v3` | Form-data | Legacy single SMS (v3) |
| POST | `/otp/v2` | Form-data | Send OTP verification code |
| POST | `/bulk_json/v2` | JSON array | Legacy bulk SMS |

**Note:** Legacy endpoints use Bearer authentication with format: `Bearer {user_id}:{api_key}`

## Authentication

All API requests require authentication. We support multiple methods for maximum compatibility:

### Method 1: Bearer Token (Recommended)
Simple and secure authentication for modern applications.

```http
Authorization: Bearer {user_id}:{api_key}
```

**Example:**
```http
Authorization: Bearer 12:EYjgLC-PtDmy2-duGtiX-pHgbop
```

### Method 2: API Key Headers
Separate headers for added security.

```http
X-API-Key: {api_key}
X-API-Secret: {user_id}:{api_key}
```

### Method 3: JWT Token
For user-based authentication with session management.

```http
Authorization: Bearer {jwt_access_token}
```

First obtain a JWT token via `/auth/login`, then use it for subsequent requests.

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
