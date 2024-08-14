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
    <link rel="stylesheet" href="style.css"> <!-- Including external CSS -->
    
</head>
<body>
    <header>
        <h1>Blockchain Enabled Healthcare Data Exchange</h1>
    </header>
    <div class="container">
        <?php include_once('healthcare_nav.php'); ?>
        <div class="content">
    <h1>Decrypt & Verify Blockchain </h1>
    
	
	<h1>Patient Data Records</h1>
    <form method="GET" action="">
        <label for="patient_id">Enter Patient ID:</label>
        <input type="text" id="patient_id" name="patient_id" required>
        <button type="submit">Submit</button>
    </form>

    <?php
	include('../includes/dbconnection.php');
    if (isset($_GET['patient_id'])) {
        
        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $patient_id = $_GET['patient_id'];

        // Fetch data from trans table
        $sql = "SELECT * FROM trans WHERE patient_id = '$patient_id'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Patient Records from 'trans' Table</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Patient ID</th>
                        <th>Sender</th>
                        <th>Recipient</th>
                        <th>Record Type</th>
                        <th>Diagnosis</th>
                        <th>Treatment</th>
                        <th>Created At</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['patient_id']}</td>
                        <td>{$row['sender']}</td>
                        <td>{$row['recipient']}</td>
                        <td>{$row['record_type']}</td>
                        <td>{$row['diagnosis']}</td>
                        <td>{$row['treatment']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
            echo "</table>";
			?>
			<br><br><br>
			<div class="container"> <!-- Main container for the content -->
        <?php include_once('healthcare_nav.php'); ?> <!-- Include the navigation bar -->
		<p>
        <h2>The Block Chain</h2><!-- Section heading -->

        <div class="content2"> <!-- Content container -->
            <?php echo htmlspecialchars($response); ?> <!-- Display the response safely -->
        </div>
    </div>
	
	<?php 
        } else {
            echo "No records found for patient ID: $patient_id";
        }

       
    }
    ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<br><br>
			       </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>
