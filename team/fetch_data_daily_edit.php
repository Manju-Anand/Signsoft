<?php
session_start();
include "includes/connection.php";

$selectedMonth = $_POST['month'];
$selecteddate = $_POST['tdate'];
$tid=$_POST['tid'];


$response = array();

$response['daysInMonth'] = $selecteddate;
$response['questions'] = array();

$sql = "SELECT * FROM trackerdetails where emp_id='" . $_SESSION['empid'] . "' and status='Active'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $sqlqus = "SELECT * FROM questions where id ='" . $row['question_id'] . "'";
    $resultqus = mysqli_query($connection, $sqlqus);
    if (mysqli_num_rows($resultqus) > 0) {
      while ($rowqus = mysqli_fetch_assoc($resultqus)) {
        $ans="";
        
        $workdate="";
        $workstatusid="";
        $workid="";
        $sqlans = "SELECT * FROM dailyworkentry where qus_id ='" . $row['question_id'] . "' and emp_id='" . $_SESSION['empid'] . "' and work_date='" . $selecteddate . "' ";
        $resultans = mysqli_query($connection, $sqlans);
        if (mysqli_num_rows($resultans) > 0) {
          while ($rowans = mysqli_fetch_assoc($resultans)) {
            $ans=$rowans['qus_ans'];
            $workdate =$rowans['work_date'];
            $workstatusid=$rowans['dailyworkstatus_id'];
            $workid=$rowans['id'];
          }}



        $rowData = array(
          'question' => $rowqus['question'],
          'qid' => $rowqus['id'],
           'qtype' =>$rowqus['question_type'],
          'ans' => $ans,
          'workdate' => $workdate,
          'workstatusid' => $workstatusid,
          'id'=> $workid
        );
        $response['questions'][] = $rowData;
      }
    }
  }
}

// Return the response as JSON
echo json_encode($response);
