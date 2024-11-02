<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- forgot password input form -->
    <form action="mail.php" method="post">
        <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>">
        <button type="submit">Submit</button>
    </form>
</body>
</html>