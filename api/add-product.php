<?php
require_once 'db-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $name = $conn->real_escape_string($input['name']);
    $description = $conn->real_escape_string($input['description']);
    $category = $conn->real_escape_string($input['category']);
    $price = $conn->real_escape_string($input['price']);
    
    $sql = "INSERT INTO products (name, description, category, price) 
            VALUES ('$name', '$description', '$category', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Product added successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

$conn->close();
?>