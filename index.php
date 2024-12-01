<?php
session_start(); // Start the session

$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
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
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="icon" href="assets/images/rpc-favicon.png">
</head>
<body>

<!-- Welcome Modal -->
<?php
    // include 'includes/welcomemodal.php';
?>

<!-- Header -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Logo -->
        <img src="assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        
        <!-- Search Bar -->
        <form class="d-flex search-bar">
            <input class="form-control me-2" type="search" placeholder="Search for product(s)" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <a href="pages/user/user_profile.php" class="btn btn-outline-primary mx-2">Profile</a>
                <a href="pages/shop/carting_list.php" class="btn btn-outline-secondary mx-2">Cart</a>
                <a href="pages/user/logout.php" class="btn btn-danger ml-2">Log Out</a>
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

    <!-- Carousel -->
<div id="carouselWithInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php for ($i = 1; $i <= 16; $i++): ?>
            <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>" data-bs-interval="2000">
                <img src="assets/images/bs-images/WHITE BANNER VERSION (<?= $i ?>).png" class="d-block w-100 img-fluid" alt="Slide <?= $i ?>">
            </div>
        <?php endfor; ?>
    </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselWithInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselWithInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Brand Logos -->
    <div class="brand-logo-container overflow-hidden my-5" style="height: 100px;">
        <div class="brand-logo-wrapper d-flex animate-loop">
            <?php 
            $brands = ["amd", "asus", "biostar", "coolermaster", "corsair", "cougar", "darkflash", "dell", "fanatec", "gigabyte", "gskill", "hp", "inplay", "intel", "kingston", "msi", "nvidia", "nvision", "nzxt", "samsung"];
            foreach (array_merge($brands, $brands) as $brand): ?>
            <img src="assets/images/brands/<?= $brand ?>.png" alt="<?= ucfirst($brand) ?>" class="brand-logo mx-4" style="height: 50px;">
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
    // Database connection
    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "vg2eweo4yg8eydii";
    $password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";

    $conn = new mysqli($host, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch products from the database
    $sql = "SELECT product_ID, product_name, srp, img_data FROM tbl_products LIMIT 6";
    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        // Store products in an array
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    $conn->close();
?>

<!-- Featured Products -->
<div class="featured-products-wrapper" style="margin-bottom: 100px;">
    <div class="container my-4">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row g-3">
            <?php if (!empty($products)) : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                        <div class="card" style="width: 309.328px; height: 437.188px; display: flex; flex-direction: column; align-items: center; border: 1px solid #ddd;">
                            <?php
                            // Check if there is image data
                            if (!empty($product['img_data'])) {
                                $imgData = base64_encode($product['img_data']);
                                $imgSrc = 'data:image/jpeg;base64,' . $imgData;
                            } else {
                                $imgSrc = 'path/to/default-image.jpg';
                            }
                            ?>
                            <!-- Image -->
                            <img src="<?php echo $imgSrc; ?>" class="card-img-top img-fluid" alt="Product Image" style="max-height: 250px; object-fit: cover;">
                            
                            <!-- Card Body -->
                            <div class="card-body" style="flex-grow: 1; text-align: center;">
                                <h5 class="card-title" style="font-size: 1.1rem; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                <p class="card-text">
                                    <strong>Price:</strong> ₱<?php echo number_format($product['srp'], 2); ?><br>
                                </p>
                                <a href="product.php?id=<?php echo $product['product_ID']; ?>" class="btn btn-primary w-100" style="margin-top: auto; margin-right: 25px">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?><?php else : ?>
                <p class="text-center">No featured products available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- DSS Section -->
<div style="padding-top: 100px; padding-bottom: 350px; width: 100%; height: auto; position: relative; background-image: url('assets/images/banner-dss.png'); background-size: cover; background-position: center;">
  <!-- Content Layer (Text and Button) -->
    <div style="width: 100%; height: 300px; position: absolute; left: 0; top: 0; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; color: black;">
        <div style="font-size: 64px; font-family: Work Sans; font-weight: 600; word-wrap: break-word;">Don’t know what to buy?</div>
        <div style="font-size: 16px; font-family: Lato; font-weight: 400; word-wrap: break-word; margin-top: 10px;">Check our “Parts Recommendation System” helps you figure out your needs!</div>
        <div style="width: 162.35px; height: 59.87px; margin-top: 20px; position: relative;"></div>
        <div style="width: 7%; height: 130%; background: #1A54C0; border-radius: 74px; margin-bottom: 101px"></div>
        <div style="position: absolute; top: 55%; left: 0; width: 100%; height: 100%; text-align: center; color: white; font-size: 16px; font-family: Lato; font-weight: 700; word-wrap: break-word;">Get Started</div>
    </div>
</div>
<br><br><br><br><br><br>

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