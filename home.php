<?php
// Include the database configuration file to establish a connection
include_once("configuration.php");

// SQL query to select product name, description, and price from the items table
$sql = "SELECT pname, dis, price FROM items";
// Execute the query and get the result set
$result = mysqli_query($conn, $sql);
?>

<html lang="en">

<head>
  <!-- Character encoding for the HTML document -->
  <meta charset="UTF-8">
  <!-- Viewport settings to ensure responsiveness on different devices -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Title of the webpage -->
  <title>Home</title>
  <!-- Link to Bootstrap CSS for styling -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container border-2">
    <h2>Product List</h2>
    <!-- Table to display the list of products -->
    <table class="table table-hover table-active table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Check if there are any rows in the result set
        if (mysqli_num_rows($result) > 0) {
          // Loop through each row in the result set
          while ($row = mysqli_fetch_assoc($result)) {
            // Output the product details in a table row
            echo '
              <tr>
                <th scope="row">' . $row["pname"] . '</th>
                <td>' . $row["dis"] . '</td>
                <td>' . $row["price"] . ' $</td>
                <td>
                  <!-- Link to edit the product, passing the product name as a URL parameter -->
                  <a role="button" class="btn btn-info" href="http://localhost/Task-4/edit.php?pname=' . $row['pname'] . '">Edit</a>
                  <!-- Button to delete the product, triggers a confirmation dialog -->
                  <a role="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" onClick="confirmDelete(\'' . $row['pname'] . '\')">Delete</a>
                </td>
              </tr>';
          }
        } else {
          // Output a message if no data is found
          echo '<tr><td colspan="6"><h3 align="center">No Data Found!</h3></td></tr>';
        }
        ?>
      </tbody>
    </table>

    <!-- Button to add a new product, links to the add product page -->
    <a href="http://localhost/Task-4/add.php" class="btn btn-info" role="button">Add new product</a>
  </div>

  <?php
  // Close the database connection
  mysqli_close($conn);
  ?>

  <script>
    // Function to confirm deletion of a product
    function confirmDelete(pname) {
      // Prompt the user for confirmation
      var result = confirm("Are you sure you want to delete " + pname + "?");
      // If the user confirms, redirect to the delete page with the product name as a URL parameter
      if (result) {
        window.location.href = "delete.php?pname=" + encodeURIComponent(pname);
        alert("Item deleted!");
      } else {
        alert("Delete canceled!");
      }
    }
  </script>
</body>

</html>