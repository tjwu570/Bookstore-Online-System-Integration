/*
n the above code, the script first includes the db_connection.php file, which establishes a connection to the MySQL database. It then checks if the book ID is provided in the URL parameters. If so, it retrieves the book details from the database using the ID.

If a book is found, it displays an HTML form with pre-filled values for the book's attributes, such as title, author, year of publication, and price. The form's action is set to update_book.php, which is the script responsible for updating the book details in the database.

Make sure to replace 'db_connection.php' with the appropriate path to your database connection file, and adjust the form fields according to your specific book attributes.

Remember to create the update_book.php script, which will handle the actual update of book details in the database based on the submitted form data.
*/

<?php
// Include the database connection file
include_once 'db_connection.php';

// Check if the book ID is provided
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Retrieve the book details from the database
    $query = "SELECT * FROM books WHERE id = '$bookId'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $book = mysqli_fetch_assoc($result);

        // Display the book edit form
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Book</title>
        </head>
        <body>
            <h2>Edit Book</h2>
            <form method="POST" action="update_book.php">
                <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                <label for="title">Title:</label>
                <input type="text" name="title" value="<?php echo $book['title']; ?>"><br>
                <label for="author">Author:</label>
                <input type="text" name="author" value="<?php echo $book['author']; ?>"><br>
                <label for="year">Year of Publication:</label>
                <input type="text" name="year" value="<?php echo $book['year']; ?>"><br>
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo $book['price']; ?>"><br>
                <!-- Add more fields for other book details -->
                <input type="submit" value="Save">
            </form>
        </body>
        </html>
        <?php
    } else {
        // Book not found
        echo "Book not found.";
    }
} else {
    // Book ID not provided
    echo "Invalid request.";
}
?>
