<?php
include "includes/connection.php";

if (isset($_POST['category_ids'])) {
    $categoryIds = $_POST['category_ids'];
    $categoryIds = implode(',', $categoryIds); // Convert array to comma-separated string

    $sql = "SELECT * FROM subcategory WHERE category_id IN ($categoryIds)";
    $result = $connection->query($sql);

    $options = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['id'] . '">' . $row['subcategory'] . '</option>';
        }
    }

    echo $options;
}
?>
