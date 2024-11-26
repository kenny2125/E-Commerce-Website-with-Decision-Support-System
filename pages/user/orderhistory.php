<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../assets/css/orderhistory.css">
    <script src="../assets/js/orderhistory.js"></script>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="menu-item" id="order-history-btn">Order History</div>
            <div class="menu-item" id="my-profile-btn">My Profile</div>
            <button class="logout-btn">Log Out</button>
        </div>

        <!-- Main Content -->
        <div class="content">
            <!-- Order History Section -->
            <div class="order-history" id="order-history-section">
                <h2>Order History</h2>
                <div class="order-header">
                    <span class="order-column">Order #</span>
                    <span class="order-column">Product Name</span>
                    <span class="order-column">Payment Status</span>
                    <span class="order-column">Pickup Status</span>
                    <span class="order-column">Order Date</span>
                    <span class="order-column">Total</span>
                </div>
                <div class="order-item">
                    <div class="order-details">
                        <span class="order-number">1</span>
                        <div class="product-info">
                        </div>
                        <span class="status paid">PAID</span>
                        <span class="status ready">READY</span>
                        <span class="order-date">October 29, 2024</span>
                        <span class="order-total">₱114,995.00</span>
                    </div>
                </div>
            </div>

            <!-- My Profile Section -->
            <div class="profile-container" id="profile-section">
                <h2>My Profile</h2>
                <h4>Basic Information</h4>
                <div class="section">
                    <div class="info-box">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" value="Mikylla">
                    </div>
                    <div class="info-box">
                        <label for="mi">M.I.</label>
                        <input type="text" id="mi" value="T.">
                    </div>
                    <div class="info-box">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" value="Nova">
                    </div>
                </div>
                <div class="section">
                    <div class="info-box">
                        <label for="birthdate">Birthdate</label>
                        <input type="text" id="birthdate" value="April 10, 2005">
                    </div>
                    <div class="info-box">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" value="Female">
                    </div>
                </div>
                <h4>Contact Information</h4>
                <div class="section">
                    <div class="info-box">
                        <label for="address">Main Address</label>
                        <input type="text" id="address" value="673 Quirino Hwy, Novaliches, Quezon City, Metro Manila">
                    </div>
                    <div class="info-box">
                        <label for="contact">Contact No.</label>
                        <input type="text" id="contact" value="091222222222">
                    </div>
                    <div class="info-box">
                        <label for="email">Current Email</label>
                        <input type="email" id="email" value="mikyllanova10@gmail.com">
                    </div>
                </div>
                <div class="buttons">
                    <button class="btn">Edit Profile</button>
                    <button class="btn">Change Password</button>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>