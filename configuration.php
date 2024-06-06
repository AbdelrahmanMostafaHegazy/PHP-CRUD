<?php
// Define the server name, username, and password for the database connection
$servername = "localhost";
$username = "root";
$password = "";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password);

// Check if the connection was successful
if ($conn->connect_error) {
    // If the connection failed, display an error message and terminate the script
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create a database named 'products' if it doesn't already exist
$sql = "CREATE DATABASE IF NOT EXISTS products";

// Execute the query to create the database
$conn->query($sql);

// Select the 'products' database for subsequent queries
$conn->select_db("products");

// SQL query to create a table named 'items' if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  // Primary key with auto-increment
    pname VARCHAR(100) NOT NULL,                    // Product name, not null
    dis TEXT,                                       // Description, can be null
    price DECIMAL(10) NOT NULL,                     // Price, not null
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  // Timestamp with default current time
)";

// Execute the query to create the table
$conn->query($sql);
