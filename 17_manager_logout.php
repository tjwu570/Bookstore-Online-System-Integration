
<!-- session_start(): This function starts the PHP session and allows you to store and retrieve session data.
session_destroy(): This function destroys all session data, effectively logging out the user. It clears all session variables and removes the session cookie.
header("Location: login.php"): This line redirects the user to the login page after destroying the session. You should replace "login.php" with the appropriate URL or filename of your login page.
exit: This function ensures that no additional code is executed after the redirect, preventing any potential issues.
Remember to include the necessary configuration to establish a connection with your MySQL database at the beginning of the script if you haven't already done so. Additionally, modify the redirect location as needed to match the actual filename or URL of your login page.
This script will effectively log out the user by destroying the session and redirecting them to the login page. -->


<?php
// Start the session
session_start();

// Destroy the session data
session_destroy();

// Redirect the user to the login page
header("Location: bookstore.php");
exit;
?>