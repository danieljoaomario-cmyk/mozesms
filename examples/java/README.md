# Java Examples - MozeSMS API

Ready-to-use Java examples for the MozeSMS API.

## 📋 Requirements

- Java 11 or higher
- Maven or Gradle
- Valid MozeSMS API credentials

## 🚀 Quick Start

### Using Maven

1. **Add dependencies to pom.xml:**
   ```xml
   <dependencies>
       <dependency>
           <groupId>com.squareup.okhttp3</groupId>
           <artifactId>okhttp</artifactId>
           <version>4.12.0</version>
       </dependency>
       <dependency>
           <groupId>com.google.code.gson</groupId>
           <artifactId>gson</artifactId>
           <version>2.10.1</version>
       </dependency>
   </dependencies>
   ```

2. **Edit Config.java with your credentials**

3. **Compile and run:**
   ```bash
   mvn clean compile
   mvn exec:java -Dexec.mainClass="SendSingleSMS"
   ```

### Using Gradle

1. **Add dependencies to build.gradle:**
   ```gradle
   dependencies {
       implementation 'com.squareup.okhttp3:okhttp:4.12.0'
       implementation 'com.google.code.gson:gson:2.10.1'
   }
   ```

2. **Run:**
   ```bash
   gradle run
   ```

## 📚 Available Examples

- `Config.java` - Configuration class
- `SendSingleSMS.java` - Send single SMS
- `SendBulkSMS.java` - Send bulk SMS
- `CheckBalance.java` - Check account balance
- `GetHistory.java` - Get SMS history

## 💡 Features

- Type-safe with Java classes
- OkHttp for HTTP requests
- Gson for JSON parsing
- Comprehensive error handling
- Builder pattern for requests

## 📖 Documentation

- [API Reference](../../API_REFERENCE.md)
- [Main Documentation](../../README.md)

## 🆘 Support

- Email: support@mozesms.com
- Portal: https://my.mozesms.com
