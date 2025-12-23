"""
MozeSMS API - Check Account Balance

Example showing how to check your account balance
"""

import requests
import config

def get_balance() -> dict:
    """
    Get account balance
    
    Returns:
        dict: Response data with balance information
    """
    url = f"{config.BASE_URL}/account/balance"
    
    headers = {
        'Content-Type': 'application/json',
        'X-API-Key': config.API_KEY,
        'X-API-Secret': config.API_SECRET
    }
    
    try:
        response = requests.get(
            url, 
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
    print('Checking account balance...\n')
    
    result = get_balance()
    
    if result['success']:
        print('✅ Balance retrieved successfully!\n')
        balance = result['data']['balance']
        currency = result['data']['currency']
        print(f"Current Balance: {balance} {currency}")
        print(f"SMS Credits: ~{int(balance / 1.35)} messages")
        print(f"Currency: {currency}")
    else:
        print('❌ Failed to get balance')
        error = result.get('error') or result.get('data', {}).get('message', 'Unknown error')
        print(f'Error: {error}')
    
    print('\nFull Response:')
    print(result)
