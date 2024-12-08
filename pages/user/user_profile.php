<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/information.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>

<style>
    .sidebar-item {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        cursor: pointer;
        color: #FFFFFF;
        margin-bottom: 5px;
    }

    .sidebar-item.active {
        background-color: #007bff; /* Highlight color */
        border-radius: 8px;
    }

    .sidebar-item .icon {
        margin-right: 10px;
    }
</style>

<body>

<?php
        include '../../includes/header.php';
        include '../../config/db_config.php';




// Make sure $user_ID is valid
if (empty($user_ID)) {
    die("You need to log in.");
}

// Fetch user data from the database
$sql = "SELECT * FROM tbl_user WHERE user_ID = $user_ID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found with the given user ID.";
    exit();
}

// Save changes if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $firstName = $_POST['first_name'];
    $middleInitial = $_POST['middle_initial'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password before saving
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];

    // Hash password if changed
    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $user['password'];

    // Update user data in the database
    $updateSql = "UPDATE tbl_user SET first_name = '$firstName', middle_initial = '$middleInitial', last_name = '$lastName', username = '$username', password = '$hashedPassword', address = '$address', contact_number = '$contactNumber', email = '$email' WHERE user_ID = $user_ID";
    
    if ($conn->query($updateSql)) {
        echo "Profile updated successfully";
        // Refresh the user data after updating
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar" style="background-color: #1A54C0; padding: 30px; border-radius: 20px">
                <div class="sidebar-item" id="myProfile">
                    <span class="material-icons icon">person</span>
                    <span class="tab">My Profile</span>
                </div>
                <div class="sidebar-item" id="orderHistorySidebar">
                    <span class="material-icons icon">history</span>
                    <span class="tab">Order History</span>
                </div>
                <a href="logout.php" class="btn btn-danger ml-2" style="margin-top: 350px; margin-left: 55px;">Log Out</a>
            </div>
            
            <!-- Profile Content -->
            <div class="col-md-9 profile-content" id="profileContent">
                <h2>My Profile</h2>
                <div class="section-header">Basic Information</div>
                <form method="POST">
                    <div class="info-section">
                        <!-- First Name, M.I., and Last Name in one row -->
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="firstName" value="<?= $user['first_name']; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>M.I.</label>
                                <input type="text" name="middle_initial" id="middleInitial" value="<?= $user['middle_initial']; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="lastName" value="<?= $user['last_name']; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Age</label>
                                <input type="text" name="age" id="age" value="<?= $user['age']; ?>" disabled>
                            </div>
                            <div class="col-md-2">
                                <label>Gender</label>
                                <input type="text" name="gender" id="gender" value="<?= $user['gender']; ?>" disabled>
                            </div>
                        </div>
                        
                        <!-- Username and Password in second row -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" id="username" value="<?= $user['username']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" id="password" value="********" disabled>
                            </div>
                        </div>

                        <!-- Address, Contact Number, and Email in third row -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="<?= $user['address']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" id="contactNumber" value="<?= $user['contact_number']; ?>" disabled>
                            </div>
                            <div class="col-md-12">
                                <label>Email</label>
                                <input type="email" name="email" id="email" value="<?= $user['email']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    
                    <div class="button-container">
                        <!-- Button to toggle edit mode -->
                        <button type="button" class="action-button" id="editProfile">Edit Profile</button>
                        
                        <!-- Button to save changes -->
                        <button type="submit" class="action-button" name="save_changes" id="saveProfile" style="display: none;">Save Changes</button>
                    </div>
                </form>
            </div>

            <?php

// Make sure the user is logged in
if (!isset($_SESSION['user_ID'])) {
    die("You must be logged in to view your order history.");
}

// Get the user ID from the session
$userID = $_SESSION['user_ID'];

$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders for the logged-in user, with product names from tbl_products
$sql = "
    SELECT o.order_ID, o.payment_status, o.pickup_status, o.order_date, o.total, p.product_name
    FROM tbl_orders o
    JOIN tbl_products p ON o.product_ID = p.product_ID
    WHERE o.user_ID = $userID
    ORDER BY o.order_date DESC
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each row of orders
    $orderHistory = "";
    while ($row = $result->fetch_assoc()) {
        $orderID = $row['order_ID'];
        $paymentStatus = $row['payment_status'];
        $pickupStatus = $row['pickup_status'];
        $orderDate = $row['order_date'];
        $total = number_format($row['total'], 2);
        $productName = $row['product_name'];

        // Format order date
        $orderDateFormatted = date("F j, Y", strtotime($orderDate));

        // Add each order row to the table content
        $orderHistory .= "
        <tr>
            <td>$orderID</td>
            <td>$productName</td> <!-- Output the product name -->
            <td><span class='badge bg-" . ($paymentStatus == 'PENDING' ? 'warning' : 'success') . "'>$paymentStatus</span></td>
            <td><span class='badge bg-" . ($pickupStatus == 'Ready' ? 'primary' : 'secondary') . "'>$pickupStatus</span></td>
            <td>$orderDateFormatted</td>
            <td>₱$total</td>
        </tr>";
    }
    // Show the order history inside the table
    echo "
    <div id='orderHistoryContent' class='order-history'>
        <h2>Order History</h2>
        <div class='panel'>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Product Name</th>
                        <th>Payment Status</th>
                        <th>Pickup Status</th>
                        <th>Order Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    $orderHistory
                </tbody>
            </table>
        </div>
    </div>";
} else {
    echo "<p>No orders found.</p>";
}

$conn->close();
?>

        </div>

    </div>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show only "My Profile" content by default
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('orderHistoryContent').style.display = 'none';

        // Highlight "My Profile" tab by default
        document.getElementById('myProfile').classList.add('active');
    });

    // Event listener for "My Profile" tab
    document.getElementById('myProfile').addEventListener('click', function () {
        // Show "My Profile" content and hide "Order History" content
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('orderHistoryContent').style.display = 'none';

        // Update tab highlight
        setActiveTab(this);
    });

    // Event listener for "Order History" tab
    document.getElementById('orderHistorySidebar').addEventListener('click', function () {
        // Show "Order History" content and hide "My Profile" content
        document.getElementById('orderHistoryContent').style.display = 'block';
        document.getElementById('profileContent').style.display = 'none';

        // Update tab highlight
        setActiveTab(this);
    });

    // Function to update active tab highlight
    function setActiveTab(activeTab) {
        // Remove "active" class from all sidebar items
        var tabs = document.querySelectorAll('.sidebar-item');
        tabs.forEach(function (tab) {
            tab.classList.remove('active');
        });

        // Add "active" class to the selected tab
        activeTab.classList.add('active');
    }
</script>
</body>
</html>
