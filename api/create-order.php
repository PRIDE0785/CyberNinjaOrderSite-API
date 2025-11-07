<?php
require_once 'db-config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $customerName = $conn->real_escape_string($input['customerName']);
    $customerEmail = $conn->real_escape_string($input['customerEmail']);
    $productCategory = $conn->real_escape_string($input['productCategory']);
    $productDetails = $conn->real_escape_string($input['productDetails']);
    $budget = $conn->real_escape_string($input['budget']);
    $deadline = $conn->real_escape_string($input['deadline']);
    $status = $conn->real_escape_string($input['status']);
    
    $sql = "INSERT INTO orders (customerName, customerEmail, productCategory, productDetails, budget, deadline, status) 
            VALUES ('$customerName', '$customerEmail', '$productCategory', '$productDetails', '$budget', '$deadline', '$status')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Order created successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}

$conn->close();
?>