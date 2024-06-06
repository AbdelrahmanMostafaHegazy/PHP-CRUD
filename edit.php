<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding for the HTML document -->
    <meta charset="UTF-8">
    <!-- Viewport settings to ensure responsiveness on different devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the webpage -->
    <title>Update Product</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Update Product</h2>
        <?php
        // Include the database configuration file to establish a connection
        include_once("configuration.php");

        // Check if 'pname' parameter is set in the URL
        if (isset($_GET['pname'])) {
            // Retrieve the product name from the URL parameter
            $pname = $_GET['pname'];
            // Prepare an SQL statement to fetch product details based on the product name
            $sql = "SELECT * FROM items WHERE pname = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind the product name parameter to the SQL statement
                mysqli_stmt_bind_param($stmt, "s", $pname);
                // Execute the SQL statement
                mysqli_stmt_execute($stmt);
                // Get the result of the executed statement
                $result = mysqli_stmt_get_result($stmt);
                // Fetch the product details as an associative array
                $row = mysqli_fetch_assoc($result);
            }
        }
        ?>
        <!-- Form to update the product details, method is POST to submit data securely -->
        <form method="POST" action="Edit.php">
            <!-- Hidden input to store the original product name -->
            <input type="hidden" name="pname" value="<?php echo $row['pname']; ?>">
            <!-- Form group for product name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <!-- Input field for product name with the current value pre-filled -->
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $row['pname']; ?>" required>
            </div>
            <!-- Form group for product description -->
            <div class="form-group">
                <label for="description">Description:</label>
                <!-- Textarea for product description with the current value pre-filled -->
                <textarea class="form-control" id="description" placeholder="Enter description" name="description" required><?php echo $row['dis']; ?></textarea>
            </div>
            <!-- Form group for product price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <!-- Input field for product price with the current value pre-filled -->
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>
            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary">Update</button><br><br>
            <!-- Link to go back to the product list -->
            <a class="btn btn-dark" href="http://localhost/Task-4/home.php">Back to product list</a>
        </form>
    </div>
</body>

</html>

<?php
// Include the database configuration file to establish a connection
include_once("configuration.php");

// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pname = $_POST["pname"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Prepare an SQL statement to update the product details
    $sql = "UPDATE items SET pname = ?, dis = ?, price = ? WHERE pname = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the form data to the SQL statement
        mysqli_stmt_bind_param($stmt, "ssds", $name, $description, $price, $pname);

        // Execute the SQL statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the product list page if successful
            header("Location: http://localhost/Task-4/home.php");
            exit();
        } else {
            // Display an error message if the query execution fails
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Display an error message if the statement preparation fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>