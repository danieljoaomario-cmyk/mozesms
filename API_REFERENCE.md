# MozeSMS API Reference

Complete technical reference for the MozeSMS REST API.

**Base URL**: `https://api.mozesms.com`  
**Version**: 2.0  
**Format**: JSON  
**Encoding**: UTF-8

---

## Authentication

All endpoints require authentication except where noted.

### Method 1: Bearer Token (Recommended)

```http
Authorization: Bearer {user_id}:{api_key}
```

**Example:**
```http
Authorization: Bearer 12:EYjgLC-PtDmy2-duGtiX-pHgbop
```

### Method 2: API Headers

```http
X-API-Key: {api_key}
X-API-Secret: {user_id}:{api_key}
```

### Method 3: JWT Token

```http
Authorization: Bearer {jwt_token}
```

Obtain JWT token via `/auth/login` endpoint.

---

## Endpoints

### Send Single SMS

Send an SMS to a single recipient.

**Endpoint:** `POST /v2/sms/send`

**Headers:**
```http
Authorization: Bearer {user_id}:{api_key}
Content-Type: application/json
```

**Request Body:**
```json
{
  "phone": "258847001234",
  "message": "Your message text here",
  "sender_id": "YourBrand"
}
```

**Parameters:**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| phone | string | Yes | Recipient phone number (258XXXXXXXXX or 8XXXXXXXXX) |
| message | string | Yes | Message content (max 918 characters) |
| sender_id | string | No | Sender ID (max 11 characters). Default: "MozeSMS" |

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": "OTIxODV8MTc2NjQ0NDM4NXwxMg==",
    "phone": "258847001234",
    "status": "sent",
    "parts": 1,
    "cost": 1.35,
    "remaining_balance": 2674.63,
    "gateway_response": "SMS sent successfully"
  }
}
```

**Error Response (400):**
```json
{
  "success": false,
  "error": "Insufficient balance",
  "current_balance": 0.50,
  "required_amount": 1.35,
  "segments": 1
}
```

---

### Send Bulk SMS

Send SMS to multiple recipients.

**Endpoint:** `POST /sms/bulk`

**Headers:**
```http
X-API-Key: {api_key}
X-API-Secret: {user_id}:{api_key}
Content-Type: application/json
```

**Request Body (Same Message):**
```json
{
  "phones": [
    "258847001234",
    "258843456789",
    "258845888195"
  ],
  "message": "Your promotional message",
  "sender_id": "YourBrand"
}
```

**Request Body (Different Messages):**
```json
{
  "messages": [
    {
      "phone": "258847001234",
      "message": "Hello John, your order #1234 is ready"
    },
    {
      "phone": "258843456789",
      "message": "Hello Mary, your order #1235 is ready"
    }
  ],
  "sender_id": "YourBrand"
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "batch_id": "BATCH_674995afb9b7c",
    "total_messages": 3,
    "total_cost": 4.05,
    "remaining_balance": 2670.58,
    "results": [
      {
        "phone": "258847001234",
        "status": "sent",
        "parts": 1,
        "cost": 1.35
      },
      {
        "phone": "258843456789",
        "status": "sent",
        "parts": 1,
        "cost": 1.35
      },
      {
        "phone": "258845888195",
        "status": "sent",
        "parts": 1,
        "cost": 1.35
      }
    ],
    "summary": {
      "sent": 3,
      "failed": 0,
      "invalid": 0
    }
  }
}
```

---

### Check Balance

Get current account balance.

**Endpoint:** `GET /account/balance`

**Headers:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "balance": 2674.63,
    "currency": "MZN",
    "user": {
      "name": "Your Company Name",
      "email": "contact@yourcompany.com"
    }
  }
}
```

---

### Get Message History

Retrieve sent messages with optional filters.

**Endpoint:** `GET /sms/history`

**Headers:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Query Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| limit | integer | Number of records (default: 50, max: 500) |
| offset | integer | Pagination offset (default: 0) |
| status | string | Filter by status: `sent`, `pending`, `failed` |
| start_date | string | Filter from date (YYYY-MM-DD) |
| end_date | string | Filter to date (YYYY-MM-DD) |

**Example Request:**
```http
GET /sms/history?limit=10&status=sent&start_date=2025-12-01
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "total": 1247,
    "limit": 10,
    "offset": 0,
    "messages": [
      {
        "id": "OTIxODV8MTc2NjQ0NDM4NXwxMg==",
        "phone": "258847001234",
        "message": "Your verification code is: 123456",
        "sender_id": "YourBrand",
        "status": "sent",
        "parts": 1,
        "cost": 1.35,
        "created_at": "2025-12-23 10:30:15",
        "sent_at": "2025-12-23 10:30:16"
      }
    ]
  }
}
```

---

### Check Delivery Status

Check the delivery status of a specific message.

**Endpoint:** `GET /sms/status/:id`

**Headers:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": "OTIxODV8MTc2NjQ0NDM4NXwxMg==",
    "phone": "258847001234",
    "status": "delivered",
    "created_at": "2025-12-23 10:30:15",
    "sent_at": "2025-12-23 10:30:16",
    "delivered_at": "2025-12-23 10:30:18",
    "parts": 1,
    "cost": 1.35
  }
}
```

---

### User Authentication (JWT)

Login to obtain a JWT token.

**Endpoint:** `POST /auth/login`

**No authentication required**

**Request Body:**
```json
{
  "email": "your@email.com",
  "password": "your_password"
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 12,
      "name": "Your Name",
      "email": "your@email.com",
      "type": "admin_empresa"
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "expires_in": 3600
  }
}
```

---

### Refresh JWT Token

Refresh an expired JWT access token.

**Endpoint:** `POST /auth/refresh`

**Headers:**
```http
Content-Type: application/json
```

**Request Body:**
```json
{
  "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "expires_in": 3600
  }
}
```

---

## Legacy API Endpoints

For backward compatibility with existing integrations. These endpoints maintain the old API format.

### Legacy Single SMS (v2/v3)

Send SMS using form-data format (old API).

**Endpoints:**
- `POST /message/v2`
- `POST /message/v3`

**Authentication:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Content-Type:** `application/x-www-form-urlencoded`

**Request Parameters (Form-data):**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| from | string | Yes | Sender ID (max 11 characters) |
| to | string | Yes | Recipient phone number |
| message | string | Yes | Message text |

**Example Request:**
```bash
curl -X POST https://api.mozesms.com/message/v2 \
  -H "Authorization: Bearer 12:EYjgLC-PtDmy2-duGtiX-pHgbop" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "from=YourBrand&to=258847001234&message=Hello from legacy API"
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": "OTIxODV8MTc2NjQ0NDM4NXwxMg==",
    "phone": "258847001234",
    "status": "sent",
    "parts": 1,
    "cost": 1.35,
    "remaining_balance": 2674.63
  }
}
```

---

### Legacy OTP Send

Send OTP verification codes (v2 format).

**Endpoint:** `POST /otp/v2`

**Authentication:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Content-Type:** `application/x-www-form-urlencoded`

**Request Parameters (Form-data):**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| to | string | Yes | Recipient phone number |
| code | string | No | OTP code (auto-generated if not provided) |
| from | string | No | Sender ID (default: "MozeSMS") |

**Example Request:**
```bash
curl -X POST https://api.mozesms.com/otp/v2 \
  -H "Authorization: Bearer 12:EYjgLC-PtDmy2-duGtiX-pHgbop" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "to=258847001234&from=YourBrand"
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "id": "OTIxODV8MTc2NjQ0NDM4NXwxMg==",
    "phone": "258847001234",
    "status": "sent",
    "parts": 1,
    "cost": 1.35,
    "remaining_balance": 2673.28
  }
}
```

---

### Legacy Bulk SMS

Send bulk SMS using legacy JSON array format.

**Endpoint:** `POST /bulk_json/v2`

**Authentication:**
```http
Authorization: Bearer {user_id}:{api_key}
```

**Content-Type:** `application/json`

**Request Body (Format 1 - Direct Array):**
```json
[
  {
    "number": "258847001234",
    "text": "Message for recipient 1"
  },
  {
    "number": "258843456789",
    "text": "Message for recipient 2"
  }
]
```

**Request Body (Format 2 - With Messages Key):**
```json
{
  "messages": [
    {
      "number": "258847001234",
      "text": "Message for recipient 1"
    },
    {
      "number": "258843456789",
      "text": "Message for recipient 2"
    }
  ]
}
```

**Request Body (Format 3 - PHP post_data):**
```
post_data=[{"number":"258847001234","text":"Message 1"},{"number":"258843456789","text":"Message 2"}]
```

**Example Request:**
```bash
curl -X POST https://api.mozesms.com/bulk_json/v2 \
  -H "Authorization: Bearer 12:EYjgLC-PtDmy2-duGtiX-pHgbop" \
  -H "Content-Type: application/json" \
  -d '[
    {"number": "258847001234", "text": "Hello recipient 1"},
    {"number": "258843456789", "text": "Hello recipient 2"}
  ]'
```

**Response (200 OK):**
```json
{
  "success": true,
  "data": {
    "batch_id": "BATCH_674995afb9b7c",
    "total_messages": 2,
    "total_cost": 2.70,
    "remaining_balance": 2670.58,
    "results": [
      {
        "phone": "258847001234",
        "status": "sent",
        "parts": 1,
        "cost": 1.35
      },
      {
        "phone": "258843456789",
        "status": "sent",
        "parts": 1,
        "cost": 1.35
      }
    ],
    "summary": {
      "sent": 2,
      "failed": 0,
      "invalid": 0
    }
  }
}
```

---

## HTTP Status Codes

| Code | Meaning | Description |
|------|---------|-------------|
| 200 | OK | Request successful |
| 400 | Bad Request | Invalid parameters or missing required fields |
| 401 | Unauthorized | Invalid or missing authentication credentials |
| 402 | Payment Required | Insufficient account balance |
| 403 | Forbidden | Sender ID not authorized or access denied |
| 404 | Not Found | Resource not found |
| 429 | Too Many Requests | Rate limit exceeded |
| 500 | Internal Server Error | Server error occurred |
| 502 | Bad Gateway | Gateway communication error |

---

## Message Status Values

| Status | Description |
|--------|-------------|
| pending | Message queued for delivery |
| sent | Message sent to gateway |
| delivered | Message delivered to recipient |
| failed | Delivery failed |
| rejected | Rejected by carrier |

---

## Error Handling

All error responses follow this format:

```json
{
  "success": false,
  "error": "Error message description",
  "code": "ERROR_CODE"
}
```

**Common Error Codes:**

| Code | Description |
|------|-------------|
| INVALID_PHONE | Phone number format is invalid |
| INSUFFICIENT_BALANCE | Account balance too low |
| INVALID_CREDENTIALS | Authentication failed |
| SENDER_ID_NOT_APPROVED | Sender ID requires approval |
| RATE_LIMIT_EXCEEDED | Too many requests |
| INVALID_MESSAGE | Message content is invalid |

---

## Message Segmentation

Messages are automatically split into segments based on length and character type:

| Type | Characters per Segment | Cost per Segment |
|------|------------------------|------------------|
| Standard (GSM 7-bit) | 160 characters | 1.35 MZN |
| Unicode (with emojis/special chars) | 70 characters | 1.35 MZN |

**Examples:**
- 320 character message = 3 segments = 4.05 MZN
- 140 character message with emoji = 2 segments = 2.70 MZN

---

## Rate Limits

- **100 requests per minute** per account
- **1000 SMS per minute** for bulk operations

Exceeding rate limits returns HTTP 429 with:

```json
{
  "success": false,
  "error": "Rate limit exceeded",
  "retry_after": 60
}
```

---

## Phone Number Format

Valid Mozambique phone numbers:

- **With country code**: 258847001234
- **Without country code**: 847001234

Both formats are accepted. Numbers are automatically normalized.

**Valid prefixes:** 82, 83, 84, 85, 86, 87

---

## Sender ID Rules

- Maximum 11 characters
- Alphanumeric only (no spaces or special characters)
- Must be approved before use (request via portal)
- Default: "MozeSMS" (pre-approved)

---

## Best Practices

### 1. Error Handling
Always check the `success` field in responses and handle errors appropriately.

### 2. Retry Logic
Implement exponential backoff for temporary failures (500, 502, 503).

### 3. Balance Monitoring
Check balance before bulk operations to avoid partial sends.

### 4. Phone Validation
Validate phone numbers before sending to avoid unnecessary charges.

### 5. Rate Limiting
Implement rate limiting on your side to stay within API limits.

---

## SDKs & Libraries

Official SDKs coming soon:
- PHP SDK
- Python SDK
- Node.js SDK
- Java SDK

---

## Support

**Technical Support:**
- Email: support@mozesms.com
- Developer Portal: https://my.mozesms.com/support

**Business Hours:**
- Monday - Friday: 08:00 - 18:00 (Maputo Time)
- Saturday: 09:00 - 13:00
- Emergency: support@mozesms.com

---

**© 2025 MozeSMS. All rights reserved.**
