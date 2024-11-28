<?php
// Database connection
$servername = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$dbname = "s0gp0gvxcx3fc7ib";
$port = "3306";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Log incoming request
$input = file_get_contents('php://input'); // Capture raw POST data
$data = json_decode($input, true);

// Save to a file for debugging
file_put_contents('webhook.log', $input . PHP_EOL, FILE_APPEND);

// Check if data contains valid event type
if ($data && isset($data['data']['attributes']['type'])) {
    $eventType = $data['data']['attributes']['type'];

    if ($eventType == 'payment.paid') {
        // Extract the payment details from the 'payment.paid' event
        $attributes = $data['data']['attributes']['data']['attributes'];

        // Extract values with null checks, handling conversions if necessary
        $amount = isset($attributes['amount']) ? $attributes['amount'] / 100 : 0; // Convert amount to decimal
        $fee = isset($attributes['fee']) ? $attributes['fee'] / 100 : 0; // Convert fee to decimal
        $netAmount = isset($attributes['net_amount']) ? $attributes['net_amount'] / 100 : 0;
        $status = isset($attributes['status']) ? strtoupper($attributes['status']) : 'UNKNOWN'; // Convert status to uppercase
        $externalReferenceNumber = isset($attributes['external_reference_number']) ? $attributes['external_reference_number'] : null;
        $sourceType = isset($attributes['source']['type']) ? $attributes['source']['type'] : null;
        $createdAt = isset($attributes['created_at']) ? date('Y-m-d H:i:s', $attributes['created_at']) : null;
        $updatedAt = isset($attributes['updated_at']) ? date('Y-m-d H:i:s', $attributes['updated_at']) : null;

        // Prepare the SQL insert statement
        $stmt = $conn->prepare("
            INSERT INTO tbl_payments 
            (order_ID, paymongo_payment_ID, amount, fee, net_amount, status, external_reference_number, source_type, created_at, updated_at) 
            VALUES 
            (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // Bind parameters
        $stmt->bind_param("sddssssss", 
            $data['data']['id'], // paymongo_payment_ID
            $amount, 
            $fee, 
            $netAmount, 
            $status, 
            $externalReferenceNumber, 
            $sourceType, 
            $createdAt, 
            $updatedAt
        );

        // Execute the insert statement
        if ($stmt->execute()) {
            http_response_code(200); // Success - 200 OK
            echo "Inserted new payment record successfully (payment.paid).";
        } else {
            // Log error if insert fails
            file_put_contents('webhook_error.log', "DB Error (Insert): " . $stmt->error . PHP_EOL, FILE_APPEND);
            http_response_code(500); // Internal server error
            echo "Failed to insert new payment record (payment.paid).";
        }
    } else {
        // Invalid event type, log and respond
        http_response_code(400); // Bad Request
        echo "Invalid event type.";
    }
} else {
    // Invalid or missing data, log and respond
    http_response_code(400); // Bad Request
    echo "Invalid JSON data.";
}

// Close the database connection
$conn->close();
?>
