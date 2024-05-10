<?php
session_start();
include "includes/connection.php";

$selectedMonth = $_POST['month'];
$selecteddate = $_POST['tdate'];
$response = array();

$response['daysInMonth'] = $selecteddate;
$response['questions'] = array();

$sql = "SELECT * FROM trackerdetails where emp_id='" . $_SESSION['empid'] . "' and status='Active'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sqlqus = "SELECT * FROM questions where id ='" . $row['question_id'] . "'";
        $resultqus = mysqli_query($con, $sqlqus);
        if (mysqli_num_rows($resultqus) > 0) {
            while ($rowqus = mysqli_fetch_assoc($resultqus)) {
                $rowData = array(
                    'question' => $rowqus['question'],
                    'qid' => $rowqus['id'],
                    'qtype' => $rowqus['question_type'],
                    'subquestion' => "",
                    'subqid' => "",
                );
                $response['questions'][] = $rowData;
                // ==================SubQusetion ========================
                $subquestion = "";
                $sqlsubqus = "SELECT * FROM sub_questions where questionid ='" . $row['question_id'] . "'";
                $resultsubqus = mysqli_query($con, $sqlsubqus);
                if (mysqli_num_rows($resultsubqus) > 0) {
                    while ($rowsubqus = mysqli_fetch_assoc($resultsubqus)) {
                        $subquestion = "";
                        $rowData = array(
                            'question' => $rowqus['question'],
                            'qid' => $rowqus['id'],
                            'qtype' => $rowqus['question_type'],
                            'subquestion' => $rowsubqus['subquestion'],
                            'subqid' => $rowsubqus['id'],

                        );
                        $response['questions'][] = $rowData;
                    }
                } 
                    // ==================SubQusetion ========================

                  
                }
            }
        }
    }


// Return the response as JSON
echo json_encode($response);
