<?php
// Database connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for subtotal and shipping fee
$subtotal = 0;
$shipping_fee = 50.00;  // Example shipping fee

// Check if selected products are passed from the form (cart items)
if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
    $selected_product_ids = $_POST['selected_products'];  // Array of selected product IDs
    $ids = implode(",", $selected_product_ids);  // Convert the array to a comma-separated string for the SQL query

    // Query to fetch product details for the selected products
    $sql = "SELECT product_ID, product_name, store_price, img_data FROM tbl_products WHERE product_ID IN ($ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_ID = $row['product_ID'];
            $product_name = $row['product_name'];
            $store_price = $row['store_price'];
            $img_data = $row['img_data'];

            // Convert img_data to a base64 string for displaying
            $img_base64 = base64_encode($img_data);

            // Calculate subtotal
            $subtotal += $store_price;
        }
    } else {
        echo "No products selected for checkout.";
        exit;
    }
}
// Check if product details are passed directly from the form (e.g., manual checkout)
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['store_price'])) {
    // Get individual product details from the form
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $storePrice = $_POST['store_price'];

    // If the product details are provided, we add them to the subtotal
    $subtotal += $storePrice;

    // Process checkout for this single product (you can adjust the logic for processing individual items)
} else {
    echo "No products selected for checkout.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/checkout.css">
</head>
<body style="background-color: #EBEBEB;">
  <div class="container my-5">
    <div class="mb-4">
        <a href="test_carting.php" class="text-decoration-none text-primary fw-bold back-link">&larr; Back</a>
        <h2 class="fw-bold mt-3 title-header">Checkout</h2>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <?php
            // Output the products in the checkout if they exist (from cart or from the form)
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];

                    // Convert img_data to a base64 string for displaying
                    $img_base64 = base64_encode($img_data);
            ?>

            <div class="card shadow border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" class="img-fluid rounded-start" alt="<?php echo $product_name; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold product-title"><?php echo $product_name; ?></h5>
                            <p class="card-text text-danger fw-bold product-price">₱<?php echo number_format($store_price, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                // If a product was passed directly from the form, display that product
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($productId)) {
            ?>
            <div class="card shadow border-0 mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <!-- Use a default or placeholder image if no image data is available -->
                        <img src="placeholder.jpg" class="img-fluid rounded-start" alt="<?php echo $productName; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold product-title"><?php echo $productName; ?></h5>
                            <p class="card-text text-danger fw-bold product-price">₱<?php echo number_format($storePrice, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <div class="col-lg-4">
            <form method="POST" action="checkout_url.php" target="_blank">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <h5 class="fw-bold section-title">Purchase Information</h5>
                        <!-- Customer Information (can be fetched from a session or a database if available) -->
                        <div class="mt-3">
                            <p class="mb-1"><strong>Name:</strong> <span id="customer-name">[Customer Name]</span></p>
                            <p class="mb-1"><strong>Contact:</strong> <span id="customer-contact">[Customer Contact]</span></p>
                            <p class="mb-3"><strong>Address:</strong> <span id="customer-address">[Customer Address]</span></p>
                        </div>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label fw-bold">Payment Method</label>
                            <select id="payment-method" class="form-select">
                                <option value="paymongo">Paymongo Link</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="cash_on_delivery">Cash on Delivery</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pickup-method" class="form-label fw-bold">Pickup Method</label>
                            <select id="pickup-method" class="form-select">
                                <option value="store">Store Pickup</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="fw-bold section-title">Order Review</h5>
                        <div class="mt-3">
                            <p class="mb-1">Product subtotal: <span class="float-end" id="product-subtotal">₱<?php echo number_format($subtotal, 2); ?></span></p>
                            <p class="mb-1">COD shipping: <span class="float-end" id="shipping-fee">₱<?php echo number_format($shipping_fee, 2); ?></span></p>
                            <hr>
                            <p><strong>Total payment: <span class="float-end text-danger" id="total-payment">₱<?php echo number_format($subtotal + $shipping_fee, 2); ?></span></strong></p>
                        </div>
                        <input type="hidden" name="amount" value="<?php echo ($subtotal + $shipping_fee) * 100; ?>"> <!-- Dummy amount in cents -->
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="agree" required>
                            <label for="agree" class="form-check-label small">
                                I agree to redirect to Paymongo Payment Gateway
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</body>
</html>


<!-- Notification Indicator -->
<div id="notificationIndicator" class="alert alert-info" style="display:none; position: fixed; bottom: 10px; right: 10px; z-index: 999;">
    New webhook data received!
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="webhookModal" tabindex="-1" aria-labelledby="webhookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="webhookModalLabel">Webhook Notification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="modalMessage">Waiting for webhook...</p>
        <pre id="modalPayload"></pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#webhookModal">
    Open Modal
</button>


<!-- jQuery and Bootstrap JS (For AJAX and Modal) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to handle the received webhook data and trigger the modal
    function handleWebhookData(data) {
        // Update modal with received data
        $('#modalMessage').text(data.message);
        $('#modalPayload').text(JSON.stringify(data.payload, null, 2));

        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('webhookModal'));
        myModal.show();

        // Show the notification indicator
        $('#notificationIndicator').fadeIn().delay(3000).fadeOut();
    }

    // Polling function to check for new data from the backend
    function pollForWebhookData() {
        console.log('Checking for new data at ' + new Date().toLocaleTimeString());  // Debugger: log time of check
        
        $.ajax({
            url: 'webhook_receiver.php', // Same file for GET request
            type: 'GET',
            success: function(response) {
                const res = JSON.parse(response);

                // If there's new data, show the modal
                if (res.status === 'success' && res.payload) {
                    handleWebhookData(res);
                    // After displaying, clear the data from the session
                    clearWebhookData();
                }
            },
            error: function() {
                console.log('Error reaching webhook receiver.');
            }
        });
    }

    // Function to clear the webhook data after it's shown
    function clearWebhookData() {
        $.ajax({
            url: 'webhook_receiver.php?clear_data=true', // Clear data request
            type: 'GET',
            success: function(response) {
                console.log('Webhook data cleared.');
            },
            error: function() {
                console.log('Error clearing webhook data.');
            }
        });
    }

    // Poll every 5 seconds to check for new data
    setInterval(pollForWebhookData, 2000);
</script>


<?php
$conn->close();
?>
