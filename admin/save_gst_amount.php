<?php
include "includes/connection.php"; ; // Include your database connection file



// $data = json_decode(file_get_contents('php://input'), true);
// $gstAmount = $data['gstAmount'];
// $gstPaidDate = $data['gstPaidDate'];
// $tableData = $data['tableData'];


// $insertGstTotalStmt = $connection->prepare("INSERT INTO gst_paid (paid_total, paid_date) VALUES (?, ?)");
// $insertGstTotalStmt->bind_param("ss", $gstAmount, $gstPaidDate);

// if ($insertGstTotalStmt->execute()) {

//     $lastGstId = $connection->insert_id;


//     $insertRowStmt = $connection->prepare("INSERT INTO gstamt (orderid, invoice_no, invoice_amt, gst_amt, taxable_value,paiddate,gst_paid_id)
//      VALUES (?, ?, ?, ?, ?, ?, ?)");

//     foreach ($tableData as $row) {
//         $orderId = $row['orderId'];
//         $brandName = $row['brandName'];
//         $invoiceNo = $row['invoiceNo'];

//         $invoiceAmt = $row['invoiceAmt'];
//         $invoiceAmt = str_replace("₹", "", $invoiceAmt);

//         $gstAmt = $row['gstAmt'];
//         $gstAmt = str_replace("₹", "", $gstAmt);

//         $taxableValue = $row['taxableValue'];
//         $taxableValue = str_replace("₹", "", $taxableValue);

//         $insertRowStmt->bind_param("ssiiiss", $orderId, $invoiceNo, $invoiceAmt, $gstAmt, $taxableValue,$gstPaidDate,$lastGstId);
//         $insertRowStmt->execute();
//     }

//     echo "GST details saved successfully.";
// } else {
//     echo "Error: " . $insertGstTotalStmt->error;
// }

// $insertGstTotalStmt->close();
// $connection->close();

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
    $insertRowStmt = $connection->prepare("INSERT INTO gstamt (orderid, invoice_no, invoice_amt, gst_amt, taxable_value, paiddate, gst_paid_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

    foreach ($tableData as $row) {
        $orderId = $row['orderId'];
        $invoiceNo = $row['invoiceNo'];

        $invoiceAmt =  str_replace("₹", "", $row['invoiceAmt']);
        $gstAmt = str_replace("₹", "", $row['gstAmt']);
        $taxableValue = str_replace("₹", "", $row['taxableValue']);

        $cleanedinvoiceAmt = preg_replace('/[^0-9.]/', '', $invoiceAmt);
        $cleanedtaxableValue = preg_replace('/[^0-9.]/', '', $taxableValue);
        $cleanedGstAmount = preg_replace('/[^0-9.]/', '', $gstAmt);
        $gstAmt = (float)$cleanedGstAmount;
        $invoiceAmt = (float)$cleanedinvoiceAmt;
        
        $taxableValue = (float)$cleanedtaxableValue;
        

        $insertRowStmt->bind_param("ssdddss", $orderId, $invoiceNo, $invoiceAmt, $gstAmt, $taxableValue, $gstPaidDate, $lastGstId);
        $insertRowStmt->execute();
    }

    echo "GST details saved successfully.";
} else {
    echo "Error: " . $insertGstTotalStmt->error;
}

$insertGstTotalStmt->close();
$insertRowStmt->close();
$connection->close();


?>
