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
    // <label class="form-label" for="orderiddisplay"><strong>Order Id : </strong>'. $row['id']  . '</label>

// Query the database based on the selected order ID
$query = "SELECT * FROM order_customers WHERE id = '$selectedOrderId'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
$options = '
    <label class="form-label" for="branddisplay"><strong>Customer Name : </strong>'. $row['custName']  . '</label>

    <label class="form-label" for="branddisplay"><strong>Brand Name : </strong>'. $row['brandName']  . '</label>

    <label class="form-label" for="amountdisplay"><strong>Quoted Amount : </strong>'. $row['quotedAmt']  . '</label>
<input type="hidden" id="quoteamt" name="quoteamt" value="'. $row['quotedAmt'] . '">



    <label class="form-label" for="orderiddisplay"><strong>Selected Categories & Subcategories : </strong></label>
     <ul class="list-style2 ms-3">';


                    $categoriesQuery = "SELECT * FROM category";
                    $categoriesResult = $connection->query($categoriesQuery);
                    if ($categoriesResult->num_rows > 0) {
                        while ($categoryRow = $categoriesResult->fetch_assoc()) {
                            $sql = "SELECT * FROM order_category where order_id = '$selectedOrderId' and category_id='" . $categoryRow['id'] . "'";
                            $sqlResult = $connection->query($sql);
                            if ($sqlResult->num_rows > 0) {
                                while ($sqlRow = $sqlResult->fetch_assoc()) {

                                    $options .= '<li>'. $categoryRow['category'] . '</li>';
                                    $subcategoriesQuery = "SELECT * FROM subcategory where category_id='" . $categoryRow['id'] . "'";
                                    $subcategoriesResult = $connection->query($subcategoriesQuery);
                                    if ($subcategoriesResult->num_rows > 0) {
                                        while ($subcategoryRow = $subcategoriesResult->fetch_assoc()) {
                                            $sql = "SELECT * FROM order_subcategory where order_id = '$selectedOrderId' and subcategory_id='" . $subcategoryRow['id'] . "'";
                                            $sqlResult = $connection->query($sql);
                                            if ($sqlResult->num_rows > 0) {
                                                $options .= '<ul>';
                                                while ($sqlRow = $sqlResult->fetch_assoc()) {

                                                    $options .= '<li>'. $subcategoryRow['subcategory'] . '</li>';
                                                }
                                                $options .= '</ul>';
                                            }
                                        }
                                    }
                                    // *************************************
                                }
                            }
                        }
                    }
                    $options .= '</ul>';
                    }

                    
// ======================================================

// Close the database connection
mysqli_close($connection);

// Return the options as HTML
echo $options;
