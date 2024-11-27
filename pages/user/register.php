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
    $birth_date = $_POST['birth_date'];
    $role = "customer"; // Default role for a new user
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    try {
        // Check if the email already exists
        $checkEmail = $conn->prepare("SELECT * FROM tbl_user WHERE email = ?");
        $checkEmail->execute([$email]);

        if ($checkEmail->rowCount() > 0) {
            echo "Email already exists!";
        } else {
            // Check if the username already exists
            $checkUsername = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
            $checkUsername->execute([$username]);

            if ($checkUsername->rowCount() > 0) {
                echo "Username already exists!";
            } else {
                // Insert the new user into tbl_user
                $stmt = $conn->prepare("
                    INSERT INTO tbl_user (
                        first_name, middle_initial, last_name, gender, address, contact_number, email, birth_date, role, username, password
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
                if ($stmt->execute([
                    $first_name, $middle_init, $last_name, $gender, $address, $contact_number, $email, $birth_date, $role, $username, $hashedPassword
                ])) {
                    // Redirect to index.php and pass a query parameter to open the login modal
                    header('Location: index.php?modal=login');
                    exit;
                } else {
                    echo "Error: Unable to create account.";
                }
                
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


if (isset($_POST['logIn'])) {
    // Get the username and password from the form
    $username = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username && $password) {
        try {
            // Query to check if the user exists
            $checkUser = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
            $checkUser->execute([$username]);
            $user = $checkUser->fetch(PDO::FETCH_ASSOC);

            // Verify the hashed password
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role']; // Store the role for authorization if needed

                // Redirect to the home page or dashboard
                header('Location: ../pages/home.php');
                exit;
            } else {
                // Invalid credentials
                echo "Invalid username or password!";
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Missing username or password
        echo "Username and password are required!";
    }
}

?>
