<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/information.css">
</head>
<body>
    <!-- Header Section with Search Bar and Logo -->
    <header class="header">
        <div class="logo">
        <img src="/assets/images/1.png" alt="RPC Computer Store">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button class="search-button">Search</button>
        </div>
    </header>
    
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
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
        
        <!-- Profile Content -->
        <div class="profile-content" id="profileContent">
            <h2>My Profile</h2>
            <div class="section-header">Basic Information</div>
            <div class="info-section">
                <div class="info-item">
                    <label>First Name</label>
                    <input type="text" id="firstName" value="Mikylla" disabled>
                </div>
                <div class="info-item">
                    <label>M.I.</label>
                    <input type="text" id="middleInitial" value="T." disabled>
                </div>
                <div class="info-item">
                    <label>Last Name</label>
                    <input type="text" id="lastName" value="Nova" disabled>
                </div>
                <div class="info-item">
                    <label>Username</label>
                    <input type="text" id="username" value="mikiimeeow" disabled>
                </div>
                <div class="info-item">
                    <label>Password</label>
                    <input type="password" id="password" value="********" disabled>
                </div>
                <div class="info-item">
                    <label>Birthdate</label>
                    <div class="birthdate-display">April 10, 2005</div>
                </div>
                <div class="info-item">
                    <label>Gender</label>
                    <div class="gender-display">Female</div>
                </div>
            </div>
            
            <div class="button-container">
                <button class="action-button" id="editProfile" data-editing="false">Edit Profile</button>
                <button class="action-button" id="changePassword">Change Password</button>
            </div>

            <!-- Right Side: Address, Contact, and Email -->
            <div class="right-section">
                <div class="info-item">
                    <label>Address</label>
                    <div class="address-display">Main Address<br>673 Quirino Hwy, Novaliches, Quezon City, Metro Manila</div>
                </div>
                <div class="info-item">
                    <label>Contact Number</label>
                    <div class="contact-display">091222222222</div>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <div class="email-display">mikyllanova10@gmail.com</div>
                </div>
            </div>
        </div>

        <!-- Order History Section -->
        <div class="order-history" id="orderHistoryContent">
            <h2>Order History</h2>
            <p>Your order history is empty.</p>
        </div>
    </div>

    <script src="/assets/js/information.js"></script>
</body>
</html>