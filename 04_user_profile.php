
<!-- In this example, we first establish a connection to the MySQL database using the mysqli extension. Then, we retrieve the user ID from the session variable (assuming it was set after the user logged in). Next, we construct a SQL query to select the user's information from the users table using the user ID.
If the query returns one or more rows, we retrieve the user's information and store it in variables. Finally, we display the user's information using HTML markup.
Please note that this is a basic example and may need to be adapted based on your specific database schema and table structure. Additionally, it's important to sanitize and validate user input to prevent SQL injection and ensure data security. -->


<?php
session_start();
// Connect to the MySQL database
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$dbname = "Bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function update_profile($conn, $userID){
    $username = $_POST["username"];
    $name = $_POST["name"];
    $phoneNumber = $_POST["phone_number"];
    $email = $_POST["email"];
    
    $sql = "UPDATE users SET username = '$username', name = '$name', phone_number = '$phoneNumber', email = '$email' WHERE id = $userID";
    $result = $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["password"];
    $phoneNumber = $_POST["phone_number"];
    $email = $_POST["email"];
    update_profile($conn, $_SESSION['user_id']);
    echo "Update successful";
}


// Retrieve user information from the database
$userID = $_SESSION["user_id"]; // Assuming user ID is stored in a session variable after login

$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = $conn->query($sql);


if ($result->num_rows > 0) { // Check if the query returns any rows
    // User found, display user information
    $row = $result->fetch_assoc(); // Fetch the user information from the query result
    $username = $row["username"];
    $name = $row["name"];
    $phoneNumber = $row["phone_number"];
    $email = $row["email"];
    // Add more fields as needed

    // Display user information in HTML
    ?>

    <h1>Update Profile</h1>
    <form method="POST" action="4_user_profile.php">
    <!-- <form method="post" onsubmit="update_profile(); return false;">  -->

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>"><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>"><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" id="phone_number" value="<?php echo $phoneNumber; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>"><br>

        <!-- Add more HTML for other user information -->
        <input type="submit" value="Update">
        <a href="bookstore.php">Back to homepage</a>

    </form>

    <?php
} else {
    // User not found
    echo "User not found.";
}


// Close the database connection
$conn->close();
?>
