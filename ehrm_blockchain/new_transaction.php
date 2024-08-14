<?php
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
echo "Response from server: " . htmlspecialchars($response); // Ensure safe output with htmlspecialchars
?>
