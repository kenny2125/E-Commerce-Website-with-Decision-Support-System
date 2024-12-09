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

// Ensure user is logged in by checking if user_ID is set in session
$user_ID = $_SESSION['user_ID']; // Get the user ID from the session

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
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];

    // Hash password only if it's provided, else use the existing password
    $hashedPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    // Update user data in the database (excluding username and password)
    $updateSql = "UPDATE tbl_user SET 
                    first_name = '$firstName', 
                    middle_initial = '$middleInitial', 
                    last_name = '$lastName', 
                    address = '$address', 
                    contact_number = '$contactNumber', 
                    email = '$email' 
                    WHERE user_ID = $user_ID";

    // Only add password to the query if it's changed
    if (!empty($_POST['password'])) {
        $updateSql .= ", password = '$hashedPassword'";
    }

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
                        
                        <!-- Username and Password in second row, these fields are disabled -->
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
                <td>
                    <!-- Cancel Button -->
                    <form method='POST' action='cancel_order.php'>
                        <input type='hidden' name='order_ID' value='$orderID'>
                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to cancel this order?\")'>Cancel</button>
                    </form>
                </td>
            </tr>";
        }
        // Show the order history inside the table
        echo "
        <div id='orderHistoryContent' class='col-md-9 order-history-content'>
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
                            <th>Action</th> <!-- New column for cancel button -->
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
        <?php
    // include '../../includes/footer.php';
?>
        </div>

    </div>

</body>
</html>

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

    // Enable the input fields when edit profile is clicked
    document.getElementById('editProfile').addEventListener('click', function() {
        var inputs = document.querySelectorAll('#profileContent input');
        inputs.forEach(function(input) {
            // Enable all inputs except username and password
            if (input.id !== 'username' && input.id !== 'password') {
                input.disabled = false; // Enable all inputs except username and password
            }
        });
        document.getElementById('saveProfile').style.display = 'inline'; // Show save button
        document.getElementById('editProfile').style.display = 'none'; // Hide edit button
    });
</script>
