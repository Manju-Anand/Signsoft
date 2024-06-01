<?php
include "includes/connection.php"; ; // Include your database connection file


// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$gstAmount = $data['gstAmount'];
$gstPaidDate = $data['gstPaidDate'];
$tableData = $data['tableData'];

// Save total GST amount
$insertGstTotalStmt = $connection->prepare("INSERT INTO gst_paid (paid_total, paid_date) VALUES (?, ?)");
$insertGstTotalStmt->bind_param("ss", $gstAmount, $gstPaidDate);

if ($insertGstTotalStmt->execute()) {
    // Get the last inserted ID to link detailed records
    $lastGstId = $connection->insert_id;

    // Save each row from the table
    $insertRowStmt = $connection->prepare("INSERT INTO gstamt (orderid, invoice_no, invoice_amt, gst_amt, taxable_value,paiddate,gst_paid_id)
     VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($tableData as $row) {
        $orderId = $row['orderId'];
        $brandName = $row['brandName'];
        $invoiceNo = $row['invoiceNo'];
        $invoiceAmt = $row['invoiceAmt'];
        $gstAmt = $row['gstAmt'];
        $taxableValue = $row['taxableValue'];

        $insertRowStmt->bind_param("sssssss", $orderId, $invoiceNo, $invoiceAmt, $gstAmt, $taxableValue,$gstPaidDate,$lastGstId);
        $insertRowStmt->execute();
    }

    echo "GST details saved successfully.";
} else {
    echo "Error: " . $insertGstTotalStmt->error;
}

$insertGstTotalStmt->close();
$connection->close();



?>
