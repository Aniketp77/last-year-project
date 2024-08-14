<?php
// Fetch the response from the mining endpoint
$url = 'http://127.0.0.1:5000/mine';
$response = file_get_contents($url);

// Check if the response is valid
if ($response === FALSE) {
    $response = "Error: Unable to retrieve data.";
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
            <h2> Login</h2>
            <div class="content2">
                <?php echo nl2br(htmlspecialchars($response)); ?> <!-- Display response with safe output -->
            </div>
			<br><br>
			<p>
			<b>NOTE:</b><br>A "Mined Block" refers to a newly created block in a blockchain, typically resulting from the process of mining. In blockchain technology, a block is a collection of data, often transactions or other relevant information, linked to previous blocks to form a chain.
        </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>
