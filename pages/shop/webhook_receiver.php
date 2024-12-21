<?php

$dataFile = 'webhook_data.json';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);


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
    exit;  
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (file_exists($dataFile)) {

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


    if (isset($_GET['clear_data'])) {

        if (file_exists($dataFile)) {
            unlink($dataFile); 
        }
        echo json_encode([
            'status' => 'success',
            'message' => 'Webhook data cleared.'
        ]);
    }
}
?>
