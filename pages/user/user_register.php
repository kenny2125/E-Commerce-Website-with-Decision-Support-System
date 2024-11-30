<?php
session_start();

// Database credentials
$host = "erxv1bzckceve5lh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "vg2eweo4yg8eydii";
$password = "rccstjx3or46kpl9";
$db_name = "s0gp0gvxcx3fc7ib";

// Establish a database connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signUp'])) {
    $first_name = $_POST['firstName'];
    $middle_init = $_POST['middleInitial'];
    $last_name = $_POST['lastName'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contactNumber'];
    $age = $_POST['age']; // New input field for age
    $role = "customer"; // Default role for a new user
    $username = $_POST['username'];
    $password = $_POST['passwordReg'];

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM tbl_user WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $email); // 's' indicates the type is string
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        echo "Email already exists!";
    } else {
        // Check if the username already exists
        $checkUsernameQuery = "SELECT * FROM tbl_user WHERE username = ?";
        $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
        $checkUsernameStmt->bind_param("s", $username); // 's' indicates the type is string
        $checkUsernameStmt->execute();
        $checkUsernameResult = $checkUsernameStmt->get_result();

        if ($checkUsernameResult->num_rows > 0) {
            echo "Username already exists!";
        } else {
            // Insert the new user into tbl_user
            $insertQuery = "
                INSERT INTO tbl_user (
                    first_name, middle_initial, last_name, gender, address, contact_number, email, age, role, username, password
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";
            $insertStmt = $conn->prepare($insertQuery);
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
            $insertStmt->bind_param("sssssssssss", $first_name, $middle_init, $last_name, $gender, $address, $contact_number, $email, $age, $role, $username, $hashedPassword);
            
            if ($insertStmt->execute()) {
                // Set a session variable to indicate that the user has successfully registered
                $_SESSION['registration_success'] = true;
                header('Location: ../../index.php'); // Redirect to the main page
                exit;
            } else {
                echo "Error: Unable to create account.";
            }
            
        }
    }
}

?>
