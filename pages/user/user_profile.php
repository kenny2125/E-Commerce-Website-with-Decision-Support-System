<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/user_profile.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>
<body>

<?php
include '../../includes/header.php';
include '../../config/db_config.php';


$user_ID = $_SESSION['user_ID'];


if (empty($user_ID)) {
    die("You need to log in.");
}

$sql = "SELECT * FROM tbl_user WHERE user_ID = $user_ID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found with the given user ID.";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $firstName = $_POST['first_name'];
    $middleInitial = $_POST['middle_initial'];
    $lastName = $_POST['last_name'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];

    $hashedPassword = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    $updateSql = "UPDATE tbl_user SET 
                    first_name = '$firstName', 
                    middle_initial = '$middleInitial', 
                    last_name = '$lastName', 
                    address = '$address', 
                    contact_number = '$contactNumber', 
                    email = '$email' 
                    WHERE user_ID = $user_ID";


    if (!empty($_POST['password'])) {
        $updateSql .= ", password = '$hashedPassword'";
    }

    if ($conn->query($updateSql)) {
        echo "Profile updated successfully";

        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

    <div class="container" style="display: flex; flex: 1; margin-top: 90px; padding-bottom: 100px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar" style="background-color: #1A54C0; padding: 30px; border-radius: 20px; width: 250px; display: flex; flex-direction: column; justify-content: flex-start; align-items: flex-start; position: relative; min-height: 70vh;">
    <div class="sidebar-item" id="myProfile" style="display: flex; align-items: center; padding: 10px 20px; cursor: pointer; font-size: 16px; color: #FFFFFF; text-transform: capitalize; margin-bottom: 5px; transition: background-color 0.3s ease;">
        <span class="material-icons icon">person</span>
        <span class="tab" style="width: 115px;">My Profile</span>
    </div>
    <div class="sidebar-item" id="orderHistorySidebar" style="display: flex; align-items: center; padding: 10px 20px; cursor: pointer; font-size: 16px; color: #FFFFFF; text-transform: capitalize; margin-bottom: 5px; transition: background-color 0.3s ease;">
        <span class="material-icons icon">history</span>
        <span class="tab" style="width: 115px;">Order History</span>
    </div>
    <a href="logout.php" class="btn btn-danger ml-2" style="margin-top: auto; margin-left: 55px;">Log Out</a>
</div>

            
            <!-- Profile Content -->
            <div class="col-md-9 profile-content" id="profileContent">
                <h2>My Profile</h2>
                <form method="POST">
                    <div class="info-section" style="background-color: #f8f8f8; padding: 10px; margin-top: 20px; height: 380px;">
                        <!-- First Name, M.I., and Last Name in one row -->
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input type="text" name="first_name" id="firstName" value="<?= $user['first_name']; ?>" disabled>
                            </div>
                            <div class="col-md-1">
                                <label>M.I.</label>
                                <input type="text" name="middle_initial" id="middleInitial" value="<?= $user['middle_initial']; ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input type="text" name="last_name" id="lastName" value="<?= $user['last_name']; ?>" disabled>
                            </div>
                            <div class="col-md-1">
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
                            <div class="col-md-3">
                                <label>Username</label>
                                <input type="text" name="username" id="username" value="<?= $user['username']; ?>" disabled>
                            </div>
                            <div class="col-md-3">
                                <label>Password</label>
                                <input type="password" name="password" id="password" value="********" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="text" name="email" id="email" value="<?= $user['email']; ?>" disabled>
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

    if (!isset($_SESSION['user_ID'])) {
        die("You must be logged in to view your order history.");
    }

    $userID = $_SESSION['user_ID'];
    

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "
        SELECT o.order_ID, o.payment_status, o.pickup_status, o.order_date, o.total, p.product_name
        FROM tbl_orders o
        JOIN tbl_products p ON o.product_ID = p.product_ID
        WHERE o.user_ID = $userID
        ORDER BY o.order_date DESC
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $orderHistory = "";
        while ($row = $result->fetch_assoc()) {
            $orderID = $row['order_ID'];
            $paymentStatus = $row['payment_status'];
            $pickupStatus = $row['pickup_status'];
            $orderDate = $row['order_date'];
            $total = number_format($row['total'], 2);
            $productName = $row['product_name'];

            $orderDateFormatted = date("F j, Y", strtotime($orderDate));

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

        </div>
    </div>
</div>
        <?php
    include '../../includes/footer.php';
?>
        </div>

    </div>

</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('orderHistoryContent').style.display = 'none';

   
        document.getElementById('myProfile').classList.add('active');
    });


    document.getElementById('myProfile').addEventListener('click', function () {
 
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('orderHistoryContent').style.display = 'none';


        setActiveTab(this);
    });


    document.getElementById('orderHistorySidebar').addEventListener('click', function () {

        document.getElementById('orderHistoryContent').style.display = 'block';
        document.getElementById('profileContent').style.display = 'none';


        setActiveTab(this);
    });


    function setActiveTab(activeTab) {

        var tabs = document.querySelectorAll('.sidebar-item');
        tabs.forEach(function (tab) {
            tab.classList.remove('active');
        });

   
        activeTab.classList.add('active');
    }


    document.getElementById('editProfile').addEventListener('click', function() {
        var inputs = document.querySelectorAll('#profileContent input');
        inputs.forEach(function(input) {

            if (input.id !== 'username' && input.id !== 'password') {
                input.disabled = false; 
            }
        });
        document.getElementById('saveProfile').style.display = 'inline'; 
        document.getElementById('editProfile').style.display = 'none';
    });
</script>
