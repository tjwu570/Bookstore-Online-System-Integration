
<!-- In this structure, the script first checks for form submission using $_SERVER["REQUEST_METHOD"] == "POST". It retrieves the form data and performs input validation to ensure that all required fields are filled. Then, it checks if the username or email already exists in the database and inserts a new user record if they do not exist.
The script displays appropriate error and success messages based on the outcome of the registration process. The form itself collects user registration details such as username, password, email, phone, and any other necessary fields.
Remember to replace the placeholder comments with actual code for establishing a database connection, performing database queries, and including any necessary CSS or JavaScript files. -->


<?php
// Include the necessary files and establish a database connection
// include 'config.php';
// include 'functions.php';
$db = new mysqli('localhost', 'benson', 'benson123benson12', 'Bookstore');

// Define any necessary variables
$error = '';
$success = '';

function insert_user($db, $username, $password, $email, $name, $phone_number) {
    // Escape the username to prevent SQL injection
    $escaped_username = mysqli_real_escape_string($db, $username);
    $escaped_password = mysqli_real_escape_string($db, $password);
    $escaped_email = mysqli_real_escape_string($db, $email);
    $escaped_name = mysqli_real_escape_string($db, $name);
    $escaped_phone_number = mysqli_real_escape_string($db, $phone_number);

    // Hash the password
    // $hashed_password = password_hash($escaped_password, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $query = "INSERT INTO users (username, password, email, name, phone_number) VALUES ('$escaped_username', '$escaped_password', '$escaped_email', '$escaped_name', '$escaped_phone_number')";

    // Execute the query
    mysqli_query($db, $query);
} 

function checkUserExists($connection, $username, $email) {
    // Escape the username to prevent SQL injection
    $escaped_username = mysqli_real_escape_string($connection, $username);
    $escaped_email = mysqli_real_escape_string($connection, $email);

    // Prepare the SQL query
    $query1 = "SELECT * FROM users WHERE username = '$escaped_username'";
    $query2 = "SELECT * FROM users WHERE email = '$escaped_email'";

    // Execute the query
    $result1 = mysqli_query($connection, $query1);
    $result2 = mysqli_query($connection, $query2);

    // Check if any rows are returned
    if (mysqli_num_rows($result1) > 0) {
        // User exists
        return true;
    } 
    else if (mysqli_num_rows($result2) > 0){
        // User does not exist
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
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone'];
    // Retrieve and validate other form fields as needed

    // Perform input validation
    if (empty($username) || empty($password) || empty($email) || empty($phone_number)) {
        if (empty($username))
            $error = 'Please fill in the username field.';
        else if (empty($password))
            $error = 'Please fill in the password field.';
        else if (empty($email))
            $error = 'Please fill in the email field.';
        else if (empty($name))
            $error = 'Please fill in the name field.';
        else if (empty($phone_number));
    } else {
        // Check if the username or email already exists in the database, u

        $user_exists = checkUserExists($db, $username, $email);

        // If the username or email doesn't exist, insert the new user record into the database
        if (!$user_exists) {
            insert_user($db, $username, $password, $email, $name, $phone_number);
            // Display success message or redirect to a success page
            $success = 'User registration successful!';
        } else {
            $error = 'Username or email already exists.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <!-- Include any necessary CSS or JavaScript files -->
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body>
    <h2>User Registration</h2>

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

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Name:</label>
        <input type="name" name="name" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br>

        <!-- Include other necessary form fields -->

        <input type="submit" value="Register">
    </form>

    <!-- Include any additional content or links -->

</body>
</html>
