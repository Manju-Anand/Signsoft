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
$sql = "DELETE FROM staff_allocation WHERE orderid='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}

$sql = "DELETE FROM order_followup WHERE order_id='". $corderid ."'";

if ($connection->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $connection->error;
}

// ====================== delete already entered datas =============
// Iterate through the data and insert into the database
foreach ($data['supplierdataToSave'] as $row) {
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
    $payDate = $row['payDate'];
    $payStatus = $row['payStatus'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
    // if ($payStatus !== "Saved") {
        // Perform the SQL query to insert data into the first table (payment_supplier)
        $sql = "INSERT INTO payment_supplier (orderid, category_id, categoryName, supplier_id, supplierName, work_description, 
        supplier_billno, payment_amount,transaction_mode,customer_billno,created,modified,payDate)
                VALUES ('$orderid','$entryid','$entry','$Supplierid', '$SupplierName', '$workDone', '$SupplierBillNo', '$PaymentAmount', 
                '$TransactionMode','$CustomerBillNo','$postdate','$postdate','$payDate')";

        if ($connection->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    // }
}

// If you have a second table (payment_data), handle its data
if (isset($data['paymentdataToSave'])) {
    foreach ($data['paymentdataToSave'] as $row) {
        $orderid = $row['orderid'];
        $paymentType = $row['PaymentType'];
        $transactionMode = $row['TransactionMode'];
        $invoiceAmount = $row['InvoiceAmount'];
        $paymentAmount = $row['PaymentAmount'];
        $customerBillNo = $row['CustomerBillNo'];
        $cuspayDate = $row['cuspayDate'];
        $payStatus = $row['payStatus'];
        $postdate = date("M d,Y h:i:s a");
        // if ($payStatus !== "Saved") {
        // Perform the SQL query to insert data into the second table (payment_customer)
        $sqlPayment = "INSERT INTO payment_customer (orderid, payment_type, transaction_mode,payment_amount, customer_billno, created,modified,payDate,invoiceAmt)
                       VALUES ('$orderid', '$paymentType', '$transactionMode', '$paymentAmount', '$customerBillNo','$postdate','$postdate','$cuspayDate','$invoiceAmount')";

        if ($connection->query($sqlPayment) !== TRUE) {
            echo "Error: " . $sqlPayment . "<br>" . $connection->error;
        }
      // }
    }
}

if (isset($data['staffallocationdataToSave'])) {
  foreach ($data['staffallocationdataToSave'] as $row) {
    $orderid = $row['orderid'];
    $entry = $row['entry'];
    $entryid = $row['entryid'];
    $staffName = $row['staffName'];
    $staffid = $row['staffid'];
    $workAssigned = $row['workAssigned'];
    $deadline = $row['deadline'];
    $percentOfWork = $row['percentOfWork'];
    $assignDate = $row['assignDate'];
    $payStatus = $row['payStatus'];
    $postdate = date("M d,Y h:i:s a");


    // Perform the SQL query to insert data into the database
    $sql = "INSERT INTO staff_allocation (orderid,entryid,entryname,empid, empname, work_assigned, deadline, per_of_work,assignedDate,created) VALUES
     ('$orderid','$entryid','$entry','$staffid', '$staffName', '$workAssigned', '$deadline', '$percentOfWork', '$assignDate','$postdate')";

    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

}
}


if (isset($data['followupdataToSave'])) {
  foreach ($data['followupdataToSave'] as $row) {
    $orderid = $row['orderid'];
    $followdate = $row['followdate'];
    $followmode = $row['followmode'];
    $remarks = $row['remarks'];
    $payStatus = $row['payStatus'];
    // if ($payStatus !== "Saved") {
    // Perform the SQL query to insert data into the database
    $sql = "INSERT INTO order_followup (order_id,orderDate,mode_of_contact,remarks) VALUES
     ('$orderid','$followdate','$followmode','$remarks')";
    
    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
  // }
}
}

// Close the database connection
$connection->close();
?>
