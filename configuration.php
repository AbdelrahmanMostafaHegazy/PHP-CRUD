<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS products";

$conn->query($sql);

$conn->select_db("products");

$sql = "CREATE TABLE IF NOT EXISTS items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pname VARCHAR(100) NOT NULL,
    dis TEXT,
    price DECIMAL(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($sql);
