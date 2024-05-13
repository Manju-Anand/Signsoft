<?php
session_start();
include "includes/connection.php";


$selectedMonth = $_POST['month'];
$selectedyear =  $_POST['syear'];
$selectedempid = $_POST['empid'];
$response = array();
$response['checking'] = array();

$sqlworkentrychecking = "SELECT * FROM dailyworkentry where emp_id='" . $selectedempid . "' and month_of_entry='" . $selectedMonth . "'
and year_of_entry='" . $selectedyear  . "'";
$resultworkentrychecking = mysqli_query($connection, $sqlworkentrychecking);
if (mysqli_num_rows($resultworkentrychecking) > 0) {

    $rowData = array(
        'exist' => "yes"
    );
    $response['checking'][] = $rowData;
    
    
    
// Get the number of days in the selected month
// $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date("Y"));
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedyear);
$response['daysInMonth'] = $daysInMonth;
$response['rows'] = array();
$response['questions'] = array();
$response['aggregate'] = array();
// Generate the data array dynamically
for ($day = 1; $day <= $daysInMonth; $day++) {
        $fullday = getDateFromComponents($selectedMonth, $day,  $selectedyear);
        $weekday = getweekdayFromComponents($selectedMonth, $day,  $selectedyear);
    // $fullday=getDateFromComponents($selectedMonth, $day,  date("Y"));

    // $weekday=getweekdayFromComponents($selectedMonth, $day,  date("Y"));
    $rowData = array(
        'day' => $fullday,
        'weekday' => $weekday,
        'data' => generateDataForDay($selectedMonth,$daysInMonth,$selectedempid)
    );
    $response['rows'][] = $rowData;

// =====================Answers array


$sql = "SELECT * FROM trackerdetails where emp_id='" . $selectedempid . "'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
   

        $sqlworkentry = "SELECT * FROM dailyworkentry where emp_id='" . $selectedempid . "' and qus_id='" . $row ['question_id'] . "'
        and work_date='" . $fullday . "'";
        $resultworkentry = mysqli_query($connection, $sqlworkentry);
        if (mysqli_num_rows($resultworkentry) > 0) {
        while ($rowworkentry = mysqli_fetch_assoc($resultworkentry)) {
           
           if (isset($rowworkentry['timetaken'])  && $rowworkentry['timetaken']!== ""){
            $anstime= $rowworkentry['qus_ans'] . " [ " .  $rowworkentry['timetaken'] . " ]";
        
            } else {
                $anstime= $rowworkentry['qus_ans']; 
            } 
            
            $rowData1 = array(
                'workdate' => $rowworkentry['work_date'],
                'answers' =>  $anstime,
                'qid' => $rowworkentry['qus_id'],
                'subqid' => $rowworkentry['subqusid'],
                'timetaken' => $rowworkentry['timetaken']
              );
              $response['answers'][] = $rowData1;

       
    }

}
}
}

// ==================================================







}
    // ========================================Questions Array

    $sql = "SELECT * FROM trackerdetails where emp_id='" . $selectedempid . "' and status='Active'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $sqlqus = "SELECT * FROM questions where id ='" . $row['question_id'] . "'";
        $resultqus = mysqli_query($connection, $sqlqus);
        if (mysqli_num_rows($resultqus) > 0) {

        while ($rowqus = mysqli_fetch_assoc($resultqus)) {

            $rowData = array(
              'question' => $rowqus['question'],
              'qid' => $rowqus['id'],
              'subqid' => "",
              'subquestion' => ""
            );
            $response['questions'][] = $rowData;

                // ******************************* sub questions ***********************
                $sqlsubqus = "SELECT * FROM sub_questions where questionid ='" . $row['question_id'] . "'";
                $resultsubqus = mysqli_query($connection, $sqlsubqus);
                if (mysqli_num_rows($resultsubqus) > 0) {

                while ($rowsubqus = mysqli_fetch_assoc($resultsubqus)) {

                    $rowData = array(
                    'question' => $rowqus['question'],
                    'qid' => $rowqus['id'],
                    'subqid' =>$rowsubqus['id'],
                    'subquestion' => $rowsubqus['subquestion']
                    );
                    $response['questions'][] = $rowData;

                }}
                // ****************************************end sub question *******************
            
          }
    }
}
}
// ==============================aggregate table

$anscount=0;
$sql = "SELECT * FROM trackerdetails where emp_id='" . $selectedempid . "' and status='Active'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sqlqus = "SELECT * FROM questions where id ='" . $row['question_id'] . "'";
        $resultqus = mysqli_query($connection, $sqlqus);
        if (mysqli_num_rows($resultqus) > 0) {
            while ($rowqus = mysqli_fetch_assoc($resultqus)) {
                $anscount=0;
                $qustype=$rowqus['question_type'];
                if ($qustype == 'Count'){
             

                
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $fullday = getDateFromComponents($selectedMonth, $day,  date("Y"));
                    $sqlworkentry = "SELECT * FROM dailyworkentry where emp_id='" . $selectedempid . "' and qus_id='" . $row['question_id'] . "'and work_date='" .  $fullday . "'
                    and subqusid=''";
                    $resultworkentry = mysqli_query($connection, $sqlworkentry);
                    if (mysqli_num_rows($resultworkentry) > 0) {
                        while ($rowworkentry = mysqli_fetch_assoc($resultworkentry)) {
                            $qanswer=$rowworkentry['qus_ans'];
                            $abc=is_numeric($qanswer);
                            if ($abc == 1){
                                $anscount = $anscount + $qanswer;
                               
                                
                            }
                          
                        }
                    }
                }
                $rowDataaggrgate = array(
                    'question' => $rowqus['question'],
                    'qid' => $rowqus['id'],
                    'count'=>$anscount
                  );
                  $response['aggregate'][] = $rowDataaggrgate;



                }
                else {
                    $rowDataaggrgate = array(
                        'question' => $rowqus['question'],
                        'qid' => $rowqus['id'],
                        'count'=>""
                      );
                      $response['aggregate'][] = $rowDataaggrgate;
    
                }
            }
        // ************************ sub question *********************
     

        // *********************end sub question ************************
        
        }}}

// ==========================================================

} else {
    $rowData = array(
        'exist' => "no"
    );
    $response['checking'][] = $rowData;
}

// ========================================================================
// Function to generate data for a specific day
function generateDataForDay($day,$daysInMonth) {
    // Generate the data for the day (example logic)
    $data = array();

    // Example: Generate random data for each day
    for ($i = 1; $i <= $daysInMonth; $i++) {
        // $data[$i] = rand(1, 10000);
        $data[$i] = $i+1;
    }

    return $data;
}


function getDateFromComponents($month, $day, $year) {
    // Create a string in the format "YYYY-MM-DD" using the given components
    $dateString = sprintf('%04d-%02d-%02d', $year, $month, $day);

    try {
        // Create a DateTime object from the date string
        $dateTime = new DateTime($dateString);
         // Get the weekday name
         $weekday = $dateTime->format('l');
        // Format the date as desired (optional)
        return $dateTime->format('d-m-Y');
    } catch (Exception $e) {
        // In case of an invalid date, return false or handle the error as needed
        return false;
    }
}
function getweekdayFromComponents($month, $day, $year) {
    // Create a string in the format "YYYY-MM-DD" using the given components
    $dateString = sprintf('%04d-%02d-%02d', $year, $month, $day);

    try {
        // Create a DateTime object from the date string
        $dateTime = new DateTime($dateString);
         // Get the weekday name
         $weekday = $dateTime->format('l');
        // Format the date as desired (optional)
        return  $weekday;
    } catch (Exception $e) {
        // In case of an invalid date, return false or handle the error as needed
        return false;
    }
}

// Return the response as JSON
echo json_encode($response);
