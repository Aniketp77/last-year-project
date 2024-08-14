<?php
// Fetch the blockchain data from the server endpoint
$url = 'http://127.0.0.1:5000/chain';
$response = file_get_contents($url); // Retrieve the response from the endpoint
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Enabled Healthcare Data Exchange</title>
    <link rel="stylesheet" href="style.css"> <!-- Include the CSS for styling -->
</head>
<body>
    <header>
        <h1>Blockchain Enabled Healthcare Data Exchange</h1> <!-- Page title -->
    </header>

    

    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p> <!-- Footer with copyright notice -->
    </footer>
</body>
</html>
