<?php
session_start();
include('../../config/db_config.php'); 

header('Content-Type: application/json'); 

$response = ["status" => "error", "message" => "An unknown error occurred."];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
    $stmt->bind_param("s", $usernameInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($passwordInput, $user['password'])) {
            $_SESSION['user_ID'] = $user['user_ID'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['isLoggedIn'] = true;
            $response = [
                "status" => "success",
                "message" => "Login successful!",
                "first_name" => $user['first_name'],
            ];
        } else {
            $response = ["status" => "error", "message" => "Incorrect password!"];
        }
    } else {
        $response = ["status" => "error", "message" => "Username not found!"];
    }
} else {
    $response = ["status" => "error", "message" => "Invalid request method."];
}

echo json_encode($response);
$conn->close();
