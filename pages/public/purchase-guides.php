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
            <img src="/assets/images/BANNERS (3).png" alt="Logo" class="logo" style="width: 95%;">>
        
    <h1 class="purchasing-guide" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/Group 344.png" alt="Cart Icon" style="margin-right:10px;">Purchasing Guide</h1>

    <div class="welcome-to-our" style="text-align: justify; margin-bottom: 40px; margin-left: 190px; margin-right: 170px; font-size: 20px;">
      Welcome to our Purchasing Guide! This page is designed to make your shopping experience as easy and enjoyable as possible. Whether you're a new customer or a returning one looking for a quick refresher, we’re here to guide you through every step of the buying process. In this guide, you'll find helpful information on how to navigate our website, select products, and complete your purchase with confidence. Our goal is to ensure a smooth, straightforward shopping journey from start to finish. Let’s get started!
    </div>

    <!-- Step Sections -->
    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 1: Determine Your Needs
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">When buying a new computer or tech equipment, start by assessing your specific needs. Are you purchasing for basic home use like browsing the internet and light document editing, or do you need a more powerful system for gaming, video editing, or programming? Different uses require different hardware capabilities.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">If you're a gamer, for instance, you'll need a system with a powerful GPU and fast refresh rates, whereas a graphic designer might prioritize color accuracy and screen quality. If you're working in an office environment, portability and battery life might take precedence. Keep in mind that determining your needs early will help you narrow down your options and avoid overspending on features you don’t really need.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 2: Set a Budget
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Setting a budget is crucial. This will help you focus on products within your range and might influence the specifications you can realistically afford. Remember to consider long-term costs, such as potential upgrades, additional peripherals, and extended warranties that could extend the lifespan of your device.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Additionally, consider the overall cost of ownership. Some products may seem affordable upfront, but they might require costly upgrades or additional peripherals down the line. It's wise to think ahead and anticipate future needs, such as buying additional storage, software, or even warranties that could extend the lifespan of your device.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 3: Choose the Right Specifications
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Selecting appropriate specifications ensures your device meets your performance expectations. Here are the main components to consider the Processor (CPU), Memory (RAM), and the Storage. You may be able to upgrade RAM and storage later, so don’t feel pressured to max out these specs from the beginning.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Storage is another key factor to consider. An SSD (Solid State Drive) is faster and more reliable than a traditional HDD (Hard Disk Drive), but it tends to be more expensive. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. SSDs are ideal if speed and performance are important to you, whereas HDDs are better suited for bulk storage at a lower price. When choosing your specifications, remember that it’s often easier to upgrade certain components later, such as RAM or storage, so it's not always necessary to max out your configuration from the start.</p>   
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 4: Compare Products
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">After narrowing your choices, compare the specifications and features of each product. Key factors to look for includes Performance look at specifications such as processor speed, graphics card performance, and RAM to understand how each device handles tasks, Display the resolution (e.g., Full HD, 4K), color accuracy, and brightness are important, particularly if you’ll be doing visual work like photo or video editing., Battery Life and Portability.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">By evaluating each of these factors, you can weigh the pros and cons of each model to find the best fit for your needs and budget. Customer and expert reviews are helpful resources to understand how well a product performs in real-world settings. Consider both positive and negative feedback for a balanced view.</p>  
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 5: Place Your Order
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Once you’re ready to purchase, add the item to your cart and proceed to checkout. In terms of shipping method choose between standard or express, depending on your urgency and in payment options it might include Paymongo, and Cash On Delivery. Before proceeding to checkout, verify that the correct item, model, and any additional options (such as specific configurations or accessories) are in your cart.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">After completing payment, you should receive an order confirmation email with details about your purchase, including tracking information. By following these steps, you’ll minimize errors during the purchasing process and ensure your order is accurate, secure, and on track for timely delivery.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 6: Monitor Shipping & Delivery
      </div>
      <p style="text-align: justify; margin-bottom: -20px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Use the tracking details provided to keep an eye on your order’s progress. If any issues arise, like delays or incorrect information, contact customer service for assistance. You may also be able to arrange for pickup if you won’t be home at the time of delivery.</p>
      <p class="blank-line">&nbsp;</p>
      <p style="text-align: justify; margin-bottom: 60px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Be sure to monitor your tracking details, so you know when to expect your delivery. If any issues arise with your delivery, such as delays or incorrect information, our customer service team is always ready to assist you. We also offer the option to choose different delivery preferences, such as having the package held at a delivery center for pickup if you won’t be home at the time of delivery.</p>
    </div>

    <div class="step-section">
      <div class="step-title" style="text-align: justify; margin-top: 30px; margin-left: 130px; margin-right: 170px; margin-bottom: 20px; font-size: 23px; font-weight: bold;">
        Step 7: Review Return Policy
      </div>
      <p style="text-align: justify; margin-bottom: 80px; margin-left: 190px; margin-right: 170px; font-size: 20px;">Lastly, review the return policy in case you encounter any issues with your purchase. Most stores have specific conditions for returns and exchanges, often with a limited window for returning items. Understanding this policy upfront will help ensure you’re prepared if you need to make a return.</p>
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
                    <p style="margin: 0; text-align: left;"><a href="/pages/public/about_us.php" style="text-decoration: none; color: #fff; font-size: 14px;">About Us</a></p>
                    <p style="margin: 0; text-align: left;"><a href="/pages/public/faq.php" style="text-decoration: none; color: #fff; font-size: 14px;">FAQ</a></p>
                    <p style="margin: 0; text-align: left;"><a href="/pages/public/contactus.php" style="text-decoration: none; color: #fff; font-size: 14px;">Contact Us</a></p>
                </div>
        </div>
    </div>

    <div class="footer-link-column" style="flex: none; margin: 15px 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Legal Terms</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
          <p style="margin: 0; text-align: left;"><a href="/pages/public/termconditions.php" style="text-decoration: none; color: #fff; font-size: 14px;">Terms & Conditions</a></p>
          <p style="margin: 0; text-align: left;"><a href="/pages/public/privacy-policy.php" style="text-decoration: none; color: #fff; font-size: 14px;">Privacy Policy</a></p>
      </div>
    </div>

    <div class="footer-link-column" style="flex: none; margin: 15px 13px;">
        <p class="footer-heading" style="text-align: left; font-size: 18px; font-weight: bold; margin-bottom: 5px; color: #fff;">Guides</p>
        <div class="footer-link-list" style="display: flex; flex-direction: column; gap: 8px; font-weight: 300; text-align: left;">
            <p style="margin: 0; text-align: left;"><a href="/pages/public/purchase-guides.php" style="text-decoration: none; color: #fff; font-size: 14px;">Purchasing Guides</a></p>
            <p style="margin: 0; text-align: left;"><a href="/pages/public/motherboard-chipset.php" style="text-decoration: none; color: #fff; font-size: 14px;">Motherboard Chipset</a></p>
            <p style="margin: 0; text-align: left;"><a href="/pages/public/power-supply-calculator.php" style="text-decoration: none; color: #fff; font-size: 14px;">Power Supply Calculator</a></p>
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
    $(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'path_to_user_login.php', // Adjust path as necessary
            method: 'POST',
            data: { username: username, password: password },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Update UI based on response
                    $('#loginModal').modal('hide');
                    location.reload(); // Reload to show updated user information
                } else {
                    // Show error message
                    $('#loginError').text(response.message);
                }
            },
            error: function() {
                $('#loginError').text('An error occurred. Please try again.');
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'path_to_user_login.php', // Adjust path as necessary
            method: 'POST',
            data: { username: username, password: password },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    // Update UI based on response
                    $('#loginModal').modal('hide');
                    location.reload(); // Reload to show updated user information
                } else {
                    // Show error message
                    $('#loginError').text(response.message);
                }
            },
            error: function() {
                $('#loginError').text('An error occurred. Please try again.');
            }
        });
    });
});
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($openModal): ?>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        <?php endif; ?>
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($openModal): ?>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        <?php endif; ?>
    });
</script>

<!-- Login Modal -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const passwordField = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePasswordIcon');

    togglePasswordIcon.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordIcon.src = '/assets/images/view.png'; 
        } else {
            passwordField.type = 'password';
            togglePasswordIcon.src = '/assets/images/closed.png'; 
        }
    }); 

    passwordField.addEventListener('input', () => {
        const fakePassword = passwordField.value.split('').map(() => Math.floor(Math.random() * 10)).join('');
        passwordField.setAttribute('data-fake-password', fakePassword);
    });

    const observer = new MutationObserver(() => {
        const fakePassword = passwordField.getAttribute('data-fake-password');
        if (fakePassword) {
            passwordField.value = fakePassword;
        }
    });

    observer.observe(passwordField, { attributes: true, attributeFilter: ['value'] });
});
</script>

<!-- Register Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordReg = document.getElementById('passwordReg');
        const confirmPassword = document.getElementById('confirmPassword');
        const togglePasswordIcon1 = document.getElementById('togglePasswordIcon1');
        const togglePasswordIcon2 = document.getElementById('togglePasswordIcon2');
        const passwordFeedback = document.getElementById('passwordFeedback');
        const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');

        // Toggle password visibility
        togglePasswordIcon1.addEventListener('click', function () {
            if (passwordReg.type === 'password') {
                passwordReg.type = 'text';
                togglePasswordIcon1.src = '/assets/images/view.png';
            } else {
                passwordReg.type = 'password';
                togglePasswordIcon1.src = '/assets/images/closed.png';
            }
        });

        togglePasswordIcon2.addEventListener('click', function () {
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                togglePasswordIcon2.src = '/assets/images/view.png';
            } else {
                confirmPassword.type = 'password';
                togglePasswordIcon2.src = '/assets/images/closed.png';
            }
        });

        // Password validation function
        function validatePassword() {
            const passwordValue = passwordReg.value;
            const confirmPasswordValue = confirmPassword.value;

            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~])[A-Za-z\d!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]+$/;

            // Check if password matches the requirements
            if (passwordValue && passwordRegex.test(passwordValue)) {
                passwordFeedback.textContent = ""; // Remove any previous feedback
                passwordFeedback.style.color = "";  // Reset color
                passwordReg.style.borderColor = ""; // Reset border color
                passwordReg.setCustomValidity("");  // Reset custom validity
            } else {
                passwordFeedback.textContent = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
                passwordFeedback.style.color = "red";
                passwordReg.style.borderColor = "red";
                passwordReg.setCustomValidity("Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
            }

            // Confirm password match validation
            if (passwordValue && passwordValue === confirmPasswordValue) {
                confirmPasswordFeedback.textContent = ""; // Remove previous feedback
                confirmPasswordFeedback.style.color = ""; // Reset color
                confirmPassword.style.borderColor = ""; // Reset border color
                confirmPassword.setCustomValidity("");  // Reset custom validity
            } else {
                confirmPasswordFeedback.textContent = "Passwords do not match";
                confirmPasswordFeedback.style.color = "red";
                confirmPassword.style.borderColor = "red";
                confirmPassword.setCustomValidity("Passwords do not match");
            }
        }

        // Attach event listeners to update feedback dynamically
        passwordReg.addEventListener('input', validatePassword);
        confirmPassword.addEventListener('input', validatePassword);

        // Trigger validation on page load to show messages without typing
        validatePassword();
    });
</script>