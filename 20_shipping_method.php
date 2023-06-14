/*
In this example, the script connects to the MySQL database using the db_connection.php file, which should contain the necessary code to establish a database connection. You'll need to replace the placeholder comments with your own code to execute SQL queries, retrieve results, and check for query execution success.

The script includes two sections: one for adding a new shipping method and another for displaying the list of shipping methods. When the form for adding a shipping method is submitted, it inserts the shipping method into the shipping_methods table. When the form for deleting a shipping method is submitted, it deletes the corresponding shipping method from the table.

The list of shipping methods is retrieved from the database and displayed in a table. Each shipping method has a "Delete" button next to it, allowing the system manager to delete the method if desired.

Remember to adapt and modify the code according to your specific database structure, table names, and requirements.
*/





<?php
// Include the database connection file
include 'db_connection.php';

// Check if the user is logged in as a system manager
// Insert your code to check if the user is logged in as a system manager

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted to add a new shipping method
    if (isset($_POST['add_shipping'])) {
        $shippingMethod = $_POST['shipping_method'];
        
        // Insert the new shipping method into the database
        $sql = "INSERT INTO shipping_methods (method_name) VALUES ('$shippingMethod')";
        // Execute the SQL query
        // Insert your code to execute the SQL query
        
        // Check if the query executed successfully
        // Insert your code to check if the query executed successfully
    }

    // Check if the form is submitted to delete a shipping method
    if (isset($_POST['delete_shipping'])) {
        $shippingMethodId = $_POST['shipping_method_id'];

        // Delete the shipping method from the database
        $sql = "DELETE FROM shipping_methods WHERE id = $shippingMethodId";
        // Execute the SQL query
        // Insert your code to execute the SQL query
        
        // Check if the query executed successfully
        // Insert your code to check if the query executed successfully
    }
}

// Retrieve the list of shipping methods from the database
$sql = "SELECT * FROM shipping_methods";
// Execute the SQL query
// Insert your code to execute the SQL query

// Check if any shipping methods are found
// Insert your code to check if any shipping methods are found

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shipping Method Management</title>
</head>
<body>
    <h1>Shipping Method Management</h1>
    
    <!-- Add Shipping Method Form -->
    <h2>Add Shipping Method</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="shipping_method">Shipping Method:</label>
        <input type="text" name="shipping_method" id="shipping_method" required>
        <button type="submit" name="add_shipping">Add Shipping Method</button>
    </form>
    
    <!-- List of Shipping Methods -->
    <h2>List of Shipping Methods</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Shipping Method</th>
            <th>Action</th>
        </tr>
        <?php 
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['method_name']; ?></td>
                <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="shipping_method_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_shipping">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
