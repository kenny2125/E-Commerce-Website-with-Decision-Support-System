<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/checkout.css">
    <link rel="icon" href="../../assets/images/rpc-favicon.png">
</head>
<?php
include '../../includes/header.php';
include '../../config/db_config.php';

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;

if ($isLoggedIn && $userId) {
    $sql = "SELECT first_name, middle_initial, last_name, contact_number, address FROM tbl_user WHERE user_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($first_name, $middle_initial, $last_name, $contact_number, $address);
        $stmt->fetch();
        $stmt->close();
        $full_name = $first_name . " " . ($middle_initial ? $middle_initial . ". " : "") . $last_name;
    } else {
        echo "Error in preparing the SQL statement.";
        exit;
    }
} else {
    echo "User not logged in.";
    exit;
}

if (isset($_POST['selected_products']) && !empty($_POST['selected_products'])) {
    $selected_product_ids = (array)$_POST['selected_products'];

    if (is_array($selected_product_ids) && count($selected_product_ids) > 0) {
        $ids = implode(",", array_map('intval', $selected_product_ids));
    } else {
        echo "Invalid product selection.";
        exit;
    }

    $sql = "SELECT product_ID, product_name, store_price, img_data FROM tbl_products WHERE product_ID IN ($ids)";
    $result = $conn->query($sql);

    $subtotal = 0;
    $shipping_fee = 50.00;
} else {
    echo "No products selected for checkout.";
    exit;
}
?>
<body style="background-color: #EBEBEB;">
<div class="container my-5">
    <div class="mb-4">
        <a href="test_carting.php" class="text-decoration-none text-primary fw-bold back-link">&larr; Back</a>
        <h2 class="fw-bold mt-3 title-header">Checkout</h2>
    </div>
    <div class="row g-4">
        <div class="col-lg-8">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];
                    $img_base64 = base64_encode($img_data);
                    $subtotal += $store_price;
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
                echo "No products found.";
            }
            ?>
        </div>
        <div class="col-lg-4">
            <form method="POST" id="checkout-form">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <h5 class="fw-bold section-title">Purchase Information</h5>
                        <div class="mt-3">
                            <p class="mb-1" style="text-align: left;"><strong>Name:</strong> <span id="customer-name"><?php echo $full_name; ?></span></p>
                            <p class="mb-1" style="text-align: left;"><strong>Contact:</strong> <span id="customer-contact"><?php echo $contact_number; ?></span></p>
                            <p class="mb-3" style="text-align: left;"><strong>Address:</strong> <span id="customer-address"><?php echo $address; ?></span></p>
                        </div>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label fw-bold">Payment Method</label>
                            <select id="payment-method" name="payment_method" class="form-select">
                                <option value="Gcash">GCash</option>
                                <option value="Paymaya">PayMaya</option>
                                <option value="Cash on Delivery">Cash on Delivery</option>
                            </select>
                        </div>
                        <div class="mb-3" id="agree-container"></div>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="fw-bold section-title">Order Review</h5>
                        <div class="mt-3">
                            <p class="mb-1" style="text-align: left;">Product subtotal: <span class="float-end" id="product-subtotal">₱<?php echo number_format($subtotal, 2); ?></span></p>
                            <p class="mb-1" style="text-align: left;">COD shipping: <span class="float-end" id="shipping-fee">₱<?php echo number_format($shipping_fee, 2); ?></span></p>
                            <hr>
                            <p style="text-align: left;"><strong>Total payment: <span class="float-end text-danger" id="total-payment">₱<?php echo number_format($subtotal + $shipping_fee, 2); ?></span></strong></p>
                        </div>
                        <input type="hidden" name="amount" value="<?php echo ($subtotal + $shipping_fee) * 100; ?>">
                        <input type="hidden" id="selected_products" name="selected_products" value="">
                        <input type="hidden" name="user_ID" value="<?php echo $userId; ?>">
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="agree" required>
                            <label for="agree" class="form-check-label small" id="agree-label">I agree that my information is correct and valid.</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100 fw-bold" style="margin-left: 0px;">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('payment-method').addEventListener('change', function() {
    var paymentMethod = this.value;
    var form = document.getElementById('checkout-form');
    var agreeLabel = document.getElementById('agree-label');
    var agreeContainer = document.getElementById('agree-container');

    if (paymentMethod === 'paymongo' || paymentMethod === 'Gcash' || paymentMethod === 'Paymaya') {
        form.action = 'controllers/url_placeorder.php';
        form.target = '_blank';
        agreeLabel.textContent = 'I agree to make payment via ' + paymentMethod.charAt(0).toUpperCase() + paymentMethod.slice(1);
        agreeContainer.style.display = 'block';
    } else if (paymentMethod === 'Cash on Delivery') {
        form.action = 'controllers/placeorder.php';
        form.target = '_self';
        agreeLabel.textContent = 'I agree that my information is correct and valid.';
        agreeContainer.style.display = 'block';
    }
});

document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();

    if (document.getElementById('agree').checked) {
        var selectedProductIds = <?php echo json_encode($selected_product_ids); ?>;

        if (selectedProductIds.length === 0) {
            alert("No products selected for checkout.");
            return false;
        }

        document.getElementById('selected_products').value = selectedProductIds.join(',');

        this.submit();
    } else {
        alert('Please agree to the terms and conditions before placing the order.');
    }
});
</script>
