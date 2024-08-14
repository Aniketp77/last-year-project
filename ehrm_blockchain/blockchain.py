import hashlib
import json
from time import time
from uuid import uuid4
from cryptography.fernet import Fernet

class Blockchain:
    def __init__(self):
        self.chain = []
        self.current_transactions = []

        # Create the genesis block
        self.new_block(previous_hash='1', proof=100)

    def new_block(self, proof, previous_hash=None):
        """
        Create a new Block in the Blockchain
        :param proof: <int> The proof given by the Proof of Work algorithm
        :param previous_hash: (Optional) <str> Hash of previous Block
        :return: <dict> New Block
        """
        block = {
            'index': len(self.chain) + 1,
            'timestamp': time(),
            'transactions': self.current_transactions,
            'proof': proof,
            'previous_hash': previous_hash or self.hash(self.chain[-1]),
        }

        # Reset the current list of transactions
        self.current_transactions = []

        self.chain.append(block)
        return block

    def new_transaction(self, sender, recipient, data, key):
        """
        Creates a new transaction to go into the next mined Block
        :param sender: <str> Address of the Sender
        :param recipient: <str> Address of the Recipient
        :param data: <str> Data to be encrypted and stored
        :param key: <bytes> Key for encryption
        :return: <int> The index of the Block that will hold this transaction
        """
        encrypted_data = self.encrypt_data(data, key)

        self.current_transactions.append({
            'sender': sender,
            'recipient': recipient,
            'data': encrypted_data,
        })

        return self.last_block['index'] + 1  # Return the index of the next block

    @staticmethod
    def hash(block):
        """
        Creates a SHA-256 hash of a Block
        :param block: <dict> Block
        :return: <str>
        """
        block_string = json.dumps(block, sort_keys=True).encode()
        return hashlib.sha256(block_string).hexdigest()

    @property
    def last_block(self):
        return self.chain[-1]

    def proof_of_work(self, last_proof):
        """
        Simple Proof of Work Algorithm:
         - Find a number p' such that hash(pp') contains leading 4 zeroes, where p is the previous proof
         - p is the previous proof, and p' is the new proof
        :param last_proof: <int> Previous Proof
        :return: <int>
        """
        proof = 0
        while self.valid_proof(last_proof, proof) is False:
            proof += 1

        return proof

    @staticmethod
    def valid_proof(last_proof, proof):
        """
        Validates the Proof: Does hash(last_proof, proof) contain 4 leading zeroes?
        :param last_proof: <int> Previous Proof
        :param proof: <int> Current Proof
        :return: <bool> True if correct, False if not.
        """
        guess = f'{last_proof}{proof}'.encode()
        guess_hash = hashlib.sha256(guess).hexdigest()
        return guess_hash[:4] == "0000"

    @staticmethod
    def encrypt_data(data, key):
        """
        Encrypts the data using the provided key
        :param data: <str> Data to be encrypted
        :param key: <bytes> Key for encryption
        :return: <bytes> Encrypted data
        """
        cipher = Fernet(key)
        return cipher.encrypt(data.encode())

    @staticmethod
    def decrypt_data(encrypted_data, key):
        """
        Decrypts the data using the provided key
        :param encrypted_data: <bytes> Encrypted data
        :param key: <bytes> Key for decryption
        :return: <str> Decrypted data
        """
        cipher = Fernet(key)
        return cipher.decrypt(encrypted_data).decode()
