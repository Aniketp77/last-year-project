from flask import Flask, jsonify, request 
from blockchain import Blockchain
from cryptography.fernet import Fernet

app = Flask(__name__)
blockchain = Blockchain()

# Secure key for encryption
key = Fernet.generate_key()

@app.route('/mine', methods=['GET'])
def mine():
    last_block = blockchain.last_block
    last_proof = last_block['proof']
    proof = blockchain.proof_of_work(last_proof)

    previous_hash = blockchain.hash(last_block)
    block = blockchain.new_block(proof, previous_hash)

    response = {
        'message': "New block forged",
        'index': block['index'],
        'transactions': block['transactions'],
        'proof': block['proof'],
        'previous_hash': previous_hash,
    }
    return jsonify(response), 200
    
    
@app.route('/transactions/new', methods=['POST'])
def new_transaction():
    # Extract JSON data from the POST request
    values = request.get_json()

    if not values:
        return jsonify({'error': 'Invalid or missing JSON data'}), 400

    # Validate required fields in the outer structure
    required = ['patient_id', 'sender', 'recipient', 'data']
    if not all(field in values for field in required):
        return jsonify({'error': 'Missing required fields: patient_id, sender, recipient, data'}), 400

    # Validate the nested 'data' structure
    data_required = ['record_type', 'diagnosis', 'treatment']
    if 'data' not in values or not all(field in values['data'] for field in data_required):
        return jsonify({'error': 'Missing required fields in data: record_type, diagnosis, treatment'}), 400

    try:
        # Replace with your implementation for adding a new transaction
        index = 1  # Example: Transaction index or identifier

        response = {
            'message': f'Transaction will be added to Block {index}'
        }

        return jsonify(response), 201  # Success response

    except Exception as e:
        return jsonify({'error': str(e)}), 400  # Error handling for exceptions

@app.route('/transactions', methods=['GET'])
def get_all_transactions():
    # Return the list of all transactions
    return jsonify({'transactions': transaction_history, 'count': len(transaction_history)}), 200



@app.route('/chain', methods=['GET'])
def full_chain():
    response = {
        'chain': blockchain.chain,
        'length': len(blockchain.chain),
    }
    return jsonify(response), 200


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)  # Run the Flask app
