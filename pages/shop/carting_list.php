<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$user_ID = $_SESSION['user_ID'] ?? null;
// Database connection
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";
$port = "3306";

$conn = new mysqli($host, $username, $password, $db_name);
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false; // Safe check for isLoggedIn

// Initialize the check for admin role
$isAdmin = ($_SESSION['role'] ?? '') === 'admin'; // Check if role is 'admin'
// Debugging (optional, can be removed in production)
// echo "<h2>Session Data (Debugging)</h2>";
// if (!empty($_SESSION)) {
//     echo "<pre>";
//     print_r($_SESSION);
//     echo "</pre>";
// } else {
//     echo "<p>No session data available.</p>";
// }
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set user ID variable (change this value as needed)
// $user_ID = 11; // Dummy user ID for debugging and testing
// Set user ID variable (change this value as needed)



// Query to fetch products for the specific user
$sql = "SELECT p.product_ID, p.product_name, p.store_price, p.img_data 
    FROM tbl_products p
    JOIN tbl_cart c ON p.product_ID = c.product_ID
    WHERE c.user_ID = $user_ID"; // Only fetch products added to the cart by the specified user

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            width: 100%;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .product-card img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            margin-right: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h5 {
            margin: 0;
        }
                    /* Base Container Styling */
        .container-fluid {
        display: flex; /* Use flexbox for layout */
        align-items: center;
        justify-content: space-between; /* Space out elements */
        flex-wrap: wrap; /* Allow wrapping for smaller screens */
        height: auto; /* Adjust height dynamically */
        background-color: #FFFFFF;
        box-shadow: 0 7px 3px -2px lightgrey;
        padding: 10px 20px;
        position: relative; /* Enables precise positioning adjustments */
        }

        /* Logo Styling */
        .logo {
        width: 240px;
        height: auto; /* Maintain aspect ratio */
        max-width: 100%;
        margin-left: 20px; /* Move logo to the right */
        position: relative; /* Allows precise control over placement */
        left: 20px; /* Fine-tune placement */
        }

        /* Search Bar Styling */
        .search-bar {
        display: flex;
        flex-grow: 1; /* Allow search bar to grow dynamically */
        max-width: 800px; /* Limit max width */
        margin-right: 10px;
        }

        /* Search Input Field */
        .search-bar .form-control {
        flex-grow: 1; /* Fill available space */
        font-size: 18px;
        border-radius: 74px;
        padding-left: 40px;
        margin-right: 10px; /* Space between input and button */
        }

        /* Search Button */
        .search-bar .btn-outline-success {
        height: 55px;
        font-size: 20px;
        border-radius: 74px;
        background-color: #1A54C0;
        color: #FFFFFF;
        padding: 0 45px;
        }

        /* Hover Effects */
        .search-bar .btn-outline-success:hover {
        background-color: #154a9e;
        transform: scale(1.01); /* Hover effect */
        transition: transform 0.3s ease, background-color 0.3s ease;
        }

        /* Login Button Styling */
        .btn-primary {
        height: 40px;
        font-size: 16px;
        border-radius: 74px;
        background-color: #1A54C0;
        padding: 0 25px;
        margin-right: 20px; /* Adjust spacing for better placement */
        position: relative;
        right: 40px; /* Move the login button to the left */
        }

        .btn-primary:hover {
        background-color: #154a9e;
        transform: scale(1.01); /* Hover effect */
        transition: transform 0.3s ease, background-color 0.3s ease;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
        .container-fluid {
            flex-direction: column; /* Stack elements vertically */
            align-items: flex-start; /* Align items to the left */
        }

        .logo {
            margin-bottom: 20px; /* Add spacing below the logo */
            margin-left: 0; /* Reset left margin */
            left: 0; /* Reset left position */
        }

        .search-bar {
            flex-direction: column; /* Stack input and button */
            align-items: stretch; /* Full width for stacked elements */
            width: 100%; /* Take full width */
            max-width: 100%;
            margin-bottom: 20px; /* Add spacing below */
        }

        .search-bar .form-control {
            margin-right: 0; /* Remove margin for stacking */
            margin-bottom: 10px; /* Add spacing below input */
        }

        .search-bar .btn-outline-success {
            width: 100%; /* Full width button */
        }

        .btn-primary {
            width: 100%; /* Full width login button */
            margin: 0; /* Align with other buttons */
            left: -5px; /* Reset right position */
        }
        }
    </style>
</head>
<body>

<!-- <link rel="stylesheet" href="../../assets/css/index.css"> -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="/index.php">
            <img src="../../assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
        <!-- Search Bar -->
        <form action="pages/shop/Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button href="pages/shop/Products_List.php" class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="/pages/shop/carting_list.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="/pages/user/user_profile.php">
                        <img src="/assets/images/Group 48.png" alt="Profile Icon">
                    </a>

                    <!-- Admin Link (only visible to admins) -->
                    <?php if ($isAdmin): ?>
                        <a href="pages/admin/pages/admin_dashboard.php" class="btn btn-outline-danger ms-3">
                            Admin Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-5">
    <h3>Cart List</h3>
    <form method="POST" action="checkout_carting.php">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Output products
                while ($row = $result->fetch_assoc()) {
                    $product_ID = $row['product_ID'];
                    $product_name = $row['product_name'];
                    $store_price = $row['store_price'];
                    $img_data = $row['img_data'];

                    // Convert img_data to a base64 string for displaying
                    $img_base64 = base64_encode($img_data);
            ?>
                    <div class="col-12">
                        <div class="product-card">
                            <img src="data:image/jpeg;base64,<?php echo $img_base64; ?>" alt="<?php echo $product_name; ?>">
                            <div class="product-info">
                                <h5><?php echo $product_name; ?></h5>
                                <p>Price: ₱<?php echo number_format($store_price, 2); ?></p>
                            </div>
                            <div>
                                <!-- Checkbox for selecting the product -->
                                <input type="checkbox" name="selected_products[]" value="<?php echo $product_ID; ?>">
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No products found for this user.";
            }
            ?>
        </div>

        <!-- Checkout Button -->
        <button type="submit" class="btn btn-primary mt-3">Proceed to Checkout</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
