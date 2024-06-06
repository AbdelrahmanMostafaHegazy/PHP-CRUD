<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Set the viewport to ensure the page is responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the webpage -->
    <title>New Product</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add a new product</h2>
        <!-- Form to add a new product, method is POST to submit data securely -->
        <form method="POST" action="add.php">
            <!-- Form group for product name -->
            <div class="form-group">
                <label for="name">Name:</label>
                <!-- Input field for product name -->
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
            </div>
            <!-- Form group for product description -->
            <div class="form-group">
                <label for="description">Discription:</label>
                <!-- Textarea for product description -->
                <textarea class="form-control" id="description" placeholder="Enter description" name="description" required></textarea>
            </div>
            <!-- Form group for product price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <!-- Input field for product price -->
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required>
            </div>
            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary">Submit</button><br><br>
            <!-- Link to go back to the product list -->
            <a class="btn btn-dark" href="http://localhost/Task-4/home.php">Back to product list</a>
        </form>
    </div>
</body>

</html>

<!-- PHP code to handle the form submission -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Include the database configuration file
    include_once("configuration.php");

    // Prepare the SQL query to insert the new product
    $sql = "INSERT INTO items (pname, dis, price) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the form data to the SQL query
        mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $price);

        // Execute the SQL query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the product list page if successful
            header("Location:http://localhost/Task-4/home.php");
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