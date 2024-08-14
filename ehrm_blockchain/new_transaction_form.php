<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blockchain Enabled Healthcare Data Exchange</title>
    <link rel="stylesheet" href="style.css"> <!-- Include external CSS -->
    
    <style>
    .form-container {
        max-width: 600px; /* Set maximum width for the form */
        margin: 0 auto; /* Center the form horizontally */
        padding: 20px; /* Add padding inside the form container */
        border: 1px solid #ccc; /* Light border for the form */
        border-radius: 10px; /* Rounded corners */
        background: white; /* White background for the form */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1); /* Light shadow */
    }

    .form-container label {
        display: block; /* Make label a block element for better alignment */
        font-weight: bold; /* Bold labels for better readability */
        margin-bottom: 5px; /* Spacing below labels */
    }

    .form-container input[type="text"] {
        width: 100%; /* Full width for text inputs */
        padding: 10px; /* Padding inside input fields */
        border: 1px solid #ccc; /* Light border */
        border-radius: 5px; /* Rounded corners for inputs */
    }

    .form-container input[type="submit"] {
        background: #4CAF50; /* Green background */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for the button */
        border: none; /* No border */
        border-radius: 5px; /* Rounded corners for the button */
        cursor: pointer; /* Change cursor on hover */
    }

    .form-container input[type="submit"]:hover {
        background: #45a049; /* Darker shade on hover */
    }
    </style>
</head>
<body>
    <header>
        <h1>Blockchain Enabled Healthcare Data Exchange</h1>
    </header>
    <div class="container">
        <?php include_once('healthcare_nav.php'); ?>
        <div class="content">
            <h2>Blockchain Transaction:</h2>
            <div class="form-container">
                <h1>Create New Transaction</h1>
               
			  <form action="newTrans.php" method="post">
    <label for="patient_id">Patient ID:</label>
    <input type="text" id="patient_id" name="patient_id" required><br><br>

    <label for="sender">Sender:</label>
    <input type="text" id="sender" name="sender" required><br><br>

    <label for="recipient">Recipient:</label>
    <input type="text" id="recipient" name="recipient" required><br><br>

    <label for="record_type">Record Type:</label>
    <input type="text" id="record_type" name="record_type" required><br><br>

    <label for "diagnosis">Diagnosis:</label>
    <input type="text" id="diagnosis" name="diagnosis" required><br><br>

    <label for="treatment">Treatment:</label>
    <input type="text" id="treatment" name="treatment" required><br><br>

    <input type="submit" value="Submit">
</form>




            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 HealthCare Hub. All rights reserved.</p>
    </footer>
</body>
</html>