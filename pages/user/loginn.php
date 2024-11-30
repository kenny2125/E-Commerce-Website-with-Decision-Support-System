<?php
session_start(); // Start the session

// Database credentials
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$db_username = "vg2eweo4yg8eydii";
$db_password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";

// Establish a database connection
$conn = new mysqli($host, $db_username, $db_password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $stmt->bind_param("s", $usernameInput);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password hash
        if (password_verify($passwordInput, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_ID'] = $user['user_ID']; // Assuming 'id' is the primary key
            $_SESSION['first_name'] = $user['first_name']; // Assuming 'first_name' is a column
            $_SESSION['role'] = $user['role']; // Assuming 'role' is a column
            $_SESSION['isLoggedIn'] = true;

            // Debugging: Print session data
            echo "<h2>Session Data (Debugging)</h2>";
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

            // Redirect to the home or dashboard page
            header('Location: ../../index.php');
            exit;
        } else {
            // Incorrect password
            $_SESSION['login_error'] = "Incorrect password!";
        }
    } else {
        // Username not found
        $_SESSION['login_error'] = "Username not found!";
    }

    // Redirect back to the login page to show the error
    header('Location: ../login.php');
    exit;
}

// Close the connection
$conn->close();
?>
