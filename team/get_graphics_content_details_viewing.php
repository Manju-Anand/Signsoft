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
    echo $selectedOrderId ;
    $custname = "";
    $brandname = "";
    $query1 = "SELECT * FROM order_customers WHERE id = '$selectedOrderId' ";
    $result1 = mysqli_query($connection, $query1);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $custname = $row1['custName'];
        $brandname = $row1['brandName'];
    }

    $query2 = "SELECT * FROM order_customers WHERE custName = '$custname'  and brandName	='$brandname' and order_status ='Closed'";
    $result2 = mysqli_query($connection, $query2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
    // Query the database based on the selected order ID
    $query = "SELECT * FROM staff_dm_graphics_allocation WHERE orderid = '" . $row2['id'] . "' and assigned_staffid='" . $_SESSION['empid'] . "' and work_status='Active' order by id DESC";
    $result = mysqli_query($connection, $query);
    $r = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['dmsaveddata'] = "SavedData";
        echo  $_SESSION['dmsaveddata'];
        $r = $r + 1;
        $rowid = "row_" . mt_rand(20000, 200000) . "_" . time();

        // $input_content = str_replace(array("\r", "\n"), '', $row['content']);

        // For displaying in a non-input field (like a div or p tag), convert newlines to <br> tags
        $display_content = nl2br(htmlspecialchars($row['content']));


?>
    <tr data-rowid="<?php echo $rowid; ?>">
        <td><?php echo $r; ?></td>
        <td><?php echo $row['assigndate']; ?></td>
        <td><?php
            echo $row['postings'];
            ?></td>
        <td><?php
            echo $display_content;
            ?></td>


        <td><?php echo $row['posteridea']; ?></td>
        <td><?php echo $row['deadline']; ?></td>
       





    </tr>
<?php
}}
// Close the database connection
mysqli_close($connection);

// Return the options as HTML
// echo $options;
?>