<?php

// Path to store the temporary webhook data
$dataFile = 'webhook_data.json';

// Handle the POST request from the webhook receiver
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the incoming JSON data from the webhook
    $data = json_decode(file_get_contents("php://input"), true);

    // If the data is received, store it in a temporary file
    if ($data) {
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode([
            'status' => 'success',
            'message' => 'Webhook received successfully!',
            'payload' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No data received.'
        ]);
    }
    exit;  // End script after processing POST request
}

// Handle the GET request to retrieve the webhook data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the temporary file exists and contains data
    if (file_exists($dataFile)) {
        // Read the data from the file and return it
        $storedData = file_get_contents($dataFile);
        echo json_encode([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'payload' => json_decode($storedData, true)
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No new data available.'
        ]);
    }

    // If the request is to clear the webhook data
    if (isset($_GET['clear_data'])) {
        // Clear the temporary file
        if (file_exists($dataFile)) {
            unlink($dataFile);  // Delete the file
        }
        echo json_encode([
            'status' => 'success',
            'message' => 'Webhook data cleared.'
        ]);
    }
}
?>
