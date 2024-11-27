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

if ($data && isset($data['data']['attributes'])) {
    // Extract data from JSON payload
    $eventId = $data['data']['id'];
    $eventType = $data['data']['type'];
    $attributes = $data['data']['attributes'];
    
    $amount = $attributes['amount'] / 100; // Assuming amount is in cents, divide by 100 for decimal format
    $fee = isset($attributes['fee']) ? $attributes['fee'] / 100 : null; // Check if fee exists
    $netAmount = $amount - $fee;
    $status = $attributes['status'];
    $externalReferenceNumber = isset($attributes['external_reference_number']) ? $attributes['external_reference_number'] : null;
    $sourceType = isset($attributes['source_type']) ? $attributes['source_type'] : null;
    $createdAt = date('Y-m-d H:i:s', $attributes['created_at']); // Convert Unix timestamp to MySQL format
    $paidAt = isset($attributes['paid_at']) ? date('Y-m-d H:i:s', $attributes['paid_at']) : null;
    $updatedAt = isset($attributes['updated_at']) ? date('Y-m-d H:i:s', $attributes['updated_at']) : null;

    // Insert data into tbl_payments (order_ID set to 0 for now)
    $stmt = $conn->prepare("
        INSERT INTO tbl_payments 
        (order_ID, paymongo_payment_ID, amount, fee, net_amount, status, external_reference_number, source_type, created_at, paid_at, updated_at) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $orderId = 0; // Default order ID as 0

    $stmt->bind_param("issddssssss", $orderId, $eventId, $amount, $fee, $netAmount, $status, $externalReferenceNumber, $sourceType, $createdAt, $paidAt, $updatedAt);

    if ($stmt->execute()) {
        http_response_code(200); // Acknowledge receipt
        echo "Webhook received and stored.";
    } else {
        file_put_contents('webhook_error.log', "DB Error: " . $stmt->error . PHP_EOL, FILE_APPEND);
        http_response_code(500); // Internal server error
        echo "Failed to store webhook data.";
    }

    $stmt->close();
} else {
    http_response_code(400); // Bad request
    echo "Invalid data.";
}

$conn->close();
?>
