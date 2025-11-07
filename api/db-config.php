<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Get Railway environment variables
$host = getenv('MYSQLHOST');
$port = getenv('MYSQLPORT');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');

// Create connection
$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Create tables if they don't exist
$createProductsTable = "
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$createOrdersTable = "
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customerName VARCHAR(255) NOT NULL,
    customerEmail VARCHAR(255) NOT NULL,
    productCategory VARCHAR(100) NOT NULL,
    productDetails TEXT NOT NULL,
    budget VARCHAR(50),
    deadline DATE,
    status VARCHAR(50) DEFAULT 'pending',
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$conn->query($createProductsTable);
$conn->query($createOrdersTable);
?>