<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <title>Product Detail Page</title>
    <link rel="stylesheet" href="/assets/css/product-detail.css">
    <link rel="icon" href="/assets/images/rpc-favicon.png">
</head>
<body>

<?php
include '../../includes/header.php';
include '../../config/db_config.php';

// Product ID from URL or testing
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Session data
$isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
$userId = $_SESSION['user_ID'] ?? null;

// Cache expiration time (in seconds)
$cacheExpirationTime = 60 * 5; // 5 minutes (adjust as needed)

// Cache check and logic for product details
if (isset($_SESSION['product_' . $productId . '_cache']) && (time() - $_SESSION['product_' . $productId . '_cache_time'] < $cacheExpirationTime)) {
    // Use the cached product details
    $product = $_SESSION['product_' . $productId . '_cache'];
    $specification = json_decode($product['specification'], true);
} else {
    // No cache or cache expired, fetch product details from the database
    if ($productId > 0) {
        $query = "SELECT * FROM tbl_products WHERE product_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        $product = $result->fetch_assoc();

        if (!$product) {
            echo "Product not found!";
            exit;
        }

        // Cache the product details and specification
        $_SESSION['product_' . $productId . '_cache'] = $product;
        $_SESSION['product_' . $productId . '_cache_time'] = time();

        $specification = json_decode($product['specification'], true);
    } else {
        echo "Invalid product ID!";
        exit;
    }
}
?>

<?php


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
<div class="container my-5">
    <div class="row" style="margin-top: 80px;">
        <!-- Product Image Column -->
        <div class="col-12 col-md-3 text-center d-flex justify-content-center" style="background-color: #FFF; height: 400px; margin-left: 7px; margin-right: 50px; margin-top: -10px; margin-bottom: 100px; box-shadow: 0 2px 8px #1A54C0; border-radius: 30px; overflow: hidden;">
            <?php
            $imgSrc = $product['img_data']
                ? 'data:image/jpeg;base64,' . base64_encode($product['img_data'])
                : 'path/to/default-image.jpg';
            ?>
            <img src="<?php echo $imgSrc; ?>" class="img-fluid rounded" alt="Product Image" style="object-fit: contain; max-width: 100%; max-height: 100%;">
        </div>

        <!-- Product Info Column -->
        <div class="col-12 col-md-4">
            <h2 class="fw-bold"><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p style="text-align: left; font-size: 18px;"><strong>Stock Available:</strong>
                <?php if ($product['quantity'] > 0): ?>
                    <span class="text-success">In Stock</span>
                <?php else: ?>
                    <span class="text-danger">Out of Stock</span>
                <?php endif; ?>
            </p>
            <p style="text-align: left; font-size: 18px;"><strong>Price:</strong> ₱<?php echo number_format($product['store_price'], 2); ?></p>
            <p style="text-align: justify; font-size: 18px;"><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>

            <form id="addToCartForm" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['product_ID']; ?>">
                <div class="d-flex align-items-center my-3">
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(-1)">-</button>
                    <input type="number" name="quantity" id="quantity" class="form-control mx-2" value="1" min="1" style="width: 50px; text-align: center;" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">+</button>
                </div>
                <?php if ($product['quantity'] > 0): ?>
                    <button type="submit" class="btn btn-primary" style="height: 40px; font-size: 16px; border-radius: 74px; background-color: #1A54C0; ">Add to Cart</button>
                <?php else: ?>
                    <button type="button" class="btn btn-secondary" disabled>Out of Stock</button>
                <?php endif; ?>
            </form>
            <div id="cartMessage" class="mt-3"></div>
        </div>

        <!-- Product Specifications Column -->
        <div class="col-12 col-md-4" style="text-align: justify; font-size: 18px;">
            <h4 class="fw-bold">Specification</h4>
            <ul>
                <?php
                if (is_array($specification)) {
                    foreach ($specification as $key => $value) {
                        echo "<li><strong>$key:</strong> $value</li>";
                    }
                } else {
                    echo htmlspecialchars($product['specification']);
                }
                ?>
            </ul>
        </div>
    </div>
</div>


<!-- Footer -->
<?php include '../../includes/footer.php'; ?>

</body>
</html>


<script>
function changeQuantity(amount) {
    const quantityInput = document.getElementById('quantity');
    let currentQuantity = parseInt(quantityInput.value) || 1;
    quantityInput.value = Math.max(1, currentQuantity + amount);
}

document.getElementById('addToCartForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('addtocart.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        const cartMessage = document.getElementById('cartMessage');
        cartMessage.innerHTML = `<span class="${data.status === 'success' ? 'text-success' : 'text-danger'}">${data.message}</span>`;
        setTimeout(() => cartMessage.innerHTML = '', 3000);
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('cartMessage').innerHTML = '<span class="text-danger">An unexpected error occurred.</span>';
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
