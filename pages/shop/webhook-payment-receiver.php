<?php
include '../../config/db_config.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);


file_put_contents('webhook.log', $input . PHP_EOL, FILE_APPEND);

if ($data && isset($data['data']['attributes']['type'])) {

    $eventType = $data['data']['attributes']['type'];

    if ($eventType == 'payment.paid') {

        $paymongoPayID = isset($data['data']['attributes']['data']['id']) && 
                         strpos($data['data']['attributes']['data']['id'], 'pay_') === 0 
                         ? $data['data']['attributes']['data']['id'] 
                         : null;

        if ($paymongoPayID) {

            $attributes = $data['data']['attributes']['data']['attributes'];
            $amount = isset($attributes['amount']) ? $attributes['amount'] / 100 : 0; 
            $fee = isset($attributes['fee']) ? $attributes['fee'] / 100 : 0; 
            $netAmount = isset($attributes['net_amount']) ? $attributes['net_amount'] / 100 : 0;
            $status = isset($attributes['status']) ? strtoupper($attributes['status']) : 'UNKNOWN'; 
            $externalReferenceNumber = isset($attributes['external_reference_number']) ? $attributes['external_reference_number'] : null;
            $sourceType = isset($attributes['source']['type']) ? $attributes['source']['type'] : null;
            $createdAt = isset($attributes['created_at']) ? date('Y-m-d H:i:s', $attributes['created_at']) : null;
            $updatedAt = isset($attributes['updated_at']) ? date('Y-m-d H:i:s', $attributes['updated_at']) : null;
            $customerName = isset($attributes['billing']['name']) ? $attributes['billing']['name'] : null;
            $phone = isset($attributes['billing']['phone']) ? $attributes['billing']['phone'] : null;
            $stmt = $conn->prepare("
                INSERT INTO tbl_payments 
                (paymongo_payment_ID, amount, fee, net_amount, status, external_reference_number, source_type, created_at, updated_at, cust_name, phone) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "sddssssssss",
                $paymongoPayID,
                $amount, 
                $fee, 
                $netAmount, 
                $status, 
                $externalReferenceNumber, 
                $sourceType, 
                $createdAt, 
                $updatedAt,
                $customerName,
                $phone
            );


            if ($stmt->execute()) {
                http_response_code(200); 
                echo "Inserted new payment record successfully (payment.paid).";
            } else {
                file_put_contents('webhook_error.log', "DB Error (Insert): " . $stmt->error . PHP_EOL, FILE_APPEND);
                http_response_code(500);
                echo "Failed to insert new payment record (payment.paid).";
            }

            $stmt->close();
        } else {
            http_response_code(400); 
            echo "No valid payment ID found.";
        }
    } else {

        http_response_code(400);
        echo "Invalid event type.";
    }
} else {
    http_response_code(400); 
    echo "Invalid JSON data.";
}

$conn->close();
?>
