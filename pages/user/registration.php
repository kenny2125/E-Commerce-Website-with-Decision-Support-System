<!DOCTYPE html>
<html lang="en">
<head>
    <title>RPC Computer Store</title>
    <link rel="stylesheet" href="../assets/css/registration.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <img src="../assets/images/logo.png" alt="RPC Computer Store Logo">
            <h1>CREATE AN ACCOUNT</h1>
            <p>Already have an account? <a href="../pages/login.html" class="login">Log In</a></p>
            <form action="register.php" method="post">
                <div class="row">
                    <div class="input-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" placeholder="eg. Danel" name="firstName" required>
                    </div>
                    <div class="input-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" placeholder="eg. Oandasan" name="lastName" required>
                    </div>
                    <div class="input-group">
                        <label for="middleInitial">M.I</label>
                        <input type="text" id="middleInitial" placeholder="eg. T." name="middleInitial">
                    </div>
                    <div class="input-group">
                        <label for="gender">Gender</label>
                        <input type="text" id="gender" placeholder="eg. Female" name="gender">
                    </div>
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="eg. jeondanel" name="username" required>
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
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" id="contactNumber" placeholder="eg. 09123456789" name="contactNumber" required>
                    </div>
                </div>
                <div class="password-container input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="••••••••" name="password" required>
                    <img src="../assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon1" style="cursor: pointer;">
                    <div id="passwordFeedback" class="feedback"></div>
                </div>
                <div class="confirmpassword-container input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" placeholder="••••••••" name="confirmPassword" required>
                    <img src="../assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon2" style="cursor: pointer;">
                    <div id="confirmPasswordFeedback" class="feedback"></div>
                </div>
                <div class="terms">
                    <input type="checkbox" name="terms" required/>Agree on <a href="#">Terms and Conditions</a>
                </div>
                <button type="submit" name="signUp">SIGN UP</button>
            </form>
        </div>
    </div>
    <script src="/assets/js/registration.js"></script>
</body>
</html>