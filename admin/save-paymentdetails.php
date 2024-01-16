<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$corderid =$data['correctorderid'];
$sql = "DELETE FROM payment_supplier WHERE orderid='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}
$sql = "DELETE FROM payment_customer WHERE orderid='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}

// ====================== delete already entered datas =============
// Iterate through the data and insert into the database
foreach ($data['dataToSave'] as $row) {
    $orderid = $row['orderid'];
    $entry = $row['entry'];
    $entryid = $row['entryid'];
    $SupplierName = $row['SupplierName'];
    $Supplierid = $row['Supplierid'];
    $workDone = $row['workDone'];
    $SupplierBillNo = $row['SupplierBillNo'];
    $PaymentAmount = $row['PaymentAmount'];
    $TransactionMode = $row['TransactionMode'];
    $CustomerBillNo = $row['CustomerBillNo'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");

    // Perform the SQL query to insert data into the first table (payment_supplier)
    $sql = "INSERT INTO payment_supplier (orderid, category_id, categoryName, supplier_id, supplierName, work_description, 
    supplier_billno, payment_amount,transaction_mode,customer_billno,created,modified)
            VALUES ('$orderid','$entryid','$entry','$Supplierid', '$SupplierName', '$workDone', '$SupplierBillNo', '$PaymentAmount', 
            '$TransactionMode','$CustomerBillNo','$postdate','$postdate')";

    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// If you have a second table (payment_data), handle its data
if (isset($data['dataToSave1'])) {
    foreach ($data['dataToSave1'] as $row) {
        $orderid = $row['orderid'];
        $paymentType = $row['PaymentType'];
        $transactionMode = $row['TransactionMode'];
        $paymentAmount = $row['PaymentAmount'];
        $customerBillNo = $row['CustomerBillNo'];

        // Perform the SQL query to insert data into the second table (payment_customer)
        $sqlPayment = "INSERT INTO payment_customer (orderid, payment_type, transaction_mode,payment_amount, customer_billno, created,modified)
                       VALUES ('$orderid', '$paymentType', '$transactionMode', '$paymentAmount', '$customerBillNo','$postdate','$postdate')";

        if ($connection->query($sqlPayment) !== TRUE) {
            echo "Error: " . $sqlPayment . "<br>" . $connection->error;
        }
    }
}

// Close the database connection
$connection->close();
?>
