<?php
if (isset($_POST['monthId']) && isset($_POST['orderId'])) {
    $orderId = intval($_POST['orderId']);
    $monthId = intval($_POST['monthId']);
    $currentYear = date("Y");

    include "includes/connection.php";

    // Query to fetch the sum of the budget based on the provided criteria
    $sql = "SELECT SUM(budget) FROM dm_workdetails WHERE orderid = ? AND campMonth = ? AND campYear = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('iii', $orderId, $monthId, $currentYear);
    $stmt->execute();
    $stmt->bind_result($data);
    $stmt->fetch();

    // echo $data; // Echo the sum of the budget to send it back as the response
    $stmt->close();
    // Query to fetch the sum of the budget based on the provided criteria
    $wstatus='Active';
    $sql1 = "SELECT promoamt FROM staff_dm_allocation WHERE orderid = ? AND work_status =? ";
    $stmt1 = $connection->prepare($sql1);
    $stmt1->bind_param('is', $orderId,$wstatus );
    $stmt1->execute();
    $stmt1->bind_result($data1);
    $stmt1->fetch();

   // Prepare the response as a JSON object
   $response = array(
    'budgetSum' => $data,
    'promoAmt' => $data1
);

echo json_encode($response);

  
    $stmt1->close();
    $connection->close();
}
?>
