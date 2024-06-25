<?php
// delete_staff.php

// Include database connection file

include "includes/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
$stat=false;
    // Prepare and execute the delete statement
    $stmt = $connection->prepare("DELETE FROM staff_dm_graphics_allocation WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // echo 'success';
        $stat=true;
    } else {
        $stat=false;
    }

    $stmt->close();
  // Prepare and execute the delete statement
  $stmt1 = $connection->prepare("DELETE FROM staff_dm_graphics_allocation WHERE redirect_recordid = ?");
  $stmt1->bind_param("i", $id);

  if ($stmt1->execute()) {
      // echo 'success';
      $stat=true;
  } else {
      $stat=false;
  }

  $stmt1->close();


        // Prepare and execute the delete statement
 // Perform a SELECT query to fetch image paths based on allocation_id
$select_query = "SELECT file_name FROM staff_dm_graphics_images WHERE allocation_id = ?";
$stmt_select = $connection->prepare($select_query);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$stmt_select->bind_result($image_path);

// Array to store image paths for deletion
$images_to_delete = [];

// Fetch all image paths
while ($stmt_select->fetch()) {
    $images_to_delete[] = $image_path;
}

$stmt_select->close();

// Now unlink each image from the server
foreach ($images_to_delete as $image_path) {
    if (file_exists($image_path)) {
        if (unlink($image_path)) {
            // echo "Deleted image: $image_path<br>";
            $stat=true;
        } else {
            // echo "Failed to delete image: $image_path<br>";
            $stat=false;
        }
    } else {
        // echo "Image does not exist: $image_path<br>";
        $stat=false;
    }
}

// After unlinking images, delete the record from the database
$delete_query = "DELETE FROM staff_dm_graphics_images WHERE allocation_id = ?";
$stmt_delete = $connection->prepare($delete_query);
$stmt_delete->bind_param("i", $id);

if ($stmt_delete->execute()) {
    // echo 'success';
    $stat=true;
} else {
    // echo 'Error deleting record.';
    $stat=false;
}

if ($stat==true){
    echo 'success';
}else {
    echo 'error';
}


$stmt_delete->close();
$connection->close();

}
?>
