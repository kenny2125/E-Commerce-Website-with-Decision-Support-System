<?php
session_start();

// Include the database configuration file
include '../../config/db_config.php'; // Adjust the relative path to match your file structure

if (isset($_POST['login'])) {
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
                
                            // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: ../admin/admin_dashboard.php');
                } else {
                    header('Location: /index.php');
                }
                exit;

            } else {
                echo "Invalid username or password!";
            }
        } else {
            echo "Invalid username or password!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
