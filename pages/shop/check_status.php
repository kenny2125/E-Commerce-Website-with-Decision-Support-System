<?php
// webhook_receiver.php
// Payload from PayMongo
$data = json_decode(file_get_contents('php://input'), true);

// Log or validate the webhook
if ($data && $data['data']['attributes']['type'] === 'payment.paid') {
    // Save the event to a database or trigger a flag
    file_put_contents('webhook_status.txt', 'paid'); // Simplified; use a database for production
    http_response_code(200); // Acknowledge the webhook
    echo "Webhook received.";
} else {
    http_response_code(400); // Bad request
    echo "Invalid webhook.";
}
?>