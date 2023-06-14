/*
Explanation:

The script starts by including the db_connection.php file, which establishes a connection to the MySQL database.

It checks if the order ID is provided via the GET or POST method using isset($_REQUEST['order_id']).

If the order ID is provided, it retrieves the order information from the database using a SELECT query.

If the order exists (identified by mysqli_num_rows($result) == 1), it checks the current status of the order.

If the order is already canceled, it displays an appropriate message.

If the order is not canceled, it updates the order status to 'canceled' in the database using an UPDATE query.

Based on the success of the cancellation query, it displays a success or failure message.

Finally, the script closes the database connection using mysqli_close($connection).

Make sure to customize the script according to your specific database structure and naming conventions. Also, don't forget to create the db_connection.php file to establish the database connection.
*/

<?php
// Include the database connection file
include 'db_connection.php';

// Check if the order ID is provided via GET or POST method
if (isset($_REQUEST['order_id'])) {
    $order_id = $_REQUEST['order_id'];

    // Check if the order exists in the database
    $query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        // Order found, proceed with cancellation
        $row = mysqli_fetch_assoc($result);
        $status = $row['status'];

        // Check if the order is already canceled
        if ($status == 'canceled') {
            echo "This order has already been canceled.";
        } else {
            // Update the order status to 'canceled' in the database
            $cancel_query = "UPDATE orders SET status = 'canceled' WHERE order_id = '$order_id'";
            $cancel_result = mysqli_query($connection, $cancel_query);

            if ($cancel_result) {
                echo "Order canceled successfully.";
            } else {
                echo "Failed to cancel the order. Please try again.";
            }
        }
    } else {
        echo "Invalid order ID.";
    }
} else {
    echo "Order ID not provided.";
}

// Close the database connection
mysqli_close($connection);
?>
