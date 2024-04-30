<?php
// Include your database connection file or establish a connection here
// Include the necessary database connection details
include "includes/connection.php";

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the selected order ID from the AJAX request
$selectedOrderId = $_POST['selectedOrderId'];

// Query the database based on the selected order ID
$query = "SELECT * FROM order_customers WHERE id = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $options = '<div class="row">
    <div class="col-md-12">
        <label class="form-label" ><strong>Customer Name : </strong>' . $row['custName']  . '</label>
    
        <label class="form-label" ><strong>Project Name : </strong>' . $row['projectname']  . '</label>
    
        <label class="form-label" ><strong>Quoted Amount : </strong>' . $row['quotedAmt']  . '</label><br>
        <input type="hidden" id="quoteamt" name="quoteamt" value="' . $row['quotedAmt'] . '">
    

        <label class="form-label" ><strong>Selected Categories : </strong></label>
        <select class="form-control select2" multiple="multiple" id="mulselect[]" name="mulselect[]"  disabled>';

            $presentchk = "false";
            $sql = "SELECT * FROM category";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $presentchk = "false";
                    $sqlcatcheck = "SELECT * FROM order_category where order_id='" . $selectedOrderId . "' and category_id ='" . $row['id'] . "'";
                    $resultcatcheck = $connection->query($sqlcatcheck);
                    if ($resultcatcheck->num_rows > 0) {
                        while ($rowcatcheck = $resultcatcheck->fetch_assoc()) {
                            $presentchk = "true";
                        }
                    }
                    if ($presentchk == "true") {


                        $options .= '<option selected value="' . htmlspecialchars($row['id'], ENT_QUOTES) . '"> ' . htmlspecialchars($row['category'], ENT_QUOTES) . '</option>';
                    }
                }
            }
    $options .= ' </select><br><label class="form-label" ><strong>Selected Sub-Categories : </strong></label>
        <select class="form-control select2" multiple="multiple" id="submulselect[]" name="submulselect[]" disabled>';

            $presentchk = "false";
            $sql = "SELECT * FROM subcategory";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $presentchk = "false";
                    $sqlcatcheck = "SELECT * FROM order_subcategory where order_id='" . $selectedOrderId . "' and subcategory_id ='" . $row['id'] . "'";
                    $resultcatcheck = $connection->query($sqlcatcheck);
                    if ($resultcatcheck->num_rows > 0) {
                        while ($rowcatcheck = $resultcatcheck->fetch_assoc()) {
                            $presentchk = "true";
                        }
                    }
                    if ($presentchk == "true") {


                        $options .= '<option selected value="' . htmlspecialchars($row['id'], ENT_QUOTES) . '"> ' . htmlspecialchars($row['subcategory'], ENT_QUOTES) . '</option>';
                    }
                }
            }
    $options .= ' </select></div></div>';
}


// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>


<script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<script src="../assets/js/select2.js"></script>