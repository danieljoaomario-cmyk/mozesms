"""
MozeSMS API - Send Single SMS

Example showing how to send a single SMS message
"""

import requests
import config

def send_sms(phone: str, message: str, sender_id: str = None) -> dict:
    """
    Send a single SMS message
    
    Args:
        phone: Recipient phone number (258XXXXXXXXX format)
        message: Message content
        sender_id: Optional sender ID
        
    Returns:
        dict: Response data with success status
    """
    url = f"{config.BASE_URL}/v2/sms/send"
    
    headers = {
        'Content-Type': 'application/json',
        'X-API-Key': config.API_KEY,
        'X-API-Secret': config.API_SECRET
    }
    
    data = {
        'phone': phone,
        'message': message
    }
    
    if sender_id:
        data['sender_id'] = sender_id
    
    try:
        response = requests.post(
            url, 
            json=data, 
            headers=headers,
            timeout=(config.CONNECT_TIMEOUT, config.TIMEOUT)
        )
        
        return {
            'success': response.status_code == 200,
            'http_code': response.status_code,
            'data': response.json()
        }
        
    except requests.exceptions.RequestException as e:
        return {
            'success': False,
            'error': str(e)
        }

if __name__ == '__main__':
    # Example usage
    phone = '258840000000'  # Replace with recipient's phone number
    message = 'Olá! Esta é uma mensagem de teste do MozeSMS API.'
    sender_id = config.SENDER_ID
    
    print('Sending SMS...')
    print(f'Phone: {phone}')
    print(f'Message: {message}\n')
    
    result = send_sms(phone, message, sender_id)
    
    if result['success']:
        print('✅ SMS sent successfully!')
        print(f"Message ID: {result['data']['message_id']}")
        print(f"Status: {result['data']['status']}")
    else:
        print('❌ Failed to send SMS')
        error = result.get('error') or result.get('data', {}).get('message', 'Unknown error')
        print(f'Error: {error}')
    
    print('\nFull Response:')
    print(result)
