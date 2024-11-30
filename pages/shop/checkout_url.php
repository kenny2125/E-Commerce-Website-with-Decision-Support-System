<?php
// Get the amount from the form
$amount = $_POST['amount'] ?? 0;

// Initialize cURL
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
        "authorization: Basic c2tfdGVzdF90dGdxaGQ5RUFEQWFOS1NZSHdHWHZXd3M6",
        "content-type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // Decode the API response
    $data = json_decode($response, true);
    
    // Extract the checkout URL
    $checkoutUrl = $data['data']['attributes']['checkout_url'] ?? null;

    if ($checkoutUrl) {
        // Generate a new HTML page that redirects to the checkout URL
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Redirecting...</title>
            <script>
                window.location.href = '$checkoutUrl';
            </script>
        </head>
        <body>
            <p>If you are not redirected automatically, click <a href='$checkoutUrl'>here</a>.</p>
        </body>
        </html>";
    } else {
        echo "Error: Unable to retrieve the checkout URL.";
    }
}
?>
