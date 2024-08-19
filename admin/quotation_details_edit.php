<?php
// Connect to your database (modify these parameters accordingly)
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on the order ID
if (isset($_POST['order_id'])) {
    $advpresent = "false";
    $orderId = $_POST['order_id'];
    $u = 0;
    $sql = "SELECT * FROM quote_splitup WHERE orderid = '" . $orderId . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['itemid'] == "**") {
                $advpresent = "true";     // to check whether advance payment % is given or not
            }
            $u = $u + 1;

            echo "<tr>";
            echo "<td>" . $u . "</td>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['itemname'] . "</td>";
            if ($row['itemid'] == "**") {
                echo "<td contenteditable='true' class='numeric-column-adv'>" . $row['price'] . "</td>";
            } else {
                echo "<td contenteditable='true' class='numeric-column'>" . $row['price'] . "</td>";
            }
            echo "<td contenteditable='true' class='numeric-column'>" . $row['order_expense'] . "</td>";
            echo "</tr>";
        }
        if ($advpresent == "false") {
            $u = $u + 1;
            echo "<tr>";
            echo "<td>" . $u . "</td>";
            echo "<td>**</td>";
            echo "<td>Advance Percentage[ % ]</td>";
            echo "<td contenteditable='true' class='numeric-column-adv'></td>";
            echo "<td contenteditable='true' class='numeric-column-adv'></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No data found</td></tr>";
    }

    $conn->close();
}
