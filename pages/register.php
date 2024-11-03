<?php
session_start();
include 'database.php';

if (isset($_POST['signUp'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $middle_init = $_POST['middleInitial'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactNumber'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $checkEmail = "SELECT * FROM tbl_user_profile WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO tbl_user (first_name, last_name, middle_init, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $middle_init, $username, $password);
        if ($stmt->execute()) {
            header('Location: ../pages/login.php'); // Change this to your desired redirection
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['logIn'])) {
    // Ensure username and password are set before using them
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username && $password) {
        // Query to check the user's credentials
        $checkUser = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";
        $result = $conn->query($checkUser);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header('Location: ../pages/forgot-password.html'); // Change this to your desired redirection
            exit;
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Username and password are required!";
    }
}
?>