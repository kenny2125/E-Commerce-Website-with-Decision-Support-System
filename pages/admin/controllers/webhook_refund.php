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
file_put_contents('webhook_refund.log', $input . PHP_EOL, FILE_APPEND);

if ($data && isset($data['data']['attributes']['type'])) {
    // Extract the "type" to determine the event type
    $eventType = $data['data']['attributes']['type'];

    if ($eventType == 'payment.refunded') {
        // Extract the refund ID and payment ID from the PayMongo webhook payload
        $refundID = $data['data']['id'] ?? null;
        $paymentID = $data['data']['attributes']['payment_id'] ?? null;

        if ($refundID && $paymentID) {
            // Update the payment status in the database to "REFUND"
            $stmt = $conn->prepare("
                UPDATE tbl_payments 
                SET status = 'REFUND'
                WHERE paymongo_payment_ID = ?
            ");

            $stmt->bind_param("s", $paymentID);

            // Execute the update statement
            if ($stmt->execute() && $stmt->affected_rows > 0) {
                http_response_code(200); // Success - 200 OK
                echo "Payment status updated to REFUND successfully.";
            } else {
                file_put_contents('webhook_refund_error.log', "DB Error (Update): " . $stmt->error . PHP_EOL, FILE_APPEND);
                http_response_code(500); // Internal server error
                echo "Failed to update payment status to REFUND.";
            }

            $stmt->close();
        } else {
            http_response_code(400); // Bad Request
            echo "No valid refund ID or payment ID found.";
        }
    } else {
        // Invalid event type
        http_response_code(400); // Bad Request
        echo "Invalid event type.";
    }
} else {
    // Invalid or missing data
    http_response_code(400); // Bad Request
    echo "Invalid JSON data.";
}

$conn->close();
?>
