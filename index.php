<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <!-- forgot password input form -->
    <form action="pages/mail.php" method="post">
        <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>">
        <button type="submit">Submit</button>
    </form>

    
    <button class="button" type="button" onclick="location.href='pages/register.php'">Register</button><br>
    <button class="button" type="button" onclick="location.href='pages/forgot-password.php'">Forgot Password</button><br>
    <button class="button" type="button" onclick="location.href='pages/login.php'">Login</button><br><br>
    

</body>
</html>