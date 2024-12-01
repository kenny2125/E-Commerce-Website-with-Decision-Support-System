<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPC Computer Store</title>
    <link rel="stylesheet" a href="/assets/css/productdetailpage.css">
    <link rel="icon" a href="/assets/images/rpc-favicon.png"
</head>

<body>
<nav class="navbar navbar-light bg-light">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; height: auto; background-color: #FFFFFF; box-shadow: 0 7px 3px -2px lightgrey; padding: 10px 20px; position: relative;">
        <!-- Logo -->
        <img src="assets/images/rpc-logo-black.png" alt="Logo" style="width: 240px; height: auto; max-width: 100%; margin-left: 20px; position: relative; left: 20px;">

        <!-- Search Bar -->
        <form style="display: flex; flex-grow: 1; max-width: 800px; margin-right: 10px;">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search" style="flex-grow: 1; font-size: 18px; border-radius: 74px; padding-left: 40px; margin-right: 10px;">
            <button class="btn btn-outline-success" type="submit" style="height: 55px; font-size: 20px; border-radius: 74px; background-color: #1A54C0; color: #FFFFFF; padding: 0 45px;">Search</button>
        </form>

        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <a href="pages/user/logout.php" class="btn btn-danger ml-2" style="height: 40px; font-size: 16px; border-radius: 74px; background-color: #DC3545; padding: 0 25px;">Log Out</a>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal" style="height: 40px; font-size: 16px; border-radius: 74px; background-color: #1A54C0; padding: 0 25px; margin-right: 20px; position: relative; right: 40px;">Log In</button>
        <?php endif; ?>
    </div>
</nav>
    <h1><img src="/assets/images/rpc-logo-black.png"width="120" height="40" id="logo" title="home"></h1>

    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button class="search-button">Search</button>
    </div>
    <div class="icon-group">
        <button class="icon-button" title="My Cart">
            <img src="/assets/images/cart.png" alt="Cart Icon" class="icon-image">
        </button>
        <button class="icon-button" title="Profile">
            <img src="/assets/images/userlogo.png" alt="User Icon" class="icon-image">
        </button>
    </div>
    
    <hr>

    <div class="cart-wrapper">
        <div class="product-container">
            <div class="product-image">
                <img src="/assets/images/rtx-4090.jpg" alt="Product Image">
            </div>
            <div class="product-details">
                <h2>GEFORCE RTX 4090 MSI GAMING TRIO 24GB GDDR6X TRIPLE FAN RGB</h2>
                <p class="stock">Stocks Available: 5</p>
                <p class="price">₱114,995.00</p>
                <p class="description">
                    The NVIDIA® GeForce RTX™ 4090 is the ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics with DLSS 3. Experience ultra-high performance gaming, incredibly detailed virtual worlds with ray tracing, unprecedented productivity, and new ways to create. It’s powered by the NVIDIA Ada Lovelace architecture and comes with 24 GB of G6X memory to deliver the ultimate experience for gamers and creators.
                </p>
                    <div class="selection-group">
                        <label for="pickup-method">Pickup Method:</label>
                        <select id="pickup-method" name="pickup-method">
                            <option value="store">Store Pickup</option>
                            <option value="delivery">In-House Delivery</option>
                        </select>
                    </div>
                    <div class="selection-group">
                        <label for="payment-method">Payment Method:</label>
                        <select id="payment-method" name="payment-method">
                            <option value="cod">Cash on Delivery</option>
                            <option value="paymongo">PayMongo</option>
                            <option value="gcash">GCash</option>
                            <option value="paymaya">PayMaya</option>
                        </select>
                    </div>
                <!-- Container for Quantity Picker, Add to Cart, and Checkout -->
                <div class="action-card">
                    <div class="quantity-group">
                        <label for="quantity">Quantity:</label>
                        <div class="quantity-controls">
                            <button type="button" class="decrement">-</button>
                            <input type="text" id="quantity" name="quantity" value="1" readonly>
                            <button type="button" class="increment">+</button>
                        </div>
                    </div>
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="checkout">Checkout</button>
                </div>
            </div>
        </div>

    </body>
</html>