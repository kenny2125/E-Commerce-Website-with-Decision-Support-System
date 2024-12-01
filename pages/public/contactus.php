<?php
session_start(); // Start the session

// Check if the user is logged in
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <title>RPC Tech Computer Store</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
<link rel="stylesheet" href="/assets/css/index.css">
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="index.php">
            <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
        <!-- Search Bar -->
        <form action="/pages/shop/Products_List.php" method="get" class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button href="/pages/shop/Products_List.php" class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="pages/shop/carting_list.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="pages/user/user_profile.php">
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

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-2" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">
                    <img src="assets/images/rpc-logo-black.png" alt="RPC Computer Store" class="rpc-logo">
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-box">
                <form action="pages/user/login.php" method="POST">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="eg.jeondanel" required class="input-field">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password"id="password" name="password" placeholder="••••••••" required class="input-field">
                        <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon" style="cursor: pointer;">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn login-btn">Login</button>
                    </div>
                </form>
                    <p>Don't have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#registrationModal" data-dismiss="modal">Create Account</a>
                        </p>
                    <!-- Display login error message -->
                    <?php if (isset($_SESSION['login_error'])): ?>
                        <div id="loginError" class="error-message" style="color: red;">
                            <?php echo $_SESSION['login_error']; ?>
                        </div>
                        <?php unset($_SESSION['login_error']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel"></h5>
                <img src="assets/images/rpc-logo-black.png" alt="RPC Computer Store" class="rpc-logo">
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-box">
                        <h3>Create an Account</h3>
                        <p>Already have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a>
                        </p>
                        <form action="pages/user/user_register.php" method="post" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="input-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" placeholder="eg. Danel" name="firstName" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="middleInitial">M.I</label>
                                    <input type="text" id="middleInitial" placeholder="eg. T." name="middleInitial" class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" placeholder="eg. Oandasan" name="lastName" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" id="gender" placeholder="eg. Female" name="gender" class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" placeholder="eg. BLK 5 LOT 6 SAMMAR 1 HOA Luzon Ave. Old Balara, Quezon City" name="address" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" placeholder="eg. danel@gmail.com" name="email" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" placeholder="eg. 18" name="age" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="contactNumber">Contact Number</label>
                                    <input type="text" id="contactNumber" placeholder="eg. 09123456789" name="contactNumber" required class="input-field">
                                </div>
                                <div class="input-group">   
                                    <label for="username">Username</label>
                                    <input type="text" id="username" placeholder="eg. jeondanel" name="username" required class="input-field">
                                </div>
                                <div class="input-group">
                                    <label for="passwordReg">Password</label>
                                    <input type="password" id="passwordReg" class="form-control input-field" placeholder="Enter password" name="passwordReg" required>
                                    <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon1" style="cursor: pointer;">
                                </div>
                                <div id="passwordFeedback" class="feedback"></div>
                                <div class="input-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" id="confirmPassword" class="form-control input-field" placeholder="Confirm password" name="confirmPassword" required>
                                    <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon2" style="cursor: pointer;">
                                </div>
                                <div id="confirmPasswordFeedback" class="feedback"></div>
                            </div>
                            <div class="terms">
                                <input type="checkbox" name="terms" required/> Agree to <a href="#">Terms and Conditions</a>
                            </div>
                            <button type="submit" name="signUp" class="btn btn-primary mt-3">SIGN UP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
        <!-- Back button -->
        <div class="back" id="backButton" style="margin-top: 30px; right: 20px; margin-bottom: 30px; font-size: 23px; color: #A9A9A9; margin-left: 1790px;">
            <a href="/index.php" style="text-decoration: none; color: inherit;">Back</a>
        </div>


///
        <div class="flex-container">
            <div class="rectangle-parent">
                <div class="contact-section">
                    <h2 class="contact-us"><img class="call-icon" src="assets/images/footerimages/call icon.png" alt="Phone Icon">Contact Us</h2>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/mailicon.png" alt="Email Icon">
                        <a href="mailto:homelabsol@gmail.com" class="email">rpctechcomputers@gmail.com</a>
                    </div>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/telephoneicon.png" alt="Telephone Icon">
                        0912345678910
                    </div>

                    <div class="contact-item">
                        <img src="assets/images/footerimages/fbicon.png" alt="Facebook Icon">
                        <a href="https://www.facebook.com/RPCTechComputerStore" target="_blank" class="storefb">RPC Tech Computer Store</a>
                    </div>
                    <div class="contact-item">
                        <div class="hours-title">Hours Of Operation</div>
                        <p class="hours-content">
                            We're available to assist you during the following hours:<br>
                            <strong>Monday to Saturday:</strong> 9:00 AM – 6:00 PM<br>
                            <strong>Sunday:</strong> Closed
                        </p>
                    </div>
                </div>        
            </div>

            <div class="map-section">
                <div class="map-title">Google Maps</div>
                <iframe
                    class="mapcontainer"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.019584833245!2d120.64694731531743!3d15.04241867907745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd1c64e9b8d8b9%3A0x8d1c9c7e7c4e1c2!2sKM%2078%20MC%20ARTHUR%20HI-WAY%20BRGY.SAGUIN%2C%20San%20Fernando%2C%20Philippines%2C%202000!5e0!3m2!1sen!2sus!4v1635268928945!5m2!1sen!2sus"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
        <!-- Back button -->
        <div class="back" id="backButton">Back</div>
    </div>

            <script>
        document.getElementById("backButton").addEventListener("click", function () {
            if (document.referrer) {
                // Go back if there's a previous page
                window.history.back();
            } else {
                // Redirect to the main page if there's no history
                window.location.href = "index.php"; // Change to your main page URL
            }
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>