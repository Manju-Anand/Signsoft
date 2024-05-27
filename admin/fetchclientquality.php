<?php

include "includes/connection.php";; // Your database connection

if (isset($_GET['cquality'])) {
    $cquality = $_GET['cquality'];
    showorderlist($cquality);
}

function showorderlist($cqty) {
    global $connection;

    $query = "SELECT * FROM order_customers WHERE client_quality = ? ORDER BY id DESC";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $cqty);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $post_custName = $row['custName'];
        $post_brandName = $row['brandName'];
        $post_order_status = $row['order_status'];
        $post_custPhone = $row['custPhone'];
        $post_custEmail = $row['custEmail'];
        $post_add = $row['addr'];
        $post_qamt = $row['quotedAmt'];

        $i++;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_custName</td>";
        echo "<td class='popup-container' data-id='{$id}'>$post_brandName</td>";
        echo "<td>$post_custPhone</td>";
        echo "<td>$post_custEmail</td>";
        echo "<td>$post_add</td>";
        echo "<td>$post_qamt</td>";

        switch ($post_order_status) {
            case 'Active':
                echo "<td><span class='badge bg-success' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'Processing':
                echo "<td><span class='badge bg-primary' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'Pending':
                echo "<td><span class='badge bg-cyan' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'Stopped':
                echo "<td><span class='badge bg-danger' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'On-Hold':
                echo "<td><span class='badge bg-warning' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'Completed':
                echo "<td><span class='badge bg-dark' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            case 'Closed':
                echo "<td><span class='badge bg-gray' style='font-size:15px;'>$post_order_status</span></td>";
                break;
            default:
                echo "<td><span class='badge bg-secondary' style='font-size:15px;'>Unknown</span></td>";
                break;
        }

      
        echo "</tr>";
    }

    mysqli_stmt_close($stmt);
}
?>
