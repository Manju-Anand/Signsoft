<?php
// Database connection (replace with your actual database connection details)
include "includes/connection.php";




// Get the row ID from the POST request
$rowId = $_POST['specificColumnData'];
echo $rowId;
// Prepare and bind
$stmt = $connection->prepare("DELETE FROM staff_dm_allocation WHERE id = ?");
$stmt->bind_param("i", $rowId);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Success' ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting record: ' . $stmt->error]);
}

// Close connection
$stmt->close();
$connection->close();
?>
