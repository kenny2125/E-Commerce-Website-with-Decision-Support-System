<?php
// Include database connection
include '../../config/db_config.php';

// Fetch payment details from the database
$payment_ID = $_POST['payment_ID']; // Assume the Payment ID is passed via POST

$sql = "SELECT amount, paymongo_payment_ID FROM tbl_payments WHERE payment_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the payment details
    $payment = $result->fetch_assoc();
    $amount = $payment['amount'] * 100; // Convert to centavos if required by PayMongo
    $paymongo_payment_ID = $payment['paymongo_payment_ID'];
} else {
    echo "No payment found for the given Payment ID.";
    exit;
}

// Close database connection
$stmt->close();
$conn->close();

// Initialize cURL for refund request
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paymongo.com/refunds",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'data' => [
            'attributes' => [
                'amount' => $amount,
                'payment_id' => $paymongo_payment_ID,
                'reason' => 'requested_by_customer'
            ]
        ]
    ]),
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Basic c2tfdGVzdF90dGdxaGQ5RUFEQWFOS1NZSHdHWHZXd3M6",
        "content-type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

// Check for errors and display refund status
if ($err) {
    echo "Refund Failed: cURL Error #:" . $err;
} else {
    $response_data = json_decode($response, true);

    if (isset($response_data['data'])) {
        echo "Refund Successful! Refund ID: " . $response_data['data']['id'];
    } elseif (isset($response_data['errors'])) {
        echo "Refund Failed: " . $response_data['errors'][0]['detail'];
    } else {
        echo "Unexpected response: " . $response;
    }
}
?>