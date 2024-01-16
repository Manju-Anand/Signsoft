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

$options='<div class="col-md-6" style="margin: bottom 10px;">
<label class="form-label" for="branddisplay">Brand Name :</label>
<input type="text" class="form-control" id="branddisplay" name="branddisplay" placeholder="" readonly>
</div>
<div class="col-md-6" style="margin: bottom 10px;">
<label class="form-label" for="amountdisplay">Quoted Amount :</label>
<input type="text" class="form-control" id="amountdisplay" name="amountdisplay" placeholder="" readonly>
</div>
<div class="col-md-6" style="margin: bottom 10px;">
<label class="form-label" for="orderiddisplay">Order Id :</label>
<input type="text" class="form-control" id="orderiddisplay" name="orderiddisplay" placeholder="" readonly>
</div>
<div class="col-md-6" style="margin: bottom 10px;">
<label class="form-label" for="orderiddisplay">Selected Categories & Subcategories :</label>
     <ul class="list-style2 ms-3">';


    $categoriesQuery = "SELECT * FROM category";
    $categoriesResult = $connection->query($categoriesQuery);
    if ($categoriesResult->num_rows > 0) {
       while ($categoryRow = $categoriesResult->fetch_assoc()) {
        $sql = "SELECT * FROM order_category where order_id = '$selectedOrderId' and category_id='". $categoryRow['id'] . "'";
        $sqlResult = $connection->query($sql);
        if ($sqlResult->num_rows > 0) {
        while ($sqlRow = $sqlResult->fetch_assoc()) {

            $options .= '<li>Lorem ipsum dolor sit amet</li>';


   }}

}}

// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
?>
