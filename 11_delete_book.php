
<!-- In this structure, the script starts by establishing a connection to the MySQL database using the provided credentials. Then, it retrieves the book details, such as title and price, from the database based on the provided book ID. The script can also include logic to apply discounts based on VIP status or coupons.
After calculating the total price, the script inserts the order details, including the user ID, book ID, edition ID, quantity, and total price, into the orders table in the database. It handles successful and failed order placements by displaying appropriate messages to the user.
Finally, the script closes the database connection. You can customize and enhance this structure based on your specific requirements and the schema of your database. Remember to create appropriate HTML forms and pages to allow users to input the necessary information for placing an order. -->


<?php
session_start();
// Connect to the MySQL database
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$dbname = "Bookstore";
$book_id = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $book_id = $_POST["book_id"];

    $userID = $_SESSION["user_id"];
    $orderQuery = "delete from books where id = $book_id";

    if ($conn->query($orderQuery) === TRUE) {
        // Display success message to the user
        echo "Book deleted!";
    } else {
        // Display error message if the order couldn't be placed
        echo "Error deleting the : " . $conn->error;
    }


    // Close the database connection
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete book</title>
</head>
<body>
    <h1>Delete book</h1>
    <?php
    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    ?>
    <form method="POST" action="11_delete_book.php">

        <label>Book ID:</label>
        <input type="text" name="book_id" required><br><br>
        
        
        <input type="submit" value="Confirm">
    </form>
    <a href="bookstore.php">Back to homepage</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>

