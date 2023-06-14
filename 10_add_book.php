
<?php
// Include the database connection file
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$database = "Bookstore";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publication_year = $_POST["publication_year"];
    $price = $_POST["price"];
    $edition = $_POST["edition"];
    $discount = $_POST["discount"];

    // Perform validation on the form data
    // ...

    // If the form data is valid, insert the book into the database
    $query = "INSERT INTO books (title, author, publication_year, price, edition, discount) 
              VALUES ('$title', '$author', '$publication_year', '$price', '$edition', '$discount')";

    if (mysqli_query($conn, $query)) {
        // Book added successfully
        echo "Book added successfully!";
    } else {
        // Error occurred while adding the book
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add Book</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="title">Book Name:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br>

        <label for="publication_year">Year of Publication:</label>
        <input type="text" id="publication_year" name="publication_year" required><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>

        <label for="edition">Edition:</label>
        <input type="text" id="edition" name="edition" required><br>
        
        <label for="discount">Discount:</label>
        <input type="text" id="discount" name="discount" required><br>
        


        <input type="submit" value="Add Book">

        <a href="bookstore.php">Back to homepage</a>

    </form>
</body>
</html>
