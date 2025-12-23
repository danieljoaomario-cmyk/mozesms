/**
 * MozeSMS API - Send Single SMS
 * 
 * Example showing how to send a single SMS message
 */

const axios = require('axios');
const config = require('./config');

/**
 * Send a single SMS message
 */
async function sendSMS(phone, message, senderId = null) {
    const url = `${config.baseUrl}/v2/sms/send`;
    
    const data = {
        phone,
        message
    };
    
    if (senderId) {
        data.sender_id = senderId;
    }
    
    try {
        const response = await axios.post(url, data, {
            headers: {
                'Content-Type': 'application/json',
                'X-API-Key': config.apiKey,
                'X-API-Secret': config.apiSecret
            },
            timeout: config.timeout
        });
        
        return {
            success: true,
            httpCode: response.status,
            data: response.data
        };
        
    } catch (error) {
        return {
            success: false,
            httpCode: error.response?.status,
            error: error.response?.data?.message || error.message,
            data: error.response?.data
        };
    }
}

// Example usage
async function main() {
    const phone = '258840000000'; // Replace with recipient's phone number
    const message = 'Olá! Esta é uma mensagem de teste do MozeSMS API.';
    const senderId = config.senderId;
    
    console.log('Sending SMS...');
    console.log(`Phone: ${phone}`);
    console.log(`Message: ${message}\n`);
    
    const result = await sendSMS(phone, message, senderId);
    
    if (result.success) {
        console.log('✅ SMS sent successfully!');
        console.log(`Message ID: ${result.data.message_id}`);
        console.log(`Status: ${result.data.status}`);
    } else {
        console.log('❌ Failed to send SMS');
        console.log(`Error: ${result.error}`);
    }
    
    console.log('\nFull Response:');
    console.log(result);
}

// Run if called directly
if (require.main === module) {
    main().catch(console.error);
}

module.exports = { sendSMS };
