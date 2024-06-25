<?php
// Include your database connection file
include "includes/connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve recordId from the POST request
    $recordId = $_POST['recordId'];

    // Validate and sanitize the recordId (you should customize this based on your requirements)

    // Example validation: Ensure recordId is a number
    if (!is_numeric($recordId)) {
        die('Error: Invalid record ID.');
    }

    // Perform database query to fetch data
    $sql = "SELECT * FROM staff_dm_graphics_allocation WHERE id = ?";
    $stmt = $connection->prepare($sql);
    
    // Bind parameter
    $stmt->bind_param('i', $recordId);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is fetched
    if ($row = $result->fetch_assoc()) {
        // Decode HTML entities in specific fields (adjust as needed)
        // $row['content'] = htmlspecialchars_decode($row['content'], ENT_QUOTES);
        // $row['posteridea'] = htmlspecialchars_decode($row['posteridea'], ENT_QUOTES);
        $row['content'] = str_replace("\n", '', htmlspecialchars_decode($row['content'], ENT_QUOTES));
        $row['posteridea'] = str_replace("\n", '', htmlspecialchars_decode($row['posteridea'], ENT_QUOTES));

// ****************************************************
        // Fetch images associated with the record
        $imageSql = "SELECT file_name FROM staff_dm_graphics_images WHERE allocation_id = ?";
        $imageStmt = $connection->prepare($imageSql);
        $imageStmt->bind_param('i', $recordId);
        $imageStmt->execute();
        $imageResult = $imageStmt->get_result();

        $images = [];
        while ($imageRow = $imageResult->fetch_assoc()) {
            $images[] = $imageRow['file_name'];
        }
        $row['images'] = $images;


// ********************************************
        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // No matching record found
        echo 'Error: No data found for the given record ID.';
    }

    // Close the statement
    $stmt->close();
    $imageStmt->close();
    // Close the database connection
    $connection->close();
} else {
    // If the request is not a POST request, return an error
    die('Error: Invalid request method.');
}
?>

