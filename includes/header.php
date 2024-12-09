<link rel="stylesheet" href="/assets/css/header.css">
<?php
session_start(); // Start the session

// Check if the user is logged in
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false; // Safe check for isLoggedIn

// Check if the user is an admin
$isAdmin = ($_SESSION['role'] ?? '') === 'admin'; // Check if role is 'admin'

// Load the user ID
$user_ID = $_SESSION['user_ID'] ?? null; // Safely get the user ID if set

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

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <!-- Clickable Logo -->
        <a href="/index.php">
            <img src="/assets/images/rpc-logo-black.png" alt="Logo" class="logo">
        </a>
        
<!-- Search Bar -->
            <form action="<?php echo basename($_SERVER['SCRIPT_NAME']) === 'Products_List.php' ? 'Products_List.php' : '/pages/shop/Products_List.php'; ?>" 
                method="get" 
                class="d-flex search-bar">
                <input class="form-control me-2" 
                    type="search" 
                    name="search_query" 
                    placeholder="Search for product(s)" 
                    aria-label="Search" 
                    value="<?php echo isset($_SESSION['search_query']) ? $_SESSION['search_query'] : ''; ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        
        <!-- User-specific Content -->
        <?php if ($isLoggedIn === true): ?>
            <!-- If logged in, display welcome message and role -->
            <div class="navbar-text d-flex align-items-center">
                <div class="icon-container">
                    <!-- Cart and Profile Links -->
                    <a href="/pages/shop/Carts_List.php">
                        <img src="/assets/images/Group 204.png" alt="Cart Icon">
                    </a>
                    <a href="/pages/user/user_profile.php">
                        <img src="/assets/images/Group 48.png" alt="Profile Icon">
                    </a>

                    <!-- Admin Link (only visible to admins) -->
                    <?php if ($isAdmin): ?>
                        <a href="/pages/admin/admin_dashboard.php">
                            <img src="/assets/images/Group 446.png" alt="Admin Icon">
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
                    <img src="/assets/images/rpc-logo-black.png" alt="RPC Computer Store" class="rpc-logo">
                </h5>
            </div>
            <div class="modal-body">
                <!-- Form content -->
                <div id="modalContent" class="form-box">
                    <form id="loginForm">
                        <div class="input-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" placeholder="eg.jeondanel" required class="input-field">
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" required class="input-field">
                            <img src="/assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon" style="cursor: pointer;">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn login-btn">Login</button>
                        </div>
                    </form>
                </div>
                <p>Don't have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#registrationModal" data-dismiss="modal">Create Account</a>
                </p>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" style="text-align: center; display: none; margin-top: 20px;">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p>Processing...</p>
                </div>
                <!-- Error message -->
                <div id="loginError" class="error-message" style="color: red; display: none; margin-top: 10px;"></div>
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
                <img src="/assets/images/rpc-logo-black.png" alt="RPC Computer Store" class="rpc-logo">
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-box">
                        <h3>Create an Account</h3>
                        <p>Already have an account? 
                            <a href="#" class="create-account" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Log In</a>
                        </p>
                        <form action="/pages/user/user_register.php" method="post" onsubmit="return validateForm()">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');
    const modalContent = document.getElementById('modalContent');
    const loginError = document.getElementById('loginError');
    const loadingSpinner = document.getElementById('loadingSpinner');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Hide error message and show loading spinner
        loginError.style.display = 'none';
        loadingSpinner.style.display = 'block';

        // Send AJAX request
        fetch('/pages/user/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
            loadingSpinner.style.display = 'none'; // Hide spinner

            if (data.status === 'success') {
                // Display success message in the modal
                $('#loginModal').modal('hide'); // Hide the login modal
                setTimeout(() => {
                    showSuccessModal(data.first_name); // Show success modal
                }, 300); // Add a slight delay for smooth transition
            } else {
                // Display error message in the modal
                loginError.textContent = data.message;
                loginError.style.display = 'block';
            }
        })
        .catch(() => {
            loadingSpinner.style.display = 'none'; // Hide spinner
            loginError.textContent = 'An unexpected error occurred. Please try again.';
            loginError.style.display = 'block';
        });
    });

    function showSuccessModal(firstName) {
        const successModalHtml = `
            
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="border-radius: 20px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">Welcome Back!</h5>
                        </div>
                        <div class="modal-body text-center">
                            <h3>Hello, ${firstName}!</h3>
                            <p>You have successfully logged in.</p>
                            <button class="btn btn-primary" onclick="window.location.href='/index.php';">Go to Home</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', successModalHtml);
        $('#successModal').modal('show');
    }
});
</script>

<script>
    document.getElementById("backButton").addEventListener("click", function () {
    if (document.referrer) {
    // Go back if there's a previous page
    window.history.back();
    } else {
    // Redirect to the main page if there's no history
    window.location.href = "/index.php"; // Change to your main page URL
    }
});

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