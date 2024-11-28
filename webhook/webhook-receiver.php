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

if ($data && isset($data['data']['attributes']['type'])) {
    // Extract the "type" which tells us if the payment is paid or refunded
    $eventType = $data['data']['attributes']['type'];
    
    // Extract other payment details
    $attributes = $data['data']['attributes']['data']['attributes'];
    $amount = isset($attributes['amount']) ? $attributes['amount'] / 100 : 0; // Convert amount to decimal
    $fee = isset($attributes['fee']) ? $attributes['fee'] / 100 : 0; // Convert fee to decimal
    $netAmount = isset($attributes['net_amount']) ? $attributes['net_amount'] / 100 : 0;
    $status = isset($attributes['status']) ? strtoupper($attributes['status']) : 'UNKNOWN'; // Convert status to uppercase
    $externalReferenceNumber = isset($attributes['external_reference_number']) ? $attributes['external_reference_number'] : null;
    $sourceType = isset($attributes['source']['type']) ? $attributes['source']['type'] : null;
    $createdAt = isset($attributes['created_at']) ? date('Y-m-d H:i:s', $attributes['created_at']) : null;
    $paidAt = isset($attributes['paid_at']) ? date('Y-m-d H:i:s', $attributes['paid_at']) : null;
    $updatedAt = isset($attributes['updated_at']) ? date('Y-m-d H:i:s', $attributes['updated_at']) : null;

    // Check if the event type is paid or refunded
    if ($eventType == 'payment.paid') {
        // Insert new payment record if the event type is "payment.paid"
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
        
        // Execute the insert statement
        if ($stmt->execute()) {
            http_response_code(200); // Success - 200 OK
            echo "Inserted payment record successfully.";
        } else {
            file_put_contents('webhook_error.log', "DB Error (Insert): " . $stmt->error . PHP_EOL, FILE_APPEND);
            http_response_code(500); // Internal server error
            echo "Failed to insert payment record.";
        }
    } else if ($eventType == 'payment.refunded' || $eventType == 'payment.refund.updated') {
        // Scan database for existing record by external_reference_number
        $stmt = $conn->prepare("SELECT * FROM tbl_payments WHERE external_reference_number = ?");
        $stmt->bind_param("s", $externalReferenceNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // If record exists, update it
            $stmt = $conn->prepare("
                UPDATE tbl_payments
                SET status = ?, fee = ?, net_amount = ?, updated_at = ?
                WHERE external_reference_number = ?
            ");
            
            $stmt->bind_param("sdsss", 
                $status, 
                $fee, 
                $netAmount, 
                $updatedAt, 
                $externalReferenceNumber
            );
            
            // Execute the update statement
            if ($stmt->execute()) {
                http_response_code(200); // Success - 200 OK
                echo "Updated payment record successfully.";
            } else {
                file_put_contents('webhook_error.log', "DB Error (Update): " . $stmt->error . PHP_EOL, FILE_APPEND);
                http_response_code(500); // Internal server error
                echo "Failed to update payment record.";
            }
        } else {
            // If no record exists, insert new one
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
            
            // Execute the insert statement if no record was found
            if ($stmt->execute()) {
                http_response_code(200); // Success - 200 OK
                echo "Inserted new payment record successfully (no previous record found).";
            } else {
                file_put_contents('webhook_error.log', "DB Error (Insert - No Record): " . $stmt->error . PHP_EOL, FILE_APPEND);
                http_response_code(500); // Internal server error
                echo "Failed to insert new payment record.";
            }
        }
    } else {
        // If the event type is something else, we log an error
        file_put_contents('webhook_error.log', "Unexpected event type: " . $eventType . PHP_EOL, FILE_APPEND);
        http_response_code(400); // Bad request
        echo "Invalid event type.";
        exit();
    }
} else {
    http_response_code(400); // Bad request
    echo "Invalid data.";
}

$conn->close();
?>
