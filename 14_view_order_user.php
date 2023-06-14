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
$sql = "SELECT * FROM orders WHERE user_id=".$_SESSION["user_id"]; // Base query to retrieve all books
$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display order information (customize this based on your database structure)
        echo "Order ID: " . $row["id"] . "<br>";
        echo "Book ID: " . $row["book_id"] . "<br>";
        echo "Shipping method: " . $row["shipping_method"] . "<br>";
        echo "Invoice method: " . $row["invoice_method"] . "<br>";
        echo "Payment method: " . $row["payment_method"] . "<br>";
        echo "Price: " . $row["price"] . "<br>";
        echo "Discount: " . $row["discount"] . "<br>";
        echo "<hr>";
    }
}
else{
    echo "No books found.";
}   

// Close the database connection
$conn->close();
?>




