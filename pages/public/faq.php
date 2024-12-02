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
          <img src="/assets/images/BANNERS (1).png" alt="Logo" class="logo" style="width: 95%;">
                      
    <h1 class="frequently-asked-questions" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/Group 345.png" alt="Question Icon" style="margin-right:10px;">Frequently Asked Questions (FAQ)</h1>
    <div class="our-frequently-asked" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 80px; font-size: 23px;">Our Frequently Asked Questions (FAQ) section provides quick answers to common inquiries about our services, policies, and support. From understanding our offerings to details on shipping, payment options, and return policies, this section is designed to help you find the information you need easily and efficiently.</div>
    
    <!-- General Questions Section -->
    <div class="general-questions-q-container"> 
      <p class="general-questions" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;"> General Questions</p>
      
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What is your company's mission?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Our mission is to provide high-quality products and excellent customer service to help meet your technology needs. We’re committed to innovation, value, and reliability.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;" >Q: How can I contact customer support? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: You can reach customer support via email at rpctechcomputers@gmail.com or by calling our number, 0912345678910.</p>

      <!-- Repeat structure for each FAQ section below -->
      
      <p class="general-questions" style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;" >Product Specifications</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;"> Q: How much RAM is recommended for general use? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;"> A: For most general users, 8GB of RAM is sufficient for browsing, document editing, and media consumption. For gaming or professional tasks, we recommend 16GB or more for optimal performance.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: SSD vs. HDD – What’s the difference?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: SSDs (Solid State Drives) offer faster data access, quicker boot times, and better performance, making them ideal for most users. HDDs (Hard Disk Drives) are more affordable and provide larger storage capacity, making them suitable for extensive data storage on a budget.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Which processor is best for gaming or professional tasks?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: For gaming, an Intel Core i7 or AMD Ryzen 7 processor is typically ideal. For professional tasks like video editing or 3D rendering, a more powerful processor, such as Intel Core i9 or AMD Ryzen 9, is recommended.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Ordering & Payments</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What payment methods do you accept? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: We accept Paymongo, Cash on Delivery, and In-store payment.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Can I cancel or modify my order after it’s placed?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, you can cancel or modify your order within 24 hours of placing it. Please contact our customer service team at rpctechcomputers@gmail.com for assistance.</p>
      
      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Shipping & Delivery</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How long does standard shipping take? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Standard shipping usually takes 3-5 business days, while express shipping options are available and typically take 1-2 business days.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Will I be able to track my order?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, once your order ships, you’ll receive an email with a tracking number. You can use this number to check the status of your shipment.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Returns & Refunds</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: What is your return policy? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: We offer a 30-day return policy on all products. Items must be in their original condition and packaging. For more details, please contact support.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How long does it take to process a refund?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Refunds are typically processed within 7-10 business days after we receive the returned item.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Technical Support</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How can I contact technical support for help with my device? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: For technical support, email us at rpctechcomputers@gmail.com or call 0912345678910. Our support team is available Monday through Friday, 9 AM to 6 PM (EST).</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Are desktops easier to upgrade than laptops?  </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, desktops generally offer more flexibility for upgrades, allowing you to easily replace components like the processor, graphics card, and memory. Laptop upgrades are usually limited to RAM and storage.</p>

      <p class="general-questions"style="text-align: justify; margin-top: 30px; margin-left: 170px; margin-right: 170px; margin-bottom: 10px; font-size: 23px; font-weight: bold;">Warranty & Support</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: Do your products come with a warranty? </p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">A: Yes, all computers come with a standard 1-year manufacturer’s warranty. Extended warranty options are also available at checkout for added coverage.</p>
      <p class="blank-line">&nbsp;</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; font-size: 20px;">Q: How can I reach the technical support team?</p>
      <p class="q-what-is-your-companys-miss" style="text-align: justify; margin-left: 200px; margin-right: 170px; margin-bottom: 80px; font-size: 20px;">A: You can reach our technical support team via email at rpctechcomputers@gmail.com or by calling 0912345678910. We’re available Monday through Friday, from 9 AM to 6 PM (EST).</p>
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
