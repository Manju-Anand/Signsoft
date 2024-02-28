<?php
session_start();
// Include your database connection file or establish a connection here
// Include the necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected order ID from the AJAX request
$selectedOrderId = $_POST['selectedOrderId'];
// <label class="form-label" for="orderiddisplay"><strong>Order Id : </strong>'. $row['id']  . '</label>

// Query the database based on the selected order ID
$query = "SELECT * FROM order_customers WHERE id = '$selectedOrderId' ";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options = '<label class="form-label" ><strong>Customer Name : </strong>' . $row['custName']  . '</label>';
}
$query = "SELECT * FROM staff_dm_allocation WHERE staffid='" . $_SESSION['empid'] ."' AND orderid='" . $selectedOrderId  . "' AND work_status='Active'";
$select_posts = mysqli_query($connection, $query);

if ($select_posts->num_rows > 0) {
    $options .= '<table class="table">';
    
    // Header row
    $options .= '<tr>';
    $options .= '<th>Work Details</th>';
    $options .= '<th>Frequency</th>';
    $options .= '<th>Start Date</th>';
    $options .= '<th>End Date</th>';
    $options .= '</tr>';

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_postings = $row['postings'];
        $post_frequency = $row['frequency'];
        $post_startdate = $row['startdate'];
        $post_enddate = $row['enddate'];

        // Data rows
        $options .= '<tr>';
        $options .= '<td>' . $post_postings . '</td>';
        $options .= '<td>' . $post_frequency . '</td>';
        $options .= '<td>' . $post_startdate . '</td>';
        $options .= '<td>' . $post_enddate . '</td>';
        $options .= '</tr>';
    }
    
    $options .= '</table>';
} else {
    $options = 'No records found';
}


// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>