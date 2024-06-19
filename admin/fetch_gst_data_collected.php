<?php
// Include your database connection file
include "includes/connection.php";

// Get the selected month and year
$monthselect = $_GET['monthselect'];
$yearselect = $_GET['yearselect'];
// Initialize variables to store total amounts
$totalInvoiceAmt = 0;
$totalGstAmt = 0;
// Query to fetch data from the database based on month and year
$query = "SELECT * FROM gstamt WHERE MONTH(paiddate) = '$monthselect' AND YEAR(paiddate) = '$yearselect'";
$result = mysqli_query($connection, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display them in the table
    while ($row = mysqli_fetch_assoc($result)) {
        $querybrand = "select * from order_customers where id='" . $row['orderid'] . "'";
        $select_postsbrand = $connection->query($querybrand);
        if ($select_postsbrand->num_rows > 0) {
            while ($rowbrand = $select_postsbrand->fetch_assoc()) {
                $brandname =   $rowbrand['brandName'];
            }
        }


        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['orderid'] . "</td>";
        echo "<td>" .  $brandname . "</td>";
        echo "<td>" . $row['invoice_no'] . "</td>";
        echo "<td>" . $row['invoice_amt'] . "</td>";
        echo "<td>" . $row['gst_amt'] . "</td>";
        echo "<td>" . $row['paiddate'] . "</td>";
        echo "</tr>";
          // Calculate total amounts
          $totalInvoiceAmt += $row['invoice_amt'];
          $totalGstAmt += $row['gst_amt'];
    }
} else {
    // No data found for the selected month and year
    echo "<tr><td colspan='7'>No data available</td></tr>";
}
// / Output the totals in a JSON format
echo json_encode(array('tableData' => ob_get_clean(), 'totalInvoiceAmt' => $totalInvoiceAmt, 'totalGstAmt' => $totalGstAmt));

// Close the connection
mysqli_close($connection);
?>
