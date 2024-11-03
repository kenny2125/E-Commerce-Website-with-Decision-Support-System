<!DOCTYPE html>
<html>
<head>
    <title>RPC Computer Store</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="search-container">
    <div class="form-box">
        <img src="../assets/images/logo.png" alt="RPC Computer Store">
        <form action="register.php" method="post">
            <div class="input-group">
                <label for="username">USERNAME</label>
                <div class="input-field">
                    <input type="text" id="username" placeholder="eg.jeondanel" name="username">
                </div>
                <label for="password">PASSWORD</label>
                <div class="input-field">
                    <input type="password" placeholder="••••••••" id="password" name="password">
                    <img src="../assets/images/closed.png" alt="Toggle Password" class="toggle-password" id="togglePasswordIcon" style="cursor: pointer;">
                </div>
                <p>Don't have an account? <a href="../pages/registration.php" class="create-account"> Create account.</a></p>
                <button class="button" name="logIn">LOG IN</button>
                <a href="../pages/forgot-password.html" class="forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>
<script src="/assets/js/login.js"></script>
</body>
</html>