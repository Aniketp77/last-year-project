<?php
include('../includes/dbconnection.php');
// Validate that required fields are provided and not empty
$required_fields = ['patient_id', 'sender', 'recipient', 'record_type', 'diagnosis', 'treatment'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        die("Error: Missing or empty $field."); // Error if any required field is missing
    }
}

// Prepare the data for the POST request
$data = array(
    'patient_id' => $_POST['patient_id'],
    'sender' => $_POST['sender'],
    'recipient' => $_POST['recipient'],
    'data' => array(
        'record_type' => $_POST['record_type'],
        'diagnosis' => $_POST['diagnosis'],
        'treatment' => $_POST['treatment'],
    )
);


// Define HTTP options with appropriate headers and JSON-encoded content
$options = array(
    'http' => array(
        'header' => "Content-Type: application/json\r\n", // Correct Content-Type
        'method' => 'POST',
        'content' => json_encode($data), // JSON-encode the data
        'timeout' => 10, // Optional timeout for robustness
    ),
);

// Create the stream context and send the POST request
$context = stream_context_create($options);
$response = @file_get_contents('http://127.0.0.1:5000/transactions/new', false, $context); // Use "@" to suppress direct PHP errors

if ($response === false) {
    // Check the last PHP error
    $error = error_get_last();
    die("Error: Unable to send POST request. Details: " . ($error ? $error['message'] : "unknown error")); // Detailed error message
}



// Display the response
$trans_status = "Response from server: " . $response; // Ensure safe output with htmlspecialchars


// Convert the data array to JSON
$json_data = json_encode($data);

// Insert the data into the 'trans' table
$patient_id = $_POST['patient_id'];
$sender = $_POST['sender'];
$recipient = $_POST['recipient'];
$record_type = $_POST['record_type'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];

$sql = "INSERT INTO trans (patient_id, sender, recipient, record_type, diagnosis, treatment)
VALUES ('$patient_id', '$sender', '$recipient', '$record_type', '$diagnosis', '$treatment')";

if ($con->query($sql) === TRUE) {
    //echo "New record created successfully in trans table.";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
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
            <h2>Transaction Block Status</h2>
            <div class="content2">
                <?php echo nl2br(htmlspecialchars($trans_status)); ?> <!-- Display response with safe output -->
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