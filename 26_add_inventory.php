<?php
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
$sql = "SELECT * FROM books"; // Base query to retrieve all books

$result = $conn->query($sql);

// Display the search results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display book information (customize this based on your database structure)
        echo "Book ID: " . $row["id"] . "<br>"; 
        echo "Title: " . $row["title"] . "<br>";
        echo "Author: " . $row["author"] . "<br>";
        echo "Price: $" . $row["price"] . "<br>";
        echo "Edition: " . $row["edition"] . "<br>";
        echo "Discount: " . $row["discount"] . "<br>";
        echo "Year of Publication: " . $row["publication_year"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No books found.";
}   

// Close the database connection
$conn->close();
?>




