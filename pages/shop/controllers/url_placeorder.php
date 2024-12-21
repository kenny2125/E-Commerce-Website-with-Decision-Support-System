<?php
session_start();

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;

require __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

include '../../../config/db_config.php';

if ($isLoggedIn && $userId) {
    $sql = "SELECT first_name, middle_initial, last_name, contact_number, address FROM tbl_user WHERE user_ID = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $first_name = $user['first_name'];
        $middle_initial = $user['middle_initial'];
        $last_name = $user['last_name'];
        $contact_number = $user['contact_number'];
        $address = $user['address'];
        $full_name = $first_name . " " . $middle_initial . ". " . $last_name;
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User not logged in.";
    exit;
}

if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
    $selected_product_ids = (array) $_POST['selected_products'];
    $ids = implode(",", $selected_product_ids);

    $sql = "SELECT product_ID, product_name, store_price, img_data FROM tbl_products WHERE product_ID IN ($ids)";
    $result = $conn->query($sql);

    $subtotal = 0;
    $shipping_fee = 50.00;
    $orderDate = date('Y-m-d');

    while ($row = $result->fetch_assoc()) {
        $productId = $row['product_ID'];
        $productPrice = $row['store_price'];
        $paymentStatus = 'PENDING';
        $pickupStatus = 'PENDING';
        $totalAmount = $productPrice + $shipping_fee;

        $sql_insert = "INSERT INTO tbl_orders (user_ID, product_ID, payment_status, pickup_status, order_date, total) 
                       VALUES ('$userId', '$productId', '$paymentStatus', '$pickupStatus', '$orderDate', '$totalAmount')";

        if (!$conn->query($sql_insert)) {
            echo "Error inserting order: " . $conn->error;
        }

        $subtotal += $productPrice;
    }

    $amount = ($subtotal + $shipping_fee) * 100;

    $paymongoApiKey = $_ENV['PAYMONGO_API_KEY'];
    $paymongoSecret = $_ENV['PAYMONGO_SECRET'];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paymongo.com/v1/links",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'data' => [
                'attributes' => [
                    'amount' => (int)$amount,
                    'description' => 'Customer Checkout'
                ]
            ]
        ]),
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Basic " . base64_encode("$paymongoApiKey:$paymongoSecret"),
            "content-type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error: " . $err;
    } else {
        $data = json_decode($response, true);
        $checkoutUrl = $data['data']['attributes']['checkout_url'] ?? null;

        if ($checkoutUrl) {
            echo "<script>
                    window.location.href = '$checkoutUrl';
                  </script>";
        } else {
            echo "Error: Unable to retrieve the checkout URL.";
        }
    }
} else {
    echo "No products selected for checkout.";
}

$conn->close();
?>
