<?php
session_start();
include "includes/connection.php";


if (isset($_POST['view'])) {
    if ($_SESSION['modulename'] == "Digital") {
        $brandname = "";
        if ($_POST["view"] != '') {
            $update_query = "UPDATE staff_dm_allocation SET notify_status = 1 WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
            mysqli_query($connection, $update_query);
        }
        $count = "0";
        $output = '';
        $status_query = "SELECT * FROM staff_dm_allocation WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $count = mysqli_num_rows($result_query);

        $output .= '<div
            class="header-navheading d-flex border-bottom mb-0">
            <h5 class="fw-semibold mb-0 mt-1">Notifications(' . $count . ')</h5>
            <a class="btn ripple btn-primary btn-sm ms-auto" href="dmworklist.php">Latest Works Assigned</a>
        </div>';

        $query = "SELECT * FROM staff_dm_allocation WHERE staffid='" . $_SESSION['empid'] . "'and work_status='Active' ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($connection, $query);
       
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $i = $i + 1;
                //  ===============
                $queryorder = "SELECT * FROM order_customers WHERE id='" . $row['orderid'] . "' ORDER BY id DESC LIMIT 5";
                $resultorder = mysqli_query($connection, $queryorder);
                if (mysqli_num_rows($resultorder) > 0) {
                    while ($roworder = mysqli_fetch_array($resultorder)) {
                        $brandname = $roworder['brandName'];
                    }
                }
                // ================= ms-2====

                $output .= '<div class="header-dropdown-list notification-list">
                            <a href="" class="dropdown-item d-flex border-bottom pb-1">
                                <div class="main-img-user online">' . $i . '
                                </div>
                                <div class="media-body">
                                    <p class="mb-1">' . $brandname . ', <strong>' . $row["postings"] . '</strong> ,<br>' . $row["frequency"] . '</p>
                                    <span>Assigned On: ' . $row['assigndate'] . '</span>
                                </div>
                            </a>
                        
                        </div> ';

                // ====================================================
            }
        }
        $output .= '<div class="dropdown-footer">
        <a class="btn ripple btn-success btn-sm btn-block" href="dmworklist.php">View All Notifications</a>
        </div>';

        $count = "0";
        $status_query = "SELECT * FROM staff_dm_allocation WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $count = mysqli_num_rows($result_query);
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );

        echo json_encode($data);
    } else {
     

        $brandname = "";
        if ($_POST["view"] != '') {
            $update_query = "UPDATE staff_allocation SET notify_status = 1 WHERE notify_status=0 and work_status='Active' and empid='" . $_SESSION['empid'] . "'";
            mysqli_query($connection, $update_query);

            $update_query = "UPDATE staff_dm_graphics_allocation SET notify_status = 1 WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
            mysqli_query($connection, $update_query);
        }
        $othercount = "0";
        $output = '';
        $status_query = "SELECT * FROM staff_allocation WHERE notify_status=0 and work_status='Active' and empid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $othercount = mysqli_num_rows($result_query);
        $status_query = "SELECT * FROM staff_dm_graphics_allocation WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $othercount =  $othercount + mysqli_num_rows($result_query);

        $output .= '<div
            class="header-navheading d-flex border-bottom mb-0">
            <h5 class="fw-semibold mb-0 mt-1">Notifications(' . $othercount . ')</h5>
            <a class="btn ripple btn-primary btn-sm ms-auto" href="">Latest Works Assigned</a>
        </div>';
        // ************* work assigned by admin ********************
        $query = "SELECT * FROM staff_allocation WHERE empid='" . $_SESSION['empid'] . "' and work_status='Active' ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($connection, $query);
       
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $i = $i + 1;
                //  ===============
                $queryorder = "SELECT * FROM order_customers WHERE id='" . $row['orderid'] . "' ORDER BY id DESC LIMIT 5";
                $resultorder = mysqli_query($connection, $queryorder);
                if (mysqli_num_rows($resultorder) > 0) {
                    while ($roworder = mysqli_fetch_array($resultorder)) {
                        $brandname = $roworder['brandName'];
                    }
                }
                // =====================

                $output .= '<div class="header-dropdown-list notification-list">
                            <a href="" class="dropdown-item d-flex border-bottom pb-1">
                                <div class="main-img-user online">' . $i . '
                                </div>
                                <div class="media-body ms-2">
                                    <p class="mb-1">' . $brandname . ', <strong>' . $row["work_assigned"] . '</strong><br> DeadLine: ' . $row["deadline"] . '</p>
                                    <span>Assigned On: ' . $row['assignedDate'] . '</span>
                                </div>
                            </a>
                        
                        </div> ';

                // ====================================================
            }
        }
        // ******************** work assigned by dm ************
        $query = "SELECT * FROM staff_dm_graphics_allocation WHERE staffid='" . $_SESSION['empid'] . "' and work_status='Active' ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($connection, $query);
       
       
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $i = $i + 1;
                //  ===============
                $queryorder = "SELECT * FROM order_customers WHERE id='" . $row['orderid'] . "' ORDER BY id DESC LIMIT 5";
                $resultorder = mysqli_query($connection, $queryorder);
                if (mysqli_num_rows($resultorder) > 0) {
                    while ($roworder = mysqli_fetch_array($resultorder)) {
                        $brandname = $roworder['brandName'];
                    }
                }
                $queryemp = "SELECT * FROM employee WHERE id='" . $row['assigned_staffid'] . "'";
                $resultemp = mysqli_query($connection, $queryemp);
                if (mysqli_num_rows($resultemp) > 0) {
                    while ($rowemp = mysqli_fetch_array($resultemp)) {
                        $empname = $rowemp['empname'];
                    }
                }
                // =====================

                $output .= '<div class="header-dropdown-list notification-list">
                            <a href="" class="dropdown-item d-flex border-bottom pb-1">
                                <div class="main-img-user online">' . $i . '
                                </div>
                                <div class="media-body ms-2">
                                    <p class="mb-1">' . $brandname . ', <strong>' . $row["postings"] . '</strong><br> Assigned By: ' . $empname . '</p>
                                    <span>Assigned On: ' . $row['assigndate'] . '</span>
                                </div>
                            </a>
                        
                        </div> ';

                // ====================================================
            }
        }
        $output .= '<div class="dropdown-footer">
        <a class="btn ripple btn-success btn-sm btn-block" href="">View All Notifications</a>
        </div>';

        $count = "0";
        $status_query = "SELECT * FROM staff_allocation WHERE notify_status=0 and work_status='Active' and empid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $count = mysqli_num_rows($result_query);
        $status_query = "SELECT * FROM staff_dm_graphics_allocation WHERE notify_status=0 and work_status='Active' and staffid='" . $_SESSION['empid'] . "'";
        $result_query = mysqli_query($connection, $status_query);
        $count = $count + mysqli_num_rows($result_query);


        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );

        echo json_encode($data);




    }
}
