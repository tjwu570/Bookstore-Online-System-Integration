

<?php
session_start();
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "benson";
$password = "benson123benson12";
$database = "Bookstore";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if the user is logged in. If not, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in";
    // header("Location: 1_user_login.php");
    exit();
}
else {
  $_SESSION['username'] = get_name_with_id($conn, $_SESSION['user_id']);
}


function get_name_with_id($db, $id){
  $query = "SELECT name FROM users WHERE id = '$id'";
  $result = mysqli_query($db, $query);
  $row = mysqli_fetch_assoc($result);
  return $row['name'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

  <button onclick="window.location.href='4_user_profile.php'">Edit Profile</button>
  <br>
  <button onclick="window.location.href='2_user_logout.php'">Logout</button>
  <br>
  <button onclick="window.location.href='25_inventory_viewing.php'">Inventory Viewing</button>
  <br>
  <button onclick="window.location.href='14_view_order_user.php'">View Orders</button>
  <br>
  <button onclick="window.location.href='6_order_book.php'">Order</button>
  <br>
  <button onclick="window.location.href='7_cancel_order.php'">Cancel Order</button>
  <br>
  <button onclick="window.location.href='5_book_search.php'">Search Book</button>
  <br>
  <button onclick="window.location.href='bookstore.php'">Homepage</button>



  <!-- Rest of the HTML content -->

</body>
</html>
