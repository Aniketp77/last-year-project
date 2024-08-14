<?php
// Start a session to manage user authentication
session_start();

// Database connection
// Replace with your own database connection details
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // Ensure your database password is secure
$db_name = 'ehr'; // Your database name

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the submitted username and password from the POST request
$username = $_POST['uname'];
$password = $_POST['pswd'];

// Query the database to find a user with the provided username and password
$sql = "SELECT * FROM users WHERE uname = ? AND pswd = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password); // Bind the parameters to the query
$stmt->execute();
$result = $stmt->get_result(); // Execute the query and get the result

// Check if a user with the provided username and password exists
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc(); // Fetch the user data

    // Start a session for the user
    $_SESSION['user_id'] = $user['id']; // Store the user ID in the session
    $_SESSION['username'] = $user['uname']; // Store the username in the session

    // Redirect to a protected page or dashboard
    header("Location: dashboard.php");
    exit(); // Exit after redirection
} else {
    // Authentication failed
    echo "Invalid username or password. Please try again.";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
