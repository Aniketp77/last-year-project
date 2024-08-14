<?php
$url = 'http://127.0.0.1:5000/chain'; // Endpoint to fetch blockchain data

$options = array(
    'http' => array(
        'method' => 'GET',
        'header' => "Content-type: application/json\r\n" // HTTP headers
    )
);

$context = stream_context_create($options); // Create context for HTTP request
$response = @file_get_contents($url, false, $context); // Fetch blockchain data

if ($response === FALSE) {
    // Capture error details and provide a detailed error message
    $error_info = error_get_last();
    echo "Error: Unable to retrieve data. Details: " . json_encode($error_info);
} else {
    // Display the raw JSON response for debugging
   // echo "Raw JSON Response:\n" . $response . "\n";

    // Decode the JSON response
    $response_data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding JSON data: " . json_last_error_msg();
    } else {
        $Block =  "Blockchain length: " . $response_data['length'] . "\n";

        
    }
}



?>

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
            <h2>Blockchain</h2>
            <div class="content2">
                <?php echo $Block. " blocks<br><br>"; echo nl2br(htmlspecialchars($response));

				?> <!-- Display response with safe output -->
				
				<p><br><br>
				<p><b>Common Blockchain Components</b>
<p><b>Block:</b>
A block is a data structure containing a set of transactions, a proof of work, a hash of the previous block, and additional metadata. Blocks are chained together to form the blockchain.
<p><b>Transactions:</b>
Transactions represent individual operations recorded in the blockchain, typically involving a transfer of assets, data, or other digital information.
<p><b>Proof of Work:</b>
The proof of work is a mathematical problem that must be solved to add a new block to the blockchain. It's used to maintain consensus and ensure the security of the blockchain.
<p><b>Previous Hash:</b>
The previous hash is the cryptographic hash of the preceding block. This links blocks together and ensures the immutability of the blockchain.
<p><b>Blockchain Metadata:</b>
Metadata can include the length of the blockchain, timestamps, and other relevant information about the blockchain's structure and integrity.
            </div>
			<br><br>
			       </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>
