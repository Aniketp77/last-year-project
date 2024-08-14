<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Data Records</title>
</head>
<body>
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
        } else {
            echo "No records found for patient ID: $patient_id";
        }

        // Fetch blockchain data
        $url = "http://your-blockchain-api-endpoint/decrypt/$patient_id";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            $blockchain_data = json_decode($response, true);

            if (isset($blockchain_data['transactions'])) {
                echo "<h2>Encrypted Blockchain Data</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>Patient ID</th>
                            <th>Sender</th>
                            <th>Recipient</th>
                            <th>Data (Encrypted)</th>
                        </tr>";

                foreach ($blockchain_data['transactions'] as $transaction) {
                    echo "<tr>
                            <td>{$transaction['patient_id']}</td>
                            <td>{$transaction['sender']}</td>
                            <td>{$transaction['recipient']}</td>
                            <td>{$transaction['data']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No blockchain records found for patient ID: $patient_id";
            }
        }

        curl_close($ch);

        // Close the database connection
        $con->close();
    }
    ?>
</body>
</html>
