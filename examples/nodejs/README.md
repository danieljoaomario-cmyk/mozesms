# Node.js Examples - MozeSMS API

Ready-to-use Node.js examples for the MozeSMS API.

## 📋 Requirements

- Node.js 14 or higher
- npm or yarn
- Valid MozeSMS API credentials

## 🚀 Quick Start

1. **Install dependencies:**
   ```bash
   npm install
   ```

2. **Copy configuration file:**
   ```bash
   cp .env.example .env
   ```

3. **Edit .env with your credentials:**
   ```env
   API_KEY=your_actual_api_key
   API_SECRET=your_actual_api_secret
   BASE_URL=https://api.mozesms.com
   SENDER_ID=YourBrand
   ```

4. **Run an example:**
   ```bash
   npm run send
   ```

## 📚 Available Examples

### 1. Send Single SMS
```bash
npm run send
# or
node send_single_sms.js
```

### 2. Send Bulk SMS
```bash
npm run bulk
# or
node send_bulk_sms.js
```

### 3. Check Balance
```bash
npm run balance
# or
node check_balance.js
```

### 4. Get SMS History
```bash
npm run history
# or
node get_history.js
```

### 5. Check SMS Status
```bash
npm run status
# or
node check_status.js
```

## 💡 Usage Tips

1. **ES6 Modules:** Examples use CommonJS, but can be easily converted to ES6 modules
2. **Async/Await:** All examples use modern async/await syntax
3. **Error Handling:** Comprehensive try-catch blocks included
4. **Environment Variables:** Credentials stored securely in .env file

## 🔐 Security

- Never commit your `.env` file
- Use environment variables in production
- Rotate your API credentials regularly

## 📖 Documentation

- [API Reference](../../API_REFERENCE.md)
- [Main Documentation](../../README.md)

## 🆘 Support

- Email: support@mozesms.com
- Portal: https://my.mozesms.com
