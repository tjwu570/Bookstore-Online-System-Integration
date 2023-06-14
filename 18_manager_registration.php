<?php
// Include the necessary files and establish a database connection
// include 'config.php';
// include 'functions.php';
$db = new mysqli('localhost', 'benson', 'benson123benson12', 'Bookstore');

// Define any necessary variables
$error = '';
$success = '';

function insert_user($db, $username, $password) {
    // Escape the username to prevent SQL injection
    $escaped_username = mysqli_real_escape_string($db, $username);
    $escaped_password = mysqli_real_escape_string($db, $password);

    // Hash the password
    // $hashed_password = password_hash($escaped_password, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $query = "INSERT INTO managers (username, password) VALUES ('$escaped_username', '$escaped_password')";

    // Execute the query
    mysqli_query($db, $query);
} 

function checkUserExists($connection, $username) {
    // Escape the username to prevent SQL injection
    $escaped_username = mysqli_real_escape_string($connection, $username);

    // Prepare the SQL query
    $query1 = "SELECT * FROM users WHERE username = '$escaped_username'";

    // Execute the query
    $result1 = mysqli_query($connection, $query1);

    // Check if any rows are returned
    if (mysqli_num_rows($result1) > 0) {
        // User exists
        return true;
    }
    else{
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Retrieve and validate other form fields as needed

    // Perform input validation
    if (empty($username) || empty($password)) {
        if (empty($username))
            $error = 'Please fill in the username field.';
        else if (empty($password))
            $error = 'Please fill in the password field.';
    } else {

        $user_exists = checkUserExists($db, $username);

        if (!$user_exists) {
            insert_user($db, $username, $password);
            // Display success message or redirect to a success page
            $success = 'Manager registration successful!';
        } else {
            $error = 'Username already exists.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Registration</title>
    <!-- Include any necessary CSS or JavaScript files -->
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body>
    <h2>Manager Registration</h2>

    <!-- Display error message if applicable -->
    <?php if (!empty($error)) : ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Display success message if applicable -->
    <?php if (!empty($success)) : ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <!-- Registration form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>
        <!-- Include other necessary form fields -->

        <input type="submit" value="Register">
    </form>

    <!-- Include any additional content or links -->

</body>
</html>
