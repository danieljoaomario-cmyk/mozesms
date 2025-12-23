# 📱 MozeSMS API

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![API Version](https://img.shields.io/badge/API-v2.0-green.svg)](https://api.mozesms.com)
[![Uptime](https://img.shields.io/badge/Uptime-99.9%25-brightgreen.svg)](https://status.mozesms.com)
[![Support](https://img.shields.io/badge/Support-24%2F7-blue.svg)](mailto:support@mozesms.com)

**Enterprise-Grade SMS Gateway for Mozambique**

MozeSMS is the leading SMS delivery platform for businesses operating in Mozambique. Our robust REST API enables developers to integrate SMS capabilities into their applications with just a few lines of code. Trusted by banks, fintech companies, e-commerce platforms, and enterprises across Mozambique.

## 🌟 Why Choose MozeSMS?

- **🚀 Fast Delivery** - 1-5 second average delivery time across all Mozambican carriers (Vodacom, Movitel, TMcel)
- **🔒 Enterprise Security** - Bank-grade encryption, secure credential management, and compliance with data protection standards
- **📊 Real-time Analytics** - Track delivery rates, response times, and campaign performance
- **💪 High Reliability** - 99.9% uptime SLA with automatic failover and redundant infrastructure
- **🌍 Wide Coverage** - Direct connections with all major Mozambican mobile operators
- **💼 Business Ready** - Supports transactional SMS, marketing campaigns, OTP verification, and alerts

## ✨ Core Features

### Messaging Capabilities
- ✅ **Single SMS** - Send individual messages with personal content
- ✅ **Bulk SMS** - Send thousands of messages simultaneously (up to 10,000 per batch)
- ✅ **Scheduled SMS** - Schedule messages for future delivery
- ✅ **Two-Way SMS** - Receive replies and build interactive experiences (coming soon)
- ✅ **Unicode Support** - Full support for emojis and special characters
- ✅ **Long Messages** - Automatic segmentation for messages up to 918 characters

### Developer Experience
- 🔧 **RESTful API** - Modern JSON-based architecture
- 🔐 **Multiple Auth Methods** - Bearer Token, API Keys, or JWT
- 📚 **Comprehensive Docs** - Complete API reference with examples in 5+ languages
- 🎯 **Webhooks** - Real-time delivery status notifications
- 🧪 **Sandbox Environment** - Test without spending credits
- 📦 **SDKs Coming Soon** - Official libraries for PHP, Python, Node.js, Java, C#

### Business Tools
- 💰 **Real-time Balance** - Monitor your credit balance via API
- 📈 **Delivery Reports** - Track message status (sent, delivered, failed)
- 🗂️ **Message History** - Complete audit trail with filtering and search
- 👤 **Custom Sender IDs** - Brand your messages with your company name
- 🎨 **Templates** - Save and reuse message templates
- 📊 **Analytics Dashboard** - Visualize your SMS campaigns (portal)

## 🎯 Use Cases

### Financial Services
- Transaction confirmations and receipts
- Account balance notifications
- Security alerts and fraud detection
- Payment reminders

### E-Commerce & Retail
- Order confirmations and shipping updates
- Promotional campaigns and flash sales
- Customer support and feedback requests
- Loyalty program notifications

### Healthcare
- Appointment reminders
- Prescription refill alerts
- Test results notifications
- Health tips and wellness campaigns

### Authentication & Security
- Two-factor authentication (2FA)
- One-time passwords (OTP)
- Password reset verification
- Account activation codes

### Logistics & Transportation
- Delivery status updates
- Driver notifications
- Route changes and delays
- Customer pickup alerts

## 🏢 Enterprise Features

- **Dedicated Account Manager** - Personal support for high-volume clients
- **Custom Integration** - Tailored solutions for complex requirements
- **Priority Support** - 24/7 technical assistance
- **Volume Discounts** - Competitive pricing for large-scale operations
- **Service Level Agreements** - Guaranteed uptime and performance
- **Compliance Support** - GDPR and local regulations assistance

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

## 📦 Code Examples

Ready-to-use code examples for quick integration:

👉 **[Browse All Examples](./examples/)** - Complete working examples in multiple languages

- **[PHP Examples](./examples/php/)** - Send SMS, check balance, get history
- **[Python Examples](./examples/python/)** - Type-hinted, modern Python code
- **[Node.js Examples](./examples/nodejs/)** - Async/await with Axios
- **[Java Examples](./examples/java/)** - Maven/Gradle ready examples
- **[C# Examples](./examples/csharp/)** - .NET 6.0+ with HttpClient

Each folder includes:
- ✅ Configuration templates
- ✅ Complete working examples
- ✅ Error handling
- ✅ Step-by-step instructions

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
<?php
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
$result = json_decode($response, true);
curl_close($ch);

if ($result['success']) {
    echo "SMS sent! Cost: {$result['data']['cost']} MZN\n";
    echo "Balance: {$result['data']['remaining_balance']} MZN\n";
}
?>
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

result = response.json()
if result['success']:
    print(f"SMS sent! Cost: {result['data']['cost']} MZN")
    print(f"Balance: {result['data']['remaining_balance']} MZN")
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
    const result = response.data;
    if (result.success) {
        console.log(`SMS sent! Cost: ${result.data.cost} MZN`);
        console.log(`Balance: ${result.data.remaining_balance} MZN`);
    }
}).catch(error => {
    console.error('Error:', error.response?.data || error.message);
});
```

### Java
```java
import java.net.http.*;
import java.net.URI;
import org.json.*;

public class MozeSMS {
    public static void main(String[] args) throws Exception {
        String apiUrl = "https://api.mozesms.com/v2/sms/send";
   💰 Pricing

| Service | Price (MZN) | Volume Discount |
|---------|-------------|-----------------|
| Standard SMS | 1.35 per message | Available for 10,000+ |
| Minimum Recharge | 100.00 | One-time setup |
| Custom Sender ID | Free | Approval required |

**Message Segmentation:**
- Standard text (GSM 7-bit): 160 characters per segment
- Unicode (emojis/special chars): 70 characters per segment
- Each segment is charged separately
- No setup fees or monthly charges

**Example Pricing:**
- 320 character message = 3 segments = 4.05 MZN
- 140 character message with emoji = 2 segments = 2.70 MZN

**Enterprise Pricing:** Contact us for volume discounts and custom packages.

## ⚡ Performance & Limits

### Rate Limits
- **API Requests:** 100 requests per minute per account
- **Bulk Sending:** 1,000 SMS per minute
- **Concurrent Connections:** 10 simultaneous connections

### Performance Metrics
- **Average Delivery Time:** 1-5 seconds
- **Peak Delivery Time:** Up to 30 seconds during high traffic
- **Success Rate:** 99.5% average delivery success
- **Uptime SLA:** 99.9% guaranteed availability

### Technical Specifications
- **Timeout:** 30 seconds per request
- **Max Message Length:** 918 characters (6 segments)
- **Max Recipients per Bulk:** 10,000 per request
- **Supported Networks:** Vodacom, Movitel, TMcelrs.ofString(payload.toString()))
            .build();
            
        HttpResponse<String> response = client.send(request, 
            HttpResponse.BodyHandlers.ofString());
            
        JSONObject result = new JSONObject(response.body());
        if (result.getBoolean("success")) {
            JSONObject data = result.getJSONObject("data");
            System.out.println("SMS sent! Cost: " + data.getDouble("cost") + " MZN");
            System.out.println("Balance: " + data.getDouble("remaining_balance") + " MZN");
        }
    }
}
```

### C# (.NET)
```csharp
using System;
using System.Net.Http;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;

class Program
{
    static async Task Main()
    {
        var client = new HttpClient();
        client.DefaultRequestHeaders.Add("Authorization", "Bearer 12:YOUR_API_KEY");
        
        var payload = new
        {
            phone = "258847001234",
            message = "Hello World",
            sender_id = "YourBrand"
        };
        
        var json = JsonSerializer.Serialize(payload);
        var content = new StringContent(json, Encoding.UTF8, "application/json");
        
        var response = await client.PostAsync(
            "https://api.mozesms.com/v2/sms/send", content);
        
        var result = await response.Content.ReadAsStringAsync();
        var data = JsonSerializer.Deserialize<JsonElement>(result);
        
        if (data.GetProperty("success").GetBoolean())
        {
            var smsData = data.GetProperty("data");
            Console.WriteLine($"SMS sent! Cost: {smsData.GetProperty("cost")} MZN");
            Console.WriteLine($"Balance: {smsData.GetProperty("remaining_balance")} MZN");
        }
    }
}
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

## Frequently Asked Questions

**Q: How long does it take for messages to be delivered?**  
A: Typically 1-5 seconds. During peak hours, delivery may take up to 30 seconds.

**Q: Can I send international SMS?**  
A: Currently, we only support Mozambican phone numbers (258 country code).

**Q: What happens if a message fails to send?**  
A: Your balance is only deducted for successfully sent messages. Failed messages are not charged.

**Q: How do I get a custom Sender ID?**  
A: Request approval via the portal at [https://my.mozesms.com/sender-ids](https://my.mozesms.com/sender-ids). Approval typically takes 1-2 business days.

**Q: Is there a minimum balance requirement?**  
A: Yes, the minimum recharge amount is 100 MZN.

**Q: Do credits expire?**  
A: No, account credits never expire.

**Q: Can I receive SMS with this API?**  
A: Currently, this is a send-only API. We're developing two-way SMS capabilities.

**Q: What's the difference between v2 and v4 endpoints?**  
A: v4 endpoints (like `/v2/sms/send`) use modern JSON format with better error handling. v2 endpoints (like `/message/v2`) use legacy form-data format for backward compatibility.

**Q: How do I migrate from the old API?**  
A: Both old and new endpoints work simultaneously. Update your code gradually. The new API offers better features and error handling.

---

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
