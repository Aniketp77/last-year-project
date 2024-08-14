<?php
// Function to send GET requests to a specified endpoint
function send_get_request($url) {
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n", // Ensure the right header
            'method'  => 'GET', // Use GET for fetching data
        ],
    ];
    $context = stream_context_create($options);
    return file_get_contents($url, false, $context); // Send the GET request
}

// URL of the /transactions endpoint
$endpoint = 'http://127.0.0.1:5000/transactions'; // Adjust if running on a different host/port

// Send a GET request to retrieve all transactions
$response = send_get_request($endpoint);

if ($response === false) { // If the request fails
    $error = error_get_last(); // Get the last error message
    die("Error: Unable to retrieve data. Details: " . ($error ? $error['message'] : "unknown error")); // Display the error message
}

// Decode the JSON response into a PHP array
$transactions = json_decode($response, true); // Decode JSON to associative array

if (is_null($transactions)) {
    die("Error: Failed to parse the response."); // If decoding fails
}

// Display the transactions
echo "<h2>All Transactions</h2>";
echo "<ul>";

foreach ($transactions['transactions'] as $transaction) {
    echo "<li>";
    echo "Patient ID: " . htmlspecialchars($transaction['patient_id']) . "<br>";
    echo "Sender: " . htmlspecialchars($transaction['sender']) . "<br>";
    echo "Recipient: " . htmlspecialchars($transaction['recipient']) . "<br>";
    echo "Record Type: " . htmlspecialchars($transaction['data']['record_type']) . "<br>";
    echo "Diagnosis: " . htmlspecialchars($transaction['data']['diagnosis']) . "<br>";
    echo "Treatment: " . htmlspecialchars($transaction['data']['treatment']) . "<br>";
    echo "</li>";
}

echo "</ul>";
?>
