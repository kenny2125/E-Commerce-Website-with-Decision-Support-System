<?php
session_start();

// Include the database configuration file
include '../../config/db_config.php'; // Adjust the relative path to match your file structure

$response = [];

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Fetch user details by username
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user details in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Prepare the response
                $response['status'] = 'success';
                $response['role'] = $user['role'];
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Invalid username or password!';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password!';
        }
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $e->getMessage();
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
