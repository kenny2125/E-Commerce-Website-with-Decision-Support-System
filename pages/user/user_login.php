<?php
session_start();

// Include database connection and necessary code...
if (isset($_POST['logIn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $username = "vg2eweo4yg8eydii";
    $password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";
    
    // Establish a database connection
    $conn = new mysqli($host, $username, $password, $db_name);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch user data based on the username
    $query = "SELECT * FROM tbl_user WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables for logged in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Redirect to a protected page or dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            // Password incorrect
            $_SESSION['login_error'] = 'Incorrect password!';
            header('Location: ../../index.php'); // Redirect to login page with error message
            exit;
        }
    } else {
        // User not found
        $_SESSION['login_error'] = 'Username not found!';
        header('Location: ../../index.php'); // Redirect to login page with error message
        exit;
    }
}
?>
