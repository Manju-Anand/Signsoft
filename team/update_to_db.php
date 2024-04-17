<?php
	session_start();
    include "includes/connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = json_decode(file_get_contents("php://input"), true);

    date_default_timezone_set ("Asia/Calcutta");
    $postdate= date("M d,Y h:i:s a");
    $empid=$_SESSION['empid'];

    // $sqldel = "DELETE FROM dailyworkentry WHERE work_date='". $workdate ."' and emp_id = '" . $empid . "'";
    // if ($connection->query($sqldel) === TRUE) {
    
    // } else {
    //   echo "Error deleting record: " . $connection->error;
    // }
   
      foreach ($postData as $data) {
          $question = $connection->real_escape_string($data['question']);
          $qid = $connection->real_escape_string($data['qid']);
          $qans = $connection->real_escape_string($data['qans']);
          $workdate = $connection->real_escape_string($data['workdate']);
          $workstatusid = $connection->real_escape_string($data['workstatusid']);
          $workid = $connection->real_escape_string($data['wid']);
          
           // Extract month and year
          $month = date("m", strtotime($workdate));
          $year = date("Y", strtotime($workdate));

        //   $sql = "INSERT INTO dailyworkentry (qus_id, emp_id ,qus_ans, work_date, created,dailyworkstatus_id) VALUES 
        //   ('$qid','$empid', '$qans', '$workdate', '$postdate' , '$workstatusid')";
        $sql = "UPDATE dailyworkentry SET qus_ans='$qans' WHERE id='$workid'";
          if ($connection->query($sql) !== TRUE) {
              echo "Error: " . $sql . "<br>" . $connection->error;
          } else {
            
  
          }
      }

  
    echo "Record in the database has been successfully updated.";
}

$connection->close();
?>
