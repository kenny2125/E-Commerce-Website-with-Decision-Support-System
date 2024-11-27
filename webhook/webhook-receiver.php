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

if ($data && isset($data['data']['attributes']['data']['attributes'])) {
    // Extract data from JSON payload
    $attributes = $data['data']['attributes']['data']['attributes'];

    $amount = isset($attributes['amount']) ? $attributes['amount'] / 100 : 0; // Convert amount to decimal (in PHP)
    $fee = isset($attributes['fee']) ? $attributes['fee'] / 100 : 0; // Convert fee to decimal (in PHP)
    $netAmount = isset($attributes['net_amount']) ? $attributes['net_amount'] / 100 : 0;
    $status = isset($attributes['status']) ? strtoupper($attributes['status']) : 'UNKNOWN'; // Convert status to uppercase
    $externalReferenceNumber = isset($attributes['external_reference_number']) ? $attributes['external_reference_number'] : null;
    $sourceType = isset($attributes['source']['type']) ? $attributes['source']['type'] : null;
    $createdAt = isset($attributes['created_at']) ? date('Y-m-d H:i:s', $attributes['created_at']) : null;
    $paidAt = isset($attributes['paid_at']) ? date('Y-m-d H:i:s', $attributes['paid_at']) : null;
    $updatedAt = isset($attributes['updated_at']) ? date('Y-m-d H:i:s', $attributes['updated_at']) : null;

    // Prepare the SQL statement to insert or update the payment
    if ($status == 'PAID') {
        $stmt = $conn->prepare("
            INSERT INTO tbl_payments 
            (order_ID, paymongo_payment_ID, amount, fee, net_amount, status, external_reference_number, source_type, created_at, paid_at, updated_at) 
            VALUES 
            (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->bind_param("sddsssssss", 
            $data['data']['id'], // paymongo_payment_ID
            $amount, 
            $fee, 
            $netAmount, 
            $status, 
            $externalReferenceNumber, 
            $sourceType, 
            $createdAt, 
            $paidAt, 
            $updatedAt
        );
    } else if ($status == 'REFUND') {
        $stmt = $conn->prepare("
            UPDATE tbl_payments
            SET status = ?, fee = ?, net_amount = ?, updated_at = ?
            WHERE paymongo_payment_ID = ?
        ");
        
        $stmt->bind_param("sdsss", 
            $status, 
            $fee, 
            $netAmount, 
            $updatedAt, 
            $data['data']['id'] // paymongo_payment_ID (for refund)
        );
    }

    // Execute the statement
    if (isset($stmt)) {
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
        file_put_contents('webhook_error.log', "Error preparing statement." . PHP_EOL, FILE_APPEND);
        http_response_code(500); // Internal server error
        echo "Failed to prepare the SQL statement.";
    }
} else {
    http_response_code(400); // Bad request
    echo "Invalid data.";
}

$conn->close();
?>
