
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Enabled Healthcare Data Exchange</title>
    <link rel="stylesheet" href="style.css"> <!-- Including external CSS -->
    
</head>
<body>
    <header>
        <h1>Blockchain Enabled Healthcare Data Exchange</h1>
    </header>
    <div class="container">
        <?php include_once('healthcare_nav.php'); ?>
        <div class="content">
    <h1>Data Security in Blockchain</h1>
    <p>This page demonstrates how the data is secured in the blockchain.</p>
    <p>Blockchain secures data through the use of cryptographic techniques such as hashing and digital signatures:</p>
    <ul>
        <li><strong>Hashing:</strong> Each block in the blockchain contains a cryptographic hash of the previous block's header. This creates a chain of blocks, where each block is linked to its previous block, forming an immutable record of transactions.</li>
        <li><strong>Digital Signatures:</strong> Transactions are digitally signed by the sender using their private key. This ensures the authenticity and integrity of the transaction data, as any alteration to the data would invalidate the signature.</li>
        <li><strong>Consensus Mechanisms:</strong> Blockchain networks use consensus mechanisms such as Proof of Work (PoW) or Proof of Stake (PoS) to validate and confirm transactions. This decentralized consensus ensures that only valid transactions are added to the blockchain.</li>
        <li><strong>Distributed Ledger:</strong> The blockchain is maintained by a network of nodes, each storing a copy of the entire blockchain. This distributed ledger ensures that there is no single point of failure and prevents tampering with the data.</li>
    </ul>
    <p>Overall, blockchain technology provides a high level of security and trust in the integrity of data stored on the blockchain.</p>

<br><br>
			       </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>
