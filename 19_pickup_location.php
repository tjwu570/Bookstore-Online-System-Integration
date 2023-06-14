<?php
// Include the necessary database connection configuration
require_once 'config.php';

// Check if the user is logged in as a system manager
// Implement appropriate authentication and authorization checks here

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for the type of action being performed (add, delete, edit)
    $action = $_POST['action'];

    // Perform different actions based on the action type
    switch ($action) {
        case 'add':
            // Handle the addition of a new pickup location
            $pickupLocation = $_POST['pickup_location'];
            // Perform validation and sanitization of input data

            // Insert the pickup location into the database
            $query = "INSERT INTO pickup_locations (location_name) VALUES ('$pickupLocation')";
            // Execute the query

            // Handle success or failure of the database operation

            break;

        case 'delete':
            // Handle the deletion of an existing pickup location
            $pickupLocationId = $_POST['pickup_location_id'];
            // Perform validation and sanitization of input data

            // Delete the pickup location from the database
            $query = "DELETE FROM pickup_locations WHERE id = $pickupLocationId";
            // Execute the query

            // Handle success or failure of the database operation

            break;

        case 'edit':
            // Handle the editing of an existing pickup location
            $pickupLocationId = $_POST['pickup_location_id'];
            $newPickupLocation = $_POST['pickup_location'];
            // Perform validation and sanitization of input data

            // Update the pickup location in the database
            $query = "UPDATE pickup_locations SET location_name = '$newPickupLocation' WHERE id = $pickupLocationId";
            // Execute the query

            // Handle success or failure of the database operation

            break;

        default:
            // Handle invalid action types

            break;
    }
}


// Retrieve existing pickup locations from the database
$query = "SELECT id, location_name FROM pickup_locations";
$result = mysqli_query($connection, $query);

// Display the pickup locations in a table or list
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Pickup Locations</h2>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Location</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Loop through the retrieved data and display each pickup location
    while ($row = mysqli_fetch_assoc($result)) {
        $pickupLocationId = $row['id'];
        $pickupLocationName = $row['location_name'];

        echo "<tr>";
        echo "<td>$pickupLocationId</td>";
        echo "<td>$pickupLocationName</td>";
        echo "<td>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='action' value='edit'>";
        echo "<input type='hidden' name='pickup_location_id' value='$pickupLocationId'>";
        echo "<input type='text' name='pickup_location' value='$pickupLocationName'>";
        echo "<button type='submit'>Edit</button>";
        echo "</form>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='action' value='delete'>";
        echo "<input type='hidden' name='pickup_location_id' value='$pickupLocationId'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No pickup locations found.</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pickup Location Management</title>
</head>
<body>
    <!-- Display form for adding a new pickup location -->
    <h2>Add Pickup Location</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="add">
        <label for="pickup_location">Pickup Location:</label>
        <input type="text" name="pickup_location" required>
        <button type="submit">Add</button>
    </form>

    <!-- Display the existing pickup locations -->
    <h2>Pickup Locations</h2>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <!-- Display pickup locations in a table or list -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the retrieved data and display each pickup location -->
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $pickupLocationId = $row['id'];
                    $pickupLocationName = $row['location_name'];
                ?>
                <tr>
                    <td><?php echo $pickupLocationId; ?></td>
                    <td><?php echo $pickupLocationName; ?></td>
                    <td>
                        <!-- Display buttons for editing and deleting pickup locations -->
                        <form method="post" action="">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="pickup_location_id" value="<?php echo $pickupLocationId; ?>">
                            <input type="text" name="pickup_location" value="<?php echo $pickupLocationName; ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="pickup_location_id" value="<?php echo $pickupLocationId; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No pickup locations found.</p>
    <?php } ?>
</body>
</html>
