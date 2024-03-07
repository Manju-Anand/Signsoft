<?php


// Create connection
include "includes/connection.php";
$category_id = $_GET['category_id'];
// *************** check its a combo category *****************
$combo = "No";
$querysub = "select * from combocategory where category_id = '" . $category_id . "'";
$select_postssub = mysqli_query($connection, $querysub);
while ($rowsub = mysqli_fetch_assoc($select_postssub)) {
    $combo = "Yes";
}

// *************** check its a combo category *****************
if ($combo == "Yes"){
    $subcategoriesQuery = "SELECT * FROM subcategory where id in ( select subcategory_id from combocategory where category_id='" . $category_id ."')";
     
}else{
    $subcategoriesQuery = "SELECT * FROM subcategory WHERE category_id = $category_id";
}

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
