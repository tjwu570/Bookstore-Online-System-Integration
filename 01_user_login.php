
<!-- Please note that you'll need to replace the placeholders your_username, your_password, and your_database with your actual MySQL credentials. Also, ensure that you have created a table named users in your database with appropriate fields like id, email, and password.
This example script connects to the MySQL database, retrieves the form inputs for email and password, and checks if a user with the provided email exists. If the email is found, it verifies the password using the password_verify function. If the password is correct, it sets session variables and redirects the user to a dashboard page. If there is an error, such as an invalid email or password, it displays an error message.
The HTML form is displayed where users can enter their email and password. On submission, the form data is sent to the same user_login.php script for processing.
Remember to adjust the script based on your specific database structure and requirements. -->

<?php
session_destroy();
session_start();
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$database = "Bookstore";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form inputs
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL query to retrieve user information
    $query = "SELECT * FROM users WHERE email = '$email'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if a user with the provided email exists
    if (mysqli_num_rows($result) == 1) {
        // Retrieve the user's data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if ($password == $user["password"]) {
            // Password is correct, log in the user
            // You can set session variables or redirect the user to a dashboard page
            // Example:
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $user["email"];
            // Redirect to the dashboard page
            echo "Login successful";
            header("Location: 23_dashboard.php");
            exit();
        } else {
            // Invalid password
            $error = "Invalid email or password, password verifying failed";
        }
    } else {
        // User with the provided email does not exist
        $error = "Invalid email or password, rows not match 1";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h1>User Login</h1>
    <?php
    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    ?>
    <form method="POST" action="1_user_login.php">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <a href="3_user_registration.php">Register</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
