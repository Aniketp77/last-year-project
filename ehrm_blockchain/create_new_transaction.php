<?php

$url = 'http://127.0.0.1:5000/transactions/new';
$data = array(
    'patient_id' => 1,
    'data' => array(
        'record_type' => 'medical',
        'diagnosis' => 'example diagnosis',
        'treatment' => 'example treatment'
    )
);

$options = array(
    'http' => array(
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === false) {
    // Handle error
    echo "Error: Unable to send request.";
} else {
    // Output response
    echo $result;
}

?>