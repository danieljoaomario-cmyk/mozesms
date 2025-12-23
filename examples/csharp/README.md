# C# Examples - MozeSMS API

Ready-to-use C# examples for the MozeSMS API.

## 📋 Requirements

- .NET 6.0 or higher
- Visual Studio 2022 or VS Code
- Valid MozeSMS API credentials

## 🚀 Quick Start

1. **Create a new console project:**
   ```bash
   dotnet new console -n MozeSMSExamples
   cd MozeSMSExamples
   ```

2. **Add required packages:**
   ```bash
   dotnet add package Newtonsoft.Json
   ```

3. **Copy example files to your project**

4. **Edit Config.cs with your credentials**

5. **Run an example:**
   ```bash
   dotnet run
   ```

## 📚 Available Examples

- `Config.cs` - Configuration class
- `SendSingleSMS.cs` - Send single SMS
- `SendBulkSMS.cs` - Send bulk SMS
- `CheckBalance.cs` - Check account balance
- `GetHistory.cs` - Get SMS history

## 💡 Features

- Modern C# with async/await
- HttpClient for HTTP requests
- JSON.NET for JSON parsing
- Strong typing with classes
- Comprehensive error handling

## 🔐 Configuration

Edit `Config.cs`:

```csharp
public static class Config
{
    public const string ApiKey = "YOUR_API_KEY";
    public const string ApiSecret = "YOUR_API_SECRET";
    public const string BaseUrl = "https://api.mozesms.com";
    public const string SenderId = "YourBrand";
}
```

## 📖 Documentation

- [API Reference](../../API_REFERENCE.md)
- [Main Documentation](../../README.md)

## 🆘 Support

- Email: support@mozesms.com
- Portal: https://my.mozesms.com
