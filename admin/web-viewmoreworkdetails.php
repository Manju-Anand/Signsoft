<?php
// Include your database connection file
include "includes/connection.php";

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve recordId from the POST request
    $recordId = $_POST['recordId'];
    $redirectId = $_POST['redirectId'];
    // Validate and sanitize the recordId (you should customize this based on your requirements)

    // Example validation: Ensure recordId is a number
    if (!is_numeric($recordId)) {
        die('Error: Invalid record ID.');
    }

    // Perform database query to fetch data from staff_dm_graphics_allocation
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
        // Perform another database query to fetch data from staff_dm_graphics_allocation_details
        $sqlDetails = "SELECT * FROM staff_dm_graphics_allocation_details WHERE staff_dm_allocation_id = ?";
        $stmtDetails = $connection->prepare($sqlDetails);
        
        // Bind parameter
        $stmtDetails->bind_param('i', $redirectId);

        // Execute the statement for details
        $stmtDetails->execute();

        // Get the result for details
        $resultDetails = $stmtDetails->get_result();

        // Fetch all rows from details
        $detailsData = [];
        while ($rowDetails = $resultDetails->fetch_assoc()) {
            $detailsData[] = $rowDetails;
        }

        // Add details data to the main row
        $row['details'] = $detailsData;

        // Return data as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // No matching record found
        echo 'Error: No data found for the given record ID.';
    }

    // Close the statements
    $stmt->close();
    $stmtDetails->close();

    // Close the database connection
    $connection->close();
} else {
    // If the request is not a POST request, return an error
    die('Error: Invalid request method.');
}
?>
