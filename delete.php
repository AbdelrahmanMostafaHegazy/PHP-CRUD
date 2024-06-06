<?php
// Delete item

// Include the database configuration file to establish a database connection
include("configuration.php");

// Retrieve the product name from the GET request
$pname = $_GET['pname'];

// Prepare the SQL query to delete the item with the specified product name
$sql = "DELETE FROM items WHERE pname = '" . mysqli_real_escape_string($conn, $pname) . "'";

// Execute the SQL query and output the result (true for success, false for failure)
echo mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);

// Redirect to the product list page after deletion
header("Location:http://localhost/Task-4/home.php");
