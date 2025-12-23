"""
MozeSMS API - Send Bulk SMS

Example showing how to send SMS to multiple recipients
"""

import requests
import config

def send_bulk_sms(messages: list) -> dict:
    """
    Send bulk SMS to multiple recipients
    
    Args:
        messages: List of message dicts with phone, message, and optional sender_id
        
    Returns:
        dict: Response data with success status
    """
    url = f"{config.BASE_URL}/sms/bulk"
    
    headers = {
        'Content-Type': 'application/json',
        'X-API-Key': config.API_KEY,
        'X-API-Secret': config.API_SECRET
    }
    
    data = {'messages': messages}
    
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
    # Example usage - Send to multiple recipients
    messages = [
        {
            'phone': '258840000001',
            'message': 'Olá João! Promoção especial: 20% de desconto hoje!',
            'sender_id': config.SENDER_ID
        },
        {
            'phone': '258840000002',
            'message': 'Olá Maria! Não perca nossa oferta exclusiva.',
            'sender_id': config.SENDER_ID
        },
        {
            'phone': '258840000003',
            'message': 'Olá Carlos! Visite nossa loja hoje e ganhe brindes.',
            'sender_id': config.SENDER_ID
        }
    ]
    
    print('Sending Bulk SMS...')
    print(f'Total messages: {len(messages)}\n')
    
    result = send_bulk_sms(messages)
    
    if result['success']:
        print('✅ Bulk SMS sent successfully!')
        print(f"Total sent: {result['data']['total']}")
        print(f"Successful: {result['data']['sent']}")
        print(f"Failed: {result['data']['failed']}\n")
        
        if result['data'].get('results'):
            print('Individual results:')
            for idx, res in enumerate(result['data']['results'], 1):
                print(f"  [{idx}] Phone: {res['phone']} - ", end='')
                print(f"Status: {res['status']} - ", end='')
                print(f"ID: {res.get('message_id', 'N/A')}")
    else:
        print('❌ Failed to send bulk SMS')
        error = result.get('error') or result.get('data', {}).get('message', 'Unknown error')
        print(f'Error: {error}')
    
    print('\nFull Response:')
    print(result)
