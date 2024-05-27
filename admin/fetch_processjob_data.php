<?php
// Include your database connection or any necessary files

include "includes/connection.php";; // Your database connection

if (isset($_GET['monthselect'])) {
    $cquality = $_GET['monthselect'];
    showorderlist($cquality);
}
function showorderlist($selectedMonth)
{
    global $connection;
    // $selectedMonth = $_POST['month-select']; 
    $query = "SELECT * FROM staff_pjob_allocation WHERE SUBSTRING(assigndate, 4, 2) = '$selectedMonth' ORDER BY id DESC";
     $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];

        $post_jobname="";
        $sqljob = "SELECT * FROM process_jobs where id='" . $row['jobid'] . "'";
        $resultjob = $connection->query($sqljob);
        if ($resultjob->num_rows > 0) {
        while($rowjob = $resultjob->fetch_assoc()) {
            $post_jobname= $rowjob['jobname'];
        }}
       
        $post_staffname="";
                $sql1 = "SELECT * FROM employee where id='" . $row['empid'] . "'";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_staffname= $row2['empname'];
            }
        }
                $post_timetaken=0;
                $sql1 = "SELECT * FROM staff_pjob_allocation_details where staff_allocation_id ='" . $id . "'";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_timetaken += timeToDecimal11($row2['timetaken']);
                }}

                $post_description="";
                $post_workstatus="";
                $sql1 = "SELECT * FROM staff_pjob_allocation_details where staff_allocation_id ='" . $id . "' order by id desc limit 1";
                $result1 = $connection->query($sql1);
                if ($result1->num_rows > 0) {
                while($row2 = $result1->fetch_assoc()) {
                    $post_description=$row2['job_description'];
                    $post_workstatus=$row2['work_status'];
                }}
            

       
            $post_deadline = $row['deadline'];
            $post_assigndate = $row['assigndate'];
      
        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
      
        echo "<td>$post_staffname</td>";
        echo "<td>$post_jobname</td>";

        echo "<td>$post_workstatus</td>";
        echo "<td>$post_description</td>";
      
        
        echo "<td>$post_timetaken</td>";
        echo "<td>$post_assigndate</td>"; 
        echo "<td>$post_deadline</td>"; 
        
 
        echo "<td><a class='btn btn-sm btn-cyan view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id}  title='View Process Job  Details' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;
        </td>";

        // <a class='btn btn-sm btn-success edit-details-btn' data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='Edit DM Content' style='color:white'>
        // <span class='fe fe-edit'> </span></a>&nbsp;</a>
        echo "</tr>";
    }
}
// Function to convert HH:MM to decimal hours
function timeToDecimal11($time) {

    list($hours, $minutes) = explode(':', $time);
    return $hours + ($minutes / 60);
}
?>