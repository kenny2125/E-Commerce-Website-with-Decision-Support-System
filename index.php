<?php
session_start(); // Start the session

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Boolean flag for checking login status
$username = $isLoggedIn ? $_SESSION['username'] : ''; // Get username if logged in
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
        <?php if (!$isLoggedIn): ?>
            <!-- If not logged in, show login button -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Log In</button>
        <?php else: ?>
            <!-- If logged in, display welcome message -->
            <span class="navbar-text">Welcome, <?php echo htmlspecialchars($username); ?>!</span>
        <?php endif; ?>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">
                    <img src="assets/images/rpc-logo-black.png" alt="RPC Computer Store" class="rpc-logo">
                </h5>
            </div>
            <div class="modal-body">
                <div class="form-box">
                    <form id="loginForm" method="post">
                        <div class="input-group">
                            <label for="username">USERNAME</label>
                            <input type="text" id="username" name="username" placeholder="eg.jeondanel" required class="input-field">
                        </div>
                        <div class="input-group">
                            <label for="password">PASSWORD</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" placeholder="••••••••" required class="input-field">
                                <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon" style="cursor: pointer;">
                            </div>
                        </div>
                        <p>Don't have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#registrationModal" data-dismiss="modal">Create Account</a>
                        </p>
                        <button type="submit" class="button login-btn" name="logIn">LOG IN</button>
                    </form>
                    <div id="loginError" class="error-message"></div> <!-- Error message container -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: 'pages/user/user_login.php', // PHP file to handle login
            type: 'POST',
            data: formData,
            dataType: 'json', // Expect a JSON response
            success: function(response) {
                console.log('Response:', response); // Log the response to check its contents

                if (response.status === 'success') {
                    if (response.role === 'admin') {
                        window.location.href = 'pages/admin/admin_dashboard.php'; // Admin redirection
                    } else {
                        window.location.href = '/index.php'; // User redirection
                    }
                } else {
                    $('#loginError').text(response.message).show(); // Display error message if login fails
                }
            },
            error: function() {
                $('#loginError').text('An error occurred. Please try again.').show(); // Show error if AJAX fails
            }
        });
    });
});

</script>

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
                        <form action="pages/user/user_register.php" method="post">
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
                                    <div id="passwordFeedback" class="form-text text-danger"></div>
                                <div class="input-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" id="confirmPassword" class="form-control input-field" placeholder="Confirm password" name="confirmPassword" required>
                                    <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon2" style="cursor: pointer;">
                                </div>
                                    <div id="confirmPasswordFeedback" class="form-text text-danger"></div>
                                </div>
                                <div class="terms">
                                    <input type="checkbox" name="terms" required/> Agree to <a href="#">Terms and Conditions</a>
                                </div>
                                <button type="submit" name="signUp" class="btn btn-primary mt-3">SIGN UP</button>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->


<!-- Add JavaScript to open the modal if the parameter is set -->
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
    <div class="brand-logo-container overflow-hidden my-5" style="height: 150px;">
        <div class="brand-logo-wrapper d-flex">
            <?php 
            $brands = ["amd", "asus", "biostar", "coolermaster", "corsair", "cougar", "darkflash", "dell", "fanatec", "gigabyte", "gskill", "hp", "inplay", "intel", "kingston", "msi", "nvidia", "nvision", "nzxt", "samsung"];

            foreach (array_merge($brands, $brands) as $brand): ?>
                <img src="assets/images/brands/<?= $brand ?>.png" alt="<?= ucfirst($brand) ?>" class="brand-logo mx-3">
            <?php endforeach; ?>
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
    $sql = "SELECT product_ID, product_name, srp, img_data FROM tbl_products";
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
                                <a href="product.php?id=<?php echo $product['product_ID']; ?>" class="btn btn-primary w-100" style="margin-top: auto;">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
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
    <div style="font-size: 16px; font-family: Lato; font-weight: 400; word-wrap: break-word; margin-top: 10px;">
      Check our “Parts Recommendation System” helps you figure out your needs!
    </div>
    <div style="width: 162.35px; height: 59.87px; margin-top: 20px; position: relative;">
      <div style="width: 100%; height: 90%; background: #1A54C0; border-radius: 74px;"></div>
      <div style="position: absolute; top: 25%; left: 0; width: 100%; height: 100%; text-align: center; color: white; font-size: 16px; font-family: Lato; font-weight: 700; word-wrap: break-word;">
        Get Started
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br>

<?php 
include 'config/db_config.php';
include 'includes/footer.php'; ?>
</body>
</html>




<!-- <script>
                                const passwordInput = document.getElementById('password');
                                const confirmPasswordInput = document.getElementById('confirmPassword');
                                const passwordFeedback = document.getElementById('passwordFeedback');
                                const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');

                                function validatePassword() {
                                    if (passwordInput.value !== confirmPasswordInput.value) {
                                        confirmPasswordInput.setCustomValidity("Passwords do not match");
                                    } else {
                                        confirmPasswordInput.setCustomValidity("");
                                    }
                                }

                                passwordInput.addEventListener('input', validatePassword);
                                confirmPasswordInput.addEventListener('input', validatePassword);
                            </script> -->
<!-- Add this script at the end of your HTML -->
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordReg = document.getElementById('passwordReg');
    const confirmPassword = document.getElementById('confirmPassword');
    const togglePasswordIcon1 = document.getElementById('togglePasswordIcon1');
    const togglePasswordIcon2 = document.getElementById('togglePasswordIcon2');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const confirmPasswordFeedback = document.getElementById('confirmPasswordFeedback');

    togglePasswordIcon1.addEventListener('click', function() {
        if (passwordReg.type === 'password') {
            passwordReg.type = 'text';
            togglePasswordIcon1.src = '/assets/images/view.png';
        } else {
            passwordReg.type = 'password';
            togglePasswordIcon1.src = '/assets/images/closed.png';
        }
    });

    togglePasswordIcon2.addEventListener('click', function() {
        if (confirmPassword.type === 'password') {
            confirmPassword.type = 'text';
            togglePasswordIcon2.src = '/assets/images/view.png';
        } else {
            confirmPassword.type = 'password';
            togglePasswordIcon2.src = '/assets/images/closed.png';
        }
    });

    // Password validation: Requires uppercase, lowercase, numbers, and special characters
    function validatePassword() {
        const passwordValue = passwordReg.value;
        const confirmPasswordValue = confirmPassword.value;

        // Regex for password validation (uppercase, lowercase, number, special character)
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordRegex.test(passwordValue)) {
            passwordFeedback.textContent = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            passwordReg.setCustomValidity("Weak password");
        } else {
            passwordFeedback.textContent = "";
            passwordReg.setCustomValidity("");
        }

        // Check if passwords match
        if (passwordValue !== confirmPasswordValue) {
            confirmPassword.setCustomValidity("Passwords do not match");
            confirmPasswordFeedback.textContent = "Passwords do not match";
        } else {
            confirmPassword.setCustomValidity("");
            confirmPasswordFeedback.textContent = "";
        }
    }

    // Listen to changes in password and confirm password fields
    passwordReg.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);
});
</script>