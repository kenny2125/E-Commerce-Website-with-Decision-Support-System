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
        <div class="modal-content">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Create an Account</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-box">
                        <p>Already have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a>
                        </p>
                        <form action="pages/user/user_register.php" method="post">
                            <div class="row">
                                <div class="input-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" placeholder="eg. Danel" name="firstName" required>
                                </div>
                                <div class="input-group">
                                    <label for="middleInitial">M.I</label>
                                    <input type="text" id="middleInitial" placeholder="eg. T." name="middleInitial">
                                </div>
                                <div class="input-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" placeholder="eg. Oandasan" name="lastName" required>
                                </div>
                                <div class="input-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" id="gender" placeholder="eg. Female" name="gender">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" placeholder="eg. BLK 5 LOT 6 SAMMAR 1 HOA Luzon Ave. Old Balara, Quezon City" name="address" required>
                            </div>
                            <div class="row">
                                <div class="input-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" placeholder="eg. danel@gmail.com" name="email" required>
                                </div>
                                <div class="input-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" placeholder="eg. 18" name="age" required>
                                </div>
                                <div class="input-group">
                                    <label for="contactNumber">Contact Number</label>
                                    <input type="text" id="contactNumber" placeholder="eg. 09123456789" name="contactNumber" required>
                                </div>
                            </div>
                            <div class="input-group">   
                                <label for="username">Username</label>
                                <input type="text" id="username" placeholder="eg. jeondanel" name="username" required>
                            </div>
                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div id="passwordFeedback" class="form-text text-danger"></div>
                            </div>
                            <!-- Confirm Password Field -->
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" name="confirmPassword" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div id="confirmPasswordFeedback" class="form-text text-danger"></div>
                            </div>

                            <!-- Terms and Conditions -->
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

    <!-- Featured Products -->
    <div class="featured-products-wrapper" style="margin-bottom: 100px;">
        <div class="container my-4">
            <h2 class="text-center mb-4">Featured Products</h2>
            <div class="row g-3">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col-sm-6 col-md-4 col-lg-2">
                        <div class="card">
                            <img src="assets/images/defaultproduct.png" class="card-img-top img-fluid" alt="Product <?= $i ?>">
                            <div class="card-body">
                                <h5 class="card-title">Product <?= $i ?></h5>
                                <p class="card-text">Price <?= $i ?></p>
                                <a href="#" class="btn btn-primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
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

 <?php include 'includes/footer.php'; ?>
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
    // Toggle password visibility
    document.querySelectorAll('button[id^="togglePassword"]').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });
</script>
