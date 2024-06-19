<?php
// delete_staff.php

// Include database connection file

include "includes/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete statement
    $stmt = $connection->prepare("DELETE FROM staff_dm_graphics_allocation WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $connection->close();
}
?>
