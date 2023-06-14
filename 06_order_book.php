
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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $book_id = $_POST["book_id"];
    $shipping = $_POST["shipping"];
    $payment = $_POST["payment"];
    $invoice = $_POST["invoice"];


    // Retrieve the book details from the database
    $bookQuery = "SELECT * FROM books WHERE id = '$book_id'";
    $bookResult = $conn->query($bookQuery);
    // Retrieve the book details from the database
    $book = $bookResult->fetch_assoc();
    $price = $book["price"];
    $discount = $book["discount"];

    if ($bookResult->num_rows > 0) {
        $book = $bookResult->fetch_assoc();
        $userID = $_SESSION["user_id"];
        
        // Apply discounts based on VIP status or coupons
        // You can implement the logic for discounts here
        // $discountedPrice = calculateDiscount($bookPrice, $userId);

        // Calculate the total price
        // $totalPrice = $discountedPrice * $quantity;

        // Insert the order details into the orders table
        $orderQuery = "INSERT INTO orders (user_id, book_id, shipping_method, payment_method, invoice_method, price, discount) VALUES
                        ('$userID', '$book_id', '$shipping', '$payment', '$invoice', '$price', '$discount')";

        if ($conn->query($orderQuery) === TRUE) {
            // Display success message to the user
            echo "Order placed successfully!";
        } else {
            // Display error message if the order couldn't be placed
            echo "Error placing the order: " . $conn->error;
        }
    } else {
        // Display error message if the book couldn't be found
        echo "Book not found!";
    }

    // Close the database connection
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Books</title>
</head>
<body>
    <h1>Order Books</h1>
    <?php
    if (isset($error)) {
        echo '<p>' . $error . '</p>';
    }
    ?>
    <form method="POST" action="6_order_book.php">

        <label>Book_ID:</label>
        <input type="text" name="book_id" required><br><br>
        
        <label>Shipping:</label>
        <input type="text" name="shipping" required><br><br>

        <label>Payment Method:</label>
        <input type="text" name="payment" required><br><br>

        <label>Invoice Method:</label>
        <input type="text" name="invoice" required><br><br>
        
        <input type="submit" value="Order">
    </form>
    <a href="bookstore.php">Back to homepage</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>

