<?php 
if (isset($_POST['logIn'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($username && $password) {
        try {
            // Query to check the user's credentials
            $checkUser = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
            $checkUser->execute([$username]);
            $user = $checkUser->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: ../pages/home.php'); // Redirect to the home page or another page
                exit;
            } else {
                echo "Invalid username or password!";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Username and password are required!";
    }
}
?>