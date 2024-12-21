<?php
session_start();


include '../../config/db_config.php'; 

if (isset($_POST['signUp'])) {
    $first_name = $_POST['firstName'];
    $middle_init = $_POST['middleInitial'];
    $last_name = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactNumber'];
    $age = $_POST['age'];
    $role = "customer"; // pang customer
    $username = $_POST['username'];
    $password = $_POST['passwordReg'];
    $confirm_password = $_POST['confirmPassword'];

 
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    $checkEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
    $resultEmail = $conn->query($checkEmail);

    if ($resultEmail->num_rows > 0) {
        echo "Email already exists!";
    } else {

        $checkUsername = "SELECT * FROM tbl_user WHERE username = '$username'";
        $resultUsername = $conn->query($checkUsername);

        if ($resultUsername->num_rows > 0) {
            echo "Username already exists!";
        } else {
       
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $insertQuery = "
                INSERT INTO tbl_user (
                    first_name, middle_initial, last_name, gender, address, contact_number, email, age, role, username, password
                ) VALUES (
                    '$first_name', '$middle_init', '$last_name', '$gender', '$address', '$contact_number', '$email', '$age', '$role', '$username', '$hashedPassword'
                )
            ";

            if ($conn->query($insertQuery) === TRUE) {
                header('Location: ../../index.php'); 
                exit;
            } else {
                echo "Error: Unable to create account.";
            }
        }
    }

    $conn->close();
}
?>
