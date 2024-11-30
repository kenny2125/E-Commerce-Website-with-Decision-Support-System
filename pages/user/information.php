<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/information.css">
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-3">
                <div class="sidebar-item active" id="myProfile">
                    <span class="material-icons icon">person</span>
                    <span>My Profile</span>
                </div>
                <div class="sidebar-item" id="orderHistory">
                    <span class="material-icons icon">history</span>
                    <span>Order History</span>
                </div>
                <button class="logout-button" id="logoutButton">Log Out</button>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- My Profile Section -->
                <div id="profileContent" class="profile-content mb-5">
                    <h2>My Profile</h2>
                    <div class="section-header">Basic Information</div>
                    <div class="info-section">
                        <!-- Profile Info Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name</label>
                                <input type="text" id="firstName" value="Mikylla" disabled class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>M.I.</label>
                                <input type="text" id="middleInitial" value="T." disabled class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name</label>
                                <input type="text" id="lastName" value="Nova" disabled class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" id="username" value="mikiimeeow" disabled class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="password" id="password" value="********" disabled class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Birthdate</label>
                                <div class="birthdate-display">April 10, 2005</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Gender</label>
                                <div class="gender-display">Female</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="button-container">
                        <button class="action-button" id="editProfile" data-editing="false">Edit Profile</button>
                        <button class="action-button" id="changePassword">Change Password</button>
                    </div>
                    
                    <!-- Right Side: Address, Contact, and Email -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label>Address</label>
                            <div class="address-display">Main Address<br>673 Quirino Hwy, Novaliches, Quezon City, Metro Manila</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Contact Number</label>
                            <div class="contact-display">091222222222</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <div class="email-display">mikyllanova10@gmail.com</div>
                        </div>
                    </div>
                </div>

                <!-- Order History Section -->
                <div id="orderHistoryContent" class="order-history">
                    <h2>Order History</h2>
                    <div class="panel">
                        <table class="table">
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
                                <tr>
                                    <td>1</td>
                                    <td>GEFORCE RTX 4090 MSI GAMING TRIO 24GB GDDR6X TRIPLE FAN RGB</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td><span class="badge bg-primary">Ready</span></td>
                                    <td>October 29, 2024</td>
                                    <td>₱114,995.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/information.js"></script>
</body>
</html>