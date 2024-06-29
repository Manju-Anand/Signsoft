<?php
// Connect to your database (modify these parameters accordingly)
include "includes/connection.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on the order ID
// Fetch data based on the order ID
if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];
    $u = 1;
    
    $sql = "SELECT * FROM order_category WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $category_id = $row['category_id'];
            
            $sqlitemname = "SELECT * FROM category WHERE id = ?";
            $stmtItemName = $conn->prepare($sqlitemname);
            $stmtItemName->bind_param("i", $category_id);
            $stmtItemName->execute();
            $resultitemname = $stmtItemName->get_result();
            
            if ($resultitemname->num_rows > 0) {
                while ($rowitemname = $resultitemname->fetch_assoc()) {
                    $chksub = $rowitemname['subchk'];
                    
                    if ($chksub == 1) {
                        // echo "1";
                        
                        $sqlsubcat = "SELECT * FROM subcategory WHERE category_id = ? AND id IN (SELECT subcategory_id FROM order_subcategory WHERE order_id = ?)";
                        $stmtSubCat = $conn->prepare($sqlsubcat);
                        $stmtSubCat->bind_param("ii", $category_id, $orderId);
                        $stmtSubCat->execute();
                        $resultsubcat = $stmtSubCat->get_result();
                        
                        while ($rowsubcat = $resultsubcat->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $u . "</td>";
                            echo "<td>" . $rowsubcat['category_id'] . "</td>";
                            echo "<td>" . $rowsubcat['subcategory'] . "</td>";
                            echo "<td contenteditable='true' class='numeric-column'></td>";
                            echo "</tr>";
                            $u++;
                        }
                    } else {
                        // echo "2";
                        echo "<tr>";
                        echo "<td>" . $u . "</td>";
                        echo "<td>" . $row['category_id'] . "</td>";
                        echo "<td>" . $rowitemname['category'] . "</td>";
                        echo "<td contenteditable='true' class='numeric-column'></td>";
                        echo "</tr>";
                        $u++;
                    }
                }
            }
        }
        // $u++;
        echo "<tr>";
        echo "<td>" . $u . "</td>";
        echo "<td>**</td>";
        echo "<td>Advance Percentage[ % ]</td>";
        echo "<td contenteditable='true' class='numeric-column-adv'></td>";
        echo "</tr>";
        $u++;
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>";
    }

    $stmt->close();
    $conn->close();
}

// if (isset($_POST['order_id'])) {
//     $orderId = $_POST['order_id'];
//     $u=0;
//     $sql = "SELECT * FROM order_category WHERE order_id = $orderId";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//         $u=$u+1;
//             $sqlitemname = "SELECT * FROM category WHERE id = '" . $row['category_id'] . "'";
//             $resultitemname = $conn->query($sqlitemname);
//             if ($resultitemname->num_rows > 0) {
//                 while ($rowitemname = $resultitemname->fetch_assoc()) {
//                     $chksub=$rowitemname['subchk'];
//                     if ($chksub == 1){
//                         echo "1";
//                         $sqlsubcat = "SELECT * FROM subcategory WHERE category_id = '" . $row['category_id'] . "' and id in(select subcategory_id from order_subcategory where order_id=$orderId)";
          

             
                        
//                         $resultsubcat = $conn->query($sqlsubcat);
//                         if ($resultsubcat->num_rows > 0) {
//                             while ($rowsubcat = $resultsubcat->fetch_assoc()) {
//                                 echo "<tr>";
//                                 echo "<td>" . $u . "</td>";
//                                 echo "<td>" . $rowsubcat['category_id'] . "</td>";
//                                 echo "<td>" . $rowsubcat['subcategory'] . "</td>";
//                                 echo "<td contenteditable='true' class='numeric-column'></td>";
//                                 echo "</tr>";


//                             }





//                     } else {
//                         echo "2";
//                     echo "<tr>";
//                     echo "<td>" . $u . "</td>";
//                     echo "<td>" . $row['category_id'] . "</td>";
//                     echo "<td>" . $rowitemname['category'] . "</td>";
//                     echo "<td contenteditable='true' class='numeric-column'></td>";
//                     echo "</tr>";
//                     }
//                 }
//             }
//         }
//         $u=$u+1;
//         echo "<tr>";
//         echo "<td>" . $u . "</td>";
//         echo "<td>**</td>";
//         echo "<td>Advance Percentage[ % ]</td>";
//         echo "<td contenteditable='true' class='numeric-column-adv'></td>";
//         echo "</tr>";
//     }
//     } else {
//         echo "<tr><td colspan='2'>No data found</td></tr>";
//     }

//     $conn->close();
// }
?>
<script>
    $(document).ready(function(){
        // Restrict input in the numeric column to numeric values only
        $('.numeric-column').on('input', function(){
            // Save the previous value
            var previousValue = $(this).data('previous-value');
            
            // Get the current value and remove non-numeric characters
            var currentValue = $(this).text().replace(/[^0-9]/g, '');

            // Update the content with the numeric value
            $(this).text(currentValue);

            // If the value changed, move the cursor to the correct position
            if (currentValue !== previousValue) {
                placeCaretAtEnd(this);
            }

            // Save the current value as the new previous value
            $(this).data('previous-value', currentValue);
        });

        // Function to move the cursor to the end of the contenteditable element
        function placeCaretAtEnd(el) {
            var range = document.createRange();
            var sel = window.getSelection();
            range.selectNodeContents(el);
            range.collapse(false);
            sel.removeAllRanges();
            sel.addRange(range);
            el.focus();
        }

        $('.numeric-column-adv').on('input', function(){
            // Save the previous value
            var previousValue = $(this).data('previous-value');
            
            // Get the current value and remove non-numeric characters
            var currentValue = $(this).text().replace(/[^0-9]/g, '');

            // Update the content with the numeric value
            $(this).text(currentValue);

            // If the value changed, move the cursor to the correct position
            if (currentValue !== previousValue) {
                placeCaretAtEnd(this);
            }

            // Save the current value as the new previous value
            $(this).data('previous-value', currentValue);
        });
    });
</script>
