<?php
session_start();

if (isset($_POST['logIn'])) {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $db_username = "vg2eweo4yg8eydii";
    $db_password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";

    // Establish a database connection
    $conn = new mysqli($host, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Connection issue
    }

    // Query to fetch user data based on the username
    $query = "SELECT * FROM tbl_user WHERE username = '$usernameInput'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($passwordInput, $user['password'])) {
            // Set session variables for logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name']; // Optional: First name
            $_SESSION['role'] = $user['role']; // Set user role in session
            $_SESSION['isLoggedIn'] = true; // Mark the session as logged in

            // Role-based redirection
            if ($_SESSION['role'] == 'admin') {
                // Redirect to the admin dashboard
                header('Location: ../../index.php');
            } else if ($_SESSION['role'] == 'customer') {
                // Redirect to the customer dashboard
                header('Location: ../../index.php');
            } else {
                // If role is not recognized, redirect to a general page
                header('Location: ../../index.php');
            }
            exit;
        } else {
            $_SESSION['login_error'] = 'Incorrect password!';
        }
    } else {
        $_SESSION['login_error'] = 'Username not found!';
    }

    // Close the connection
    $conn->close();

    // Redirect back to login page
    header('Location: ../../index.php');
    exit;
}
?>
