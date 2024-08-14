<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Enabled Healthcare Data Exchange</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Blockchain Enabled Healthcare Data Exchange</h1>
    </header>
    <div class="container">
        <?php include_once('healthcare_nav.php');?>
        <div class="content">
            <!-- Your main content goes here -->
            <h2>Welcome to <span style="color: #007bff;">HealthCare Hub</span></h2>
			
<p><b>			
Application Functionality</b>
<ul>
<li>Endpoint /mine: This endpoint mines a new block in the blockchain. It uses a proof-of-work algorithm to find a valid proof, then creates a new block with the given proof and previous hash. The response returns the details of the new block.
<li>Endpoint /transactions/new: This endpoint allows you to add a new transaction to the blockchain. It validates the incoming data to ensure required fields are present. If successful, it returns a success response with the block index where the transaction will be added.
<li>Endpoint /chain: This endpoint retrieves the entire blockchain. It provides a response with the full chain and its length.
</ul>
<p><b>General Algorithm Flow</b>
<ul>
<li>Mining a Block:
The /mine endpoint initiates mining, which involves finding a valid proof and creating a new block. The block is added to the blockchain with the proof and previous hash.
<li>Creating a Transaction:
The /transactions/new endpoint validates incoming POST data, ensuring all required fields are present. If successful, it creates a new transaction to be added to a block.
<li>Viewing the Blockchain:
The /chain endpoint returns the entire blockchain, providing a way to inspect the current state of the chain.
</ul>


    
        </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>
