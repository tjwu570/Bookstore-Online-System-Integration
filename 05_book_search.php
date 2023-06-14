
<!-- This script establishes a connection to the MySQL database using the provided credentials. It retrieves the search parameters from the HTML form and constructs an SQL query based on those parameters. The script then executes the query and displays the search results if any books match the search criteria.
Make sure to replace 'your_username', 'your_password', and 'your_database' with the appropriate values for your MySQL database. Also, customize the echo statements inside the while loop to display the book information based on your database structure.
Note: This code is a basic example and doesn't include security measures such as input validation or prepared statements to prevent SQL injection attacks. When implementing this code in a production environment, it's crucial to incorporate those security measures. -->



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
$sql = "SELECT * FROM books WHERE 1=1"; // Base query to retrieve all books


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $year = $_POST["year"];

    if (!empty($title)) {
        $sql .= " AND title LIKE '%$title%'";
    }
    if (!empty($author)) {
        $sql .= " AND author LIKE '%$author%'";
    }
    if (!empty($year)) {
        $sql .= " AND publication_year = $year";
    }

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
}
// Close the database connection
$conn->close();
?>


 

<!-- This HTML code creates a web interface with an input bar for search parameters and three buttons to search by title, author, or year. The form submits the search parameters to the PHP script above using the GET method. -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title"><br><br>
    <label for="author">Author:</label>
    <input type="text" id="author" name="author"><br><br>
    <label for="year">Year of Publication:</label>
    <input type="text" id="year" name="year"><br><br>
    <input type="submit" value="Search">
</form>


