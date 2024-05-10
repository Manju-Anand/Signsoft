<?php
	session_start();
include "includes/connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = json_decode(file_get_contents("php://input"), true);
    

    date_default_timezone_set ("Asia/Calcutta");
    $postdate= date("M d,Y h:i:s a");
    $workdate= date("d-m-Y");
        $workmonth= date("n");
    $workyear= date("Y");
    $empid=$_SESSION['empid'];

    $sqldel = "DELETE FROM dailyworkentry WHERE work_date='". $workdate ."' and emp_id = '" . $empid . "'";
    if ($con->query($sqldel) === TRUE) {
    //   echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $con->error;
    }
    $sqldel = "DELETE FROM dailyworkstatus WHERE work_date='". $workdate ."' and emp_id = '" . $empid . "'";
    if ($con->query($sqldel) === TRUE) {
    //   echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $con->error;
    }

    $sqlstatus = "INSERT INTO dailyworkstatus (emp_id , work_date, status) VALUES ('$empid', '$workdate', 'Done')";
    if ($con->query($sqlstatus) !== TRUE) {
        echo "Error: " . $sqlstatus. "<br>" . $con->error;
    }else {
      $last_id = $con->insert_id;
      foreach ($postData as $data) {
          $question = $con->real_escape_string($data['question']);
          $qid = $con->real_escape_string($data['qid']);
          $qans = $con->real_escape_string($data['qans']);
          $subquestion = $con->real_escape_string($data['subquestion']);
          $subqid = $con->real_escape_string($data['subqid']);
          $timetaken = $con->real_escape_string($data['timetaken']);
          if ($qans !== "" && $qans !== "0") {
          $sql = "INSERT INTO dailyworkentry (qus_id, emp_id ,qus_ans, work_date, created,dailyworkstatus_id,
          month_of_entry,year_of_entry,subqusid,timetaken) VALUES 
          ('$qid','$empid', '$qans', '$workdate', '$postdate' , '$last_id','$workmonth','$workyear','$subqid','$timetaken')";
          if ($con->query($sql) !== TRUE) {
              echo "Error: " . $sql . "<br>" . $con->error;
          } else {
            
  
          }
        }
      }
    }
  
    echo "Data successfully recorded in the database.";
}

$connection->close();
?>
