<?php
session_start(); // Start the session
include('../../config/db_config.php'); // Include the database connection file

header('Content-Type: application/json'); // Ensure JSON response header

$response = ["status" => "error", "message" => "An unknown error occurred."]; // Default response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    // Prepare the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $stmt->bind_param("s", $usernameInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password hash
        if (password_verify($passwordInput, $user['password'])) {
            // Set session variables
            $_SESSION['user_ID'] = $user['user_ID'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['isLoggedIn'] = true;

            // Return success response
            $response = [
                "status" => "success",
                "message" => "Login successful!",
                "first_name" => $user['first_name'],
            ];
        } else {
            // Incorrect password
            $response = ["status" => "error", "message" => "Incorrect password!"];
        }
    } else {
        // Username not found
        $response = ["status" => "error", "message" => "Username not found!"];
    }
} else {
    $response = ["status" => "error", "message" => "Invalid request method."];
}

echo json_encode($response);
$conn->close();
