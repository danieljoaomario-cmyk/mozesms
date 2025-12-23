/**
 * MozeSMS API Configuration
 */

require('dotenv').config();

module.exports = {
    apiKey: process.env.API_KEY,
    apiSecret: process.env.API_SECRET,
    baseUrl: process.env.BASE_URL || 'https://api.mozesms.com',
    senderId: process.env.SENDER_ID || 'MozeSMS',
    timeout: parseInt(process.env.TIMEOUT) || 30000
};
