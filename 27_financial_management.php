<?php
session_start();
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$database = "Bookstore";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Construct the SQL query based on the search parameters
$sql = "SELECT sum(price) FROM books"; // Base query to retrieve all books
$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display order information (customize this based on your database structure)
        echo "All books worth: " . $row["sum(price)"] . "<br>";
    }
}


// Close the database connection
$conn->close();
?>

<button onclick="window.location.href='24_dashboard_manager.php'">Manager Page</button>
<button onclick="window.location.href='bookstore.php'">Homepage</button>




