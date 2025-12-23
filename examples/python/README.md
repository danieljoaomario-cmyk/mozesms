# Python Examples - MozeSMS API

Ready-to-use Python examples for the MozeSMS API.

## 📋 Requirements

- Python 3.7 or higher
- requests library
- Valid MozeSMS API credentials

## 🚀 Quick Start

1. **Install dependencies:**
   ```bash
   pip install -r requirements.txt
   ```

2. **Copy configuration file:**
   ```bash
   cp config.example.py config.py
   ```

3. **Edit config.py with your credentials:**
   ```python
   API_KEY = 'your_actual_api_key'
   API_SECRET = 'your_actual_api_secret'
   BASE_URL = 'https://api.mozesms.com'
   SENDER_ID = 'YourBrand'
   ```

4. **Run an example:**
   ```bash
   python send_single_sms.py
   ```

## 📚 Available Examples

### 1. Send Single SMS
**File:** `send_single_sms.py`

```bash
python send_single_sms.py
```

### 2. Send Bulk SMS
**File:** `send_bulk_sms.py`

```bash
python send_bulk_sms.py
```

### 3. Check Balance
**File:** `check_balance.py`

```bash
python check_balance.py
```

### 4. Get SMS History
**File:** `get_history.py`

```bash
python get_history.py
```

### 5. Check SMS Status
**File:** `check_status.py`

```bash
python check_status.py
```

## 💡 Usage Tips

1. **Virtual Environment (Recommended):**
   ```bash
   python -m venv venv
   source venv/bin/activate  # Linux/Mac
   venv\Scripts\activate     # Windows
   pip install -r requirements.txt
   ```

2. **Error Handling:**
   All examples include try-except blocks for robust error handling.

3. **Type Hints:**
   Examples use Python type hints for better code clarity.

## 📖 Documentation

- [API Reference](../../API_REFERENCE.md)
- [Main Documentation](../../README.md)

## 🆘 Support

- Email: support@mozesms.com
- Portal: https://my.mozesms.com
