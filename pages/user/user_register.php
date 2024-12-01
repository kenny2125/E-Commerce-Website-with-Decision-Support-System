<?php
session_start();

// Include the database configuration file
include '../../config/db_config.php'; // Adjust the relative path to match your file structure

if (isset($_POST['signUp'])) {
    $first_name = $_POST['firstName'];
    $middle_init = $_POST['middleInitial'];
    $last_name = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactNumber'];
    $age = $_POST['age'];
    $role = "customer"; // Default role for a new user
    $username = $_POST['username'];
    $password = $_POST['passwordReg'];
    $confirm_password = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Check if the email already exists
    $checkEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
    $resultEmail = $conn->query($checkEmail);

    if ($resultEmail->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Check if the username already exists
        $checkUsername = "SELECT * FROM tbl_user WHERE username = '$username'";
        $resultUsername = $conn->query($checkUsername);

        if ($resultUsername->num_rows > 0) {
            echo "Username already exists!";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new user into tbl_user
            $insertQuery = "
                INSERT INTO tbl_user (
                    first_name, middle_initial, last_name, gender, address, contact_number, email, age, role, username, password
                ) VALUES (
                    '$first_name', '$middle_init', '$last_name', '$gender', '$address', '$contact_number', '$email', '$age', '$role', '$username', '$hashedPassword'
                )
            ";

            if ($conn->query($insertQuery) === TRUE) {
                header('Location: ../../index.php'); // Redirect to login page
                exit;
            } else {
                echo "Error: Unable to create account.";
            }
        }
    }

    // Close the connection
    $conn->close();
}
?>
