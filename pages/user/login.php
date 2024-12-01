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

// Debugging: Connection successful
// echo "Database connection successful.<br>";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    // Debugging: Print the username and password (for testing purposes, remove in production)
    echo "Username entered: " . $usernameInput . "<br>";
    echo "Password entered: " . $passwordInput . "<br>";

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $stmt->bind_param("s", $usernameInput);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging: Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "User found in database. <br>";

        // Verify the password hash
        if (password_verify($passwordInput, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_ID'] = $user['user_ID']; // Assuming 'user_ID' is the primary key
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
            // $_SESSION['login_error'] = "Incorrect password!";
            echo "Password incorrect.<br>";
        }
    } else {
        // Username not found
        // $_SESSION['login_error'] = "Username not found!";
        echo "Username not found in the database.<br>";
    }

    // Redirect back to the login page to show the error
    // header('Location: ../../index.php');
    echo "Redirecting to the login page...<br>";
    exit;
}

// Close the connection
$conn->close();
?>
