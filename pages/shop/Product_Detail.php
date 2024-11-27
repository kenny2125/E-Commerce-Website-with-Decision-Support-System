<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php include '../../includes/header.php'; ?>
    <div class="container my-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-4 text-center">
                <img src="../../assets/images/rtx-4090.jpg" class="img-fluid rounded" alt="Product Image" style="max-width: 100%;">
            </div>

            <!-- Product Details -->
            <div class="col-md-4">
                <h2 class="fw-bold">Product Name</h2>
                <p><strong>Stock Available:</strong> <span class="text-success">In Stock</span></p>
                <p><strong>Price:</strong> <span class="text-danger fs-4">₱12,999.00</span></p>
                <p><strong>Description:</strong> This is a detailed description of the product. Highlight its features, use cases, and other important information.</p>

                <h5>Payment & Pickup Methods</h5>
                <ul>
                    <li>Cash on Delivery</li>
                    <li>Credit/Debit Card</li>
                    <li>Bank Transfer</li>
                    <li>In-store Pickup</li>
                </ul>

                <!-- Quantity Control -->
                <div class="d-flex align-items-center my-3">
                    <button class="btn btn-outline-secondary" id="quantity-minus">-</button>
                    <input type="number" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 80px;">
                    <button class="btn btn-outline-secondary" id="quantity-plus">+</button>
                </div>

                <!-- Buttons -->
                <div>
                    <button class="btn btn-primary me-2">Add to Cart</button>
                    <button class="btn btn-success">Checkout</button>
                </div>
            </div>

            <!-- Product Specifications -->
            <div class="col-md-4">
                <h4 class="fw-bold">Specifications</h4>
                <ul>
                    <li>Specification 1: Value 1</li>
                    <li>Specification 2: Value 2</li>
                    <li>Specification 3: Value 3</li>
                    <li>Specification 4: Value 4</li>
                </ul>
            </div>
        </div>
    </div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>