<?php


// Create connection
include "includes/connection.php";

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_id = $_GET['category_id'];
$subcategoriesQuery = "SELECT * FROM subcategory WHERE category_id = $category_id";
$subcategoriesResult = $connection->query($subcategoriesQuery);

$subcategories = array();

if ($subcategoriesResult->num_rows > 0) {
    while ($subcategoryRow = $subcategoriesResult->fetch_assoc()) {
        $subcategories[] = $subcategoryRow;
    }
}

// Return subcategories as JSON
header('Content-Type: application/json');
echo json_encode($subcategories);

// Close connection
$connection->close();
?>
