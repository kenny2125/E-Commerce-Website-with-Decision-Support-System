<?php
// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

// Include the database connection
include '../../config/db_config.php'; // Adjust the path as needed

// Fetch product details from the database using product_ID
// Fetch product details from the database using product_ID
$query = "SELECT * FROM tbl_products WHERE product_ID = ?"; // Use ? as placeholder for mysqli
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $productId); // Bind the parameter (i stands for integer)
$stmt->execute();

// Fetch the product details
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found!";
    exit;
}

// Decode the JSON specification if stored as JSON
$specification = json_decode($product['specification'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Detail Page</title>
    <link rel="stylesheet" href="/assets/css/product-detail.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Logo -->
        <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        
        <!-- Search Bar -->
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <!-- <?php if ($isLoggedIn === true): ?> -->
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                
                <a href="pages/user/logout.php" class="btn btn-danger ml-2">Log Out</a>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container my-5 ">
    <div class="row">
        <!-- Product Image -->
        <div class="d-flex-grow col-md-3 text-center">
            <?php
            // Check if there is image data for the product
            if ($product['img_data']) {
                $imgData = base64_encode($product['img_data']);
                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
            } else {
                $imgSrc = 'path/to/default-image.jpg'; // Default image if no img_data is present
            }
            ?>
            <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded" alt="Product Image" style="max-width: 100%;">
        </div>

        <!-- Product Details -->
        <div class="col-md-4">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><strong>Stock Available:</strong> <span class="text-success">In Stock</span></p>
            <p><strong>Price:</strong> <span class="text-danger fs-4">₱<?php echo number_format($product['srp'], 2); ?></span></p>
            <p class="text-justify"><strong>Description:</strong><?php echo htmlspecialchars($product['description']); ?></p>

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
                    <input type="number" id="quantity" class="form-control mx-2" value="1" min="1">
                <button class="btn btn-outline-secondary" id="quantity-plus">+</button>
            </div>


            <!-- Buttons -->
            <div>
            <button class="btn me-2 add-to-cart">Add to Cart</button>
                <button class="btn btn-success">Checkout</button>
            </div>
        </div>

        <!-- Product specification -->
        <div class="col-md-4">
            <h4 class="fw-bold">Specification:</h4>
            <ul>
            <p class="text-justify"><?php echo htmlspecialchars($product['specification']); ?></p>
            </ul>
        </div>
    </div>
</div>

<div class="content"></div>
<footer class="footer" style="width: 100%; background-color: #122448; color: #fff; font-family: 'Lato', sans-serif; padding: 10px 0; position: relative; bottom: 0;">
<div class="footer-container" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; max-width: 1200px; margin: 0 auto; padding: 10px;">
    <div class="footer-section" style="flex: 1 1 200px; text-align: left;">
      <img class="footer-logo" src="/assets/images/rpc-logo-white.png" alt="RPC Tech Computer Store Logo" style="width: 250px; margin-bottom: 10px; margin-left: 10px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Follow Us</p>
            <a href="https://www.facebook.com/profile.php?id=61567195257950" target="_blank">
                <img class="footer-social-links" src="/assets/images/fb icon.png" alt="Social Links" style="width: 20px; margin-left: 32px;">
            </a>
    </div>
    
    <div class="footer-section contact" style="flex: 1 1 200px; text-align: left; margin-top: 90px; margin-left: -50px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Contact Us</p>
            <p class="footer-contact-item" style="display: flex; align-items: center; margin: 5px 0; font-size: 13px; color: #fff; text-decoration: none;">
                <img class="icon" src="/assets/images/call-icon.png" alt="Phone Icon" style="width: 15px; margin-right: 10px;"> 09616952829 / 09945657044
            </p>
            <p class="footer-contact-item" style="display: flex; align-items: center; margin: 5px 0; font-size: 13px; color: #fff; text-decoration: none;">
                <a href="mailto:rpctechcomputers@gmail.com"><img class="icon" src="/assets/images/gmail icon.png" alt="Email Icon" style="width: 15px; margin-right: 10px;">rpctechcomputers@gmail.com</a>
            </p>
    </div>
    
    <div class="footer-section branch" style="flex: 1 1 200px; text-align: left; margin-top: 15px; margin-left: 40px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Branches</p>
            <p class="footer-branch-item" style="display: flex; align-items: left; margin: 5px 0; color: #fff;">
                <img class="icon" src="/assets/images/bx-location-plus.png" alt="Branch Icon" style="width: 20px; height: 18px; margin-right: 6px;">Main Branch
            </p>
            <p class="footer-branch-address" style="margin: 5px 18px; font-size: 13px; width: 220px; text-align: left; color: #fff;">
                <a href="https://www.google.com/maps/place/RPC+Tech+Computer/@15.0988169,120.6194883,1059m/data=!3m2!1e3!4b1!4m6!3m5!1s0x3396f1d7698ed943:0x8086f35e9ed733de!8m2!3d15.0988117!4d120.6220632!16s%2Fg%2F11lmmzgj3y?hl=en&entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D" target="_blank">KM 78 MC ARTHUR HI-WAY BRGY.SAGUIN, San Fernando, Philippines, 2000</a>
            </p>
    </div>
    
    <div class="footer-links" style="display: flex; padding-top: 15px; margin-right: 5px; justify-content: flex-start;">
        <div class="footer-link-column" style="flex: none; margin: 0 13px;">
            <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Who are we?</p>
                <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
                    <p style="margin: 0; text-align: left;"><a href="pages/public/aboutus.php" style="text-decoration: none; color: #fff; font-size: 14px;">About Us</a></p>
                    <p style="margin: 0; text-align: left;"><a href="pages/public/faq.php" style="text-decoration: none; color: #fff; font-size: 14px;">FAQ</a></p>
                    <p style="margin: 0; text-align: left;"><a href="pages/public/contactus.php" style="text-decoration: none; color: #fff; font-size: 14px;">Contact Us</a></p>
                </div>
        </div>
    </div>

    <div class="footer-link-column" style="flex: none; margin: 15px 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Legal Terms</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
          <p style="margin: 0; text-align: left;"><a href="pages/public/termconditions.php" style="text-decoration: none; color: #fff; font-size: 14px;">Terms & Conditions</a></p>
          <p style="margin: 0; text-align: left;"><a href="pages/public/privacy-policy.php" style="text-decoration: none; color: #fff; font-size: 14px;">Privacy Policy</a></p>
      </div>
    </div>

    <div class="footer-link-column" style="flex: none; margin: 15px 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Guides</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
            <p style="margin: 0; text-align: left;"><a href="pages/public/purchase-guides.php" style="text-decoration: none; color: #fff; font-size: 14px;">Purchasing Guides</a></p>
            <p style="margin: 0; text-align: left;"><a href="pages/public/motherboard-chipset.php" style="text-decoration: none; color: #fff; font-size: 14px;">Motherboard Chipset</a></p>
            <p style="margin: 0; text-align: left;"><a href="pages/public/power-supply-calculator.php" style="text-decoration: none; color: #fff; font-size: 14px;">Power Supply Calculator</a></p>
        </div>
    </div>
</div>

    <div class="footer-bottom" style="text-align: center; font-size: 12px; margin-top: 20px;">
        <p style="margin: 5px 0; color: #fff;">&copy; 2022 RPC Tech Computer Store.</p>
        <p style="margin: 5px 0; color: #fff;">All rights reserved.</p>
    </div>
</footer>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the 'Add to Cart' button and quantity input
    const addToCartBtn = document.querySelector('.btn.add-to-cart');
    const quantityInput = document.querySelector('#quantity');
    const quantityMinus = document.querySelector('#quantity-minus');
    const quantityPlus = document.querySelector('#quantity-plus');

    // Add event listener for 'Add to Cart' button
    addToCartBtn.addEventListener('click', function() {
        const productId = <?php echo $product['product_ID']; ?>; // Fetch the product ID from PHP
        const quantity = parseInt(quantityInput.value);

        // Validate quantity input
        if (isNaN(quantity) || quantity <= 0) {
            alert('Please enter a valid quantity greater than 0.');
            return;
        }

        // Send an AJAX request to add the product to the cart
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        // Prepare data to be sent
        const data = 'product_id=' + productId + '&quantity=' + quantity;

        // Handle response from the server
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message); // Show success message
                    // Optionally, update the cart icon or page to reflect the added product
                } else {
                    alert(response.message); // Show error message
                }
            } else {
                alert('Error: Unable to add product to cart. Please try again later.');
            }
        };

        // Handle request error (e.g., network issues)
        xhr.onerror = function() {
            alert('Network error: Unable to add product to cart.');
        };

        // Send the request
        xhr.send(data);
    });

    // Decrease quantity on minus button click
    quantityMinus.addEventListener('click', function() {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) { // Ensure the minimum quantity is 1
            quantityInput.value = currentQuantity - 1;
        }
    });

    // Increase quantity on plus button click
    quantityPlus.addEventListener('click', function() {
        let currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
    });
});
</script>