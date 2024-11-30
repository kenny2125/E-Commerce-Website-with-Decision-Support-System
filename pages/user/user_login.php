<?php
session_start();

if (isset($_POST['logIn'])) {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    $host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $db_username = "vg2eweo4yg8eydii";
    $db_password = "rccstjx3or46kpl9";
    $db_name = "s0gp0gvxcx3fc7ib";

    echo "Username:"; // Debug: Show username
    // Establish a database connection
    $conn = new mysqli($host, $db_username, $db_password, $db_name);

    // Debug connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Connection issue
    } else {
        echo "Database connected successfully.<br>";
    }

    // Query to fetch user data based on the username
    $query = "SELECT * FROM tbl_user WHERE username = '$usernameInput'";
    echo "Query: $query<br>"; // Debug: Show query
    $result = $conn->query($query);

    if ($result) {
        echo "Query executed successfully.<br>";
        echo "Number of rows found: " . $result->num_rows . "<br>"; // Debug: Rows count
    } else {
        echo "Query failed: " . $conn->error . "<br>"; // Debug: Query error
    }

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "User found: " . print_r($user, true) . "<br>"; // Debug: Show fetched user

        // Verify password
        if (password_verify($passwordInput, $user['password'])) {
            echo "Password verification successful.<br>"; // Debug: Password correct

            // Set session variables for logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name']; // Optional: First name
            $_SESSION['role'] = $user['role']; // Optional: Role
            $_SESSION['isLoggedIn'] = true; // Mark the session as logged in

            echo "Login successful. Redirecting to dashboard.<br>"; // Debug: Successful login
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Password verification failed.<br>"; // Debug: Password mismatch
            $_SESSION['login_error'] = 'Incorrect password!';
        }
    } else {
        echo "No user found with username: $usernameInput<br>"; // Debug: User not found
        $_SESSION['login_error'] = 'Username not found!';
    }

    // Close the connection
    $conn->close();
    echo "Database connection closed.<br>"; // Debug: Connection closed

    // Redirect back to login page
    header('Location: ../../index.php');
    exit;
}
?>
