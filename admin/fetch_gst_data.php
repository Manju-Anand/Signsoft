<?php
// Include your database connection or any necessary files

include "includes/connection.php"; // Your database connection

echo calculateTotalGstAmount($connection);
function calculateTotalGstAmount($connection)
{

    $lastMonth = date('m', strtotime('-1 month')); // Get the previous month
    // $secondlastMonth = date('m', strtotime('-2 month')); // Get the month before the previous month

    $tot_gst_amt = 0;

    $query = "SELECT * FROM order_customers WHERE order_status='Active'";
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];

        $sqlpay = "SELECT * FROM payment_customer WHERE orderid='$id' AND SUBSTRING(payDate, 6, 2)= '$lastMonth' ORDER BY invoiceAmt LIMIT 1";
        $resultpay = $connection->query($sqlpay);

        if ($resultpay->num_rows > 0) {
            while ($rowpay = $resultpay->fetch_assoc()) {
                $invoice_amt = $rowpay['invoiceAmt'];
                $invoice_no = $rowpay['customer_billno'];
                $sqlgst = "SELECT * FROM gstamt WHERE orderid='$id' AND invoice_no='$invoice_no'";
                // SUBSTRING(paiddate, 6, 2) = '$secondlastMonth'
                $resultgst = $connection->query($sqlgst);

                if ($resultgst->num_rows <= 0) {
                    $gstamt = $invoice_amt * 18 / 100;
                    $tot_gst_amt += $gstamt;
                }
            }
        }
    }

    return $tot_gst_amt;
}
