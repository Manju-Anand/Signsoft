<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$recordstatus = "New";
$corderid = $data['correctorderid'];
$datastatus = $data['datastatus'];
echo $datastatus;
if ($datastatus == "SavedData") {
  $recordstatus = "Edited";
}
echo $recordstatus;
echo $corderid;
// ====================== delete already entered datas =============
// Iterate through the data and insert into the database



if (isset($data['staffallocationdataToSave'])) {
  echo "1";
  foreach ($data['staffallocationdataToSave'] as $row) {
    $orderid = $row['orderid'];
    echo "2";
    $Payment = $row['Payment'];
    $Postings = $row['Postings'];
    $staffName = $row['staffName'];
    $staffid = $row['staffid'];
    $Frequency = $row['Frequency'];
    $StartDate = $row['StartDate'];
    $EndDate = $row['EndDate'];
    $promoamt = $row['promoamt'];
    $assigndate = $row['assigndate'];
    $recordstatus = $row['status'];
    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");
    // $assigndate = date("d-m-Y");
    $editid = $row['editid'];
echo "editid" . $editid ."!";
    // Example usage:
    $cDate =    $EndDate;
    $estartDate = formatnewDate($cDate);
    $eendDate = addOneDay($cDate);
    // echo "New Date (1 day added): " . $newDate;



    $last_id = "";
    $brandName =  "";
    $queryorder = "select brandName,id from order_customers where id='" .  $orderid . "'";
    $select_postsorder = mysqli_query($connection, $queryorder);
    while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
      $brandName =  $roworder['brandName'];
    }
    $title = $brandName . " - Monthly Report";
    echo  $title;
    // ==================================delete dm reprts and dmevents table netries==========================================
    $sql = "DELETE FROM dm_reports WHERE orderid='" . $orderid . "'";
    if ($connection->query($sql) === TRUE) {
      echo "dm_report Record deleted successfully";
    } else {
      echo "Error deleting record: " . $connection->error;
    }

    $sql = "DELETE FROM dmevents WHERE orderid='" . $orderid . "' and title='" . $title . "'";
    if ($connection->query($sql) === TRUE) {
      echo "dmevents Record deleted successfully";
    } else {
      echo "Error deleting record: " . $connection->error;
    }
    // ==================================delete dm reprts and dmevents table netries==========================================





    // Perform the SQL query to insert data into the database
    // 
      if (isset($row['editid']) && $row['editid'] !== "") {
        // if ($recordstatus == "Edited") {
      $sql = "UPDATE staff_dm_allocation SET payment='" . $Payment . "',postings='" . $Postings . "',staffname='" . $staffName . "',staffid='" . $staffid . "',frequency='" . $Frequency . "',
      startdate='" . $StartDate . "',enddate='" . $EndDate . "',promoamt='" . $promoamt . "',modified='" . $postdate . "',orderid='" . $orderid . "',status='" . $recordstatus . "'
      ,assigndate='" . $assigndate . "' WHERE id='" . $editid . "'";
      if ($connection->query($sql) !== TRUE) {

        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        echo "staff_dm_allocation updated successfully";
      }
    // }
      // dm_reports adding
      $sql = "INSERT INTO dm_reports (orderid,dm_allot_id,dmreport_date,status,created,empid) VALUES
      ('$orderid','$editid', '$EndDate', 'Not Done','$postdate','$staffid')";
      if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        echo "dm_reports saved successfully";
      }
      // dmevents adding
      $sql = "INSERT INTO dmevents (orderid,title,start_date,end_date,empid) VALUES
      ('$orderid','$title', '$estartDate', '$eendDate','$staffid')";

      if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        echo "dmevents saved successfully";
      }



    // } elseif ($recordstatus == "New") {

    }else{


      $sql = "INSERT INTO staff_dm_allocation (orderid,payment,postings,staffname, staffid, frequency, startdate, enddate,promoamt,status,assigndate,created,work_status) VALUES
      ('$orderid','$Payment','$Postings','$staffName', '$staffid', '$Frequency', '$StartDate', '$EndDate', '$promoamt','$recordstatus','$assigndate','$postdate','Active')";
      if ($connection->query($sql) !== TRUE) {

        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        $last_id = $connection->insert_id;
        echo "staff_dm_allocation saved successfully";
      }

      // dm_reports adding
      $sql = "INSERT INTO dm_reports (orderid,dm_allot_id,dmreport_date,status,created,empid) VALUES
      ('$orderid','$last_id', '$EndDate', 'Not Done','$postdate','$staffid')";
      if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        echo "dm_reports saved successfully";
      }
      // dmevents adding
      $sql = "INSERT INTO dmevents (orderid,title,start_date,end_date,empid) VALUES
      ('$orderid','$title', '$estartDate', '$eendDate','$staffid')";

      if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
      } else {
        echo "dmevents saved successfully";
      }
    } 
  }
}

function formatnewDate($dateString)
{
  $date = new DateTime($dateString);
  return $date->format('Y-m-d');
}

function addOneDay($dateString)
{
  $date = new DateTime($dateString);
  $date->add(new DateInterval('P1D'));
  return $date->format('Y-m-d');
}


// Close the database connection
$connection->close();
