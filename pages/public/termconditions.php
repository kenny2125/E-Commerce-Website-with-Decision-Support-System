<?php
include '../../includes/header.php';
include '../../config/db_config.php';
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

<div class="container">
        <!-- Back button -->
        <div class="back" id="backButton" style="margin-top: 30px; right: 20px; margin-bottom: 30px; font-size: 23px; color: #A9A9A9; margin-left: 1790px;">
            <a href="/index.php" style="text-decoration: none; color: inherit;">Back</a>
        </div>
            <img src="/assets/images/terms.png" alt="Logo" class="logo" style="width: 95%;">

    <h1 class="terms-and-condition" style="margin-top: 20px; margin-left: 65px;"><img src="/assets/images/format-list-text.png" alt="Call Icon" style="margin-right:10px;">Terms and Condition</h1>

        <div class="these-terms-and"style="text-align: justify; margin-bottom: 35px; margin-left: 200px; margin-right: 170px; font-size: 20px;">
            These Terms and Conditions govern your access to and use of our website, services, and products. By using our website, you agree to comply with and be bound by these terms. If you do not agree to these Terms and Conditions, you should not use our services. We reserve the right to modify these terms at any time, and any changes will be posted on this page. Your continued use of the site after any modifications indicates your acceptance of the updated Terms and Conditions.
        </div>

        <!-- Information We Collect Section -->
        <div class="information-we-collect-container">
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 25px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">Information We Collect: </b>
                <span>We collect information that you provide directly to us, such as when you create an account, make a purchase, or communicate with us. This information may include your name, email address, phone number, payment information, and any other details you choose to provide.</span>
            </p>
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 25px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">How We Use Your Information:</b>
                <span>We use the information we collect to process transactions, personalize your experience, improve our website, provide customer support, and communicate with you about products, services, and promotions. We may also use your information for analytics to enhance the functionality and performance of our services.</span>
            </p>
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 25px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">How We Disclose Your Information: </b>
                <span>We may share your information with trusted third-party service providers who assist us in operating our business, such as payment processors and shipping companies. We ensure these partners handle your data securely and only for purposes aligned with our privacy practices. We may also share information as required by law or to protect our legal rights.</span>
            </p>
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 25px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">Security:</b>
                <span>We are committed to protecting your information and have implemented industry-standard security measures to prevent unauthorized access, disclosure, alteration, or destruction of your data. While we strive to safeguard your information, please note that no method of electronic storage is 100% secure.</span>
            </p>
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 25px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">Third-Party Websites:</b>
                <span>Our website may contain links to third-party websites for your convenience. These sites have their own privacy policies, and we encourage you to review them. We are not responsible for the privacy practices or content of third-party sites.</span>
            </p>
            <p class="information-we-collect-we-col" style="text-align: justify; margin-bottom: 80px; margin-left: 150px; margin-right: 170px; font-size: 20px;">
                <b class="information-we-collect">Children’s Privacy:</b>
                <span>Our services are not directed at children under 13, and we do not knowingly collect personal information from children. If we become aware of data collected from children without parental consent, we will take steps to delete it promptly.</span>
            </p>
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