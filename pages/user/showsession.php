<?php
// Start the session
session_start();

// Check if the session contains any data
if (!empty($_SESSION)) {
    echo "<h3>Session Contents:</h3>";
    echo "<pre>";
    print_r($_SESSION); // Display all session variables in a readable format
    echo "</pre>";

    // Add a button to destroy the session
    echo "<form action='' method='post'>";
    echo "<input type='submit' name='logout' value='Logout'>";
    echo "</form>";
} else {
    echo "<p>No session data available.</p>";
}

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    echo "<p>Session destroyed. You have been logged out.</p>";
}
?>
