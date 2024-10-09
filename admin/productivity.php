<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}


include "includes/connection.php";
function employeechk()
{
    global $connection;
    $sql = "SELECT id, basic_salary, company_expense FROM employee WHERE status='Active'";
    $result = $connection->query($sql);

    $allFieldsPresent = true;

    if ($result->num_rows > 0) {
        // Loop through the result set
        while ($row = $result->fetch_assoc()) {
            if (empty($row['basic_salary']) || empty($row['company_expense'])) {
                $allFieldsPresent = false;
                break; // No need to check further if one missing field is found
            }
        }
    } else {
        $allFieldsPresent = false; // No active employees found
    }

    if ($allFieldsPresent) {
        // Perform further calculations in the function


        showquestions();
    } else {
        // Alert if any field is missing
        echo "<script>alert('Some employees are missing Basic-Salary or Company-Expense.');</script>";
    }
}
function showquestions()
{
    global $connection;
    $query = "select * from employee where status='Active' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_title = $row['empname'];

        // ====================== Calculation starts ================
        $bs = (float)$row['basic_salary'];
        $ce = (float)$row['company_expense'];
        $staff_cost = $bs + $ce;
        $per_hour_cost = ($staff_cost / 200) * 2; // 200 hours in minutes- 12000

        // echo $per_hour_cost . " - per /hour cost of " . $post_title . "<br>";
        // =================================================================================
        $post_timetaken = 0;
        $orderid = "";
        $per_of_work = "";
        $project_quote = 0;
        $green_completion = 0;
        $orderamt = 0;
        $involvementpercentage = 0;
        $orderamt1 = 0;
        $orderamt2 = 0;
        $pts = 0;
        $pts1 = 0;
        $catid = "";
        // ===================== staff allocation =============================================
        $query1 = "select * from staff_allocation where empid='" . $id . "' AND MONTH(assignedDate) = MONTH(CURRENT_DATE)-1 and work_status='Active'";
        $select_posts1 = mysqli_query($connection, $query1);
        while ($row1 = mysqli_fetch_assoc($select_posts1)) {
            $post_timetaken = 0;
            $orderid = $row1['orderid'];
            // echo $orderid . " - orderid " .  "<br>";
            $per_of_work = $row1['per_of_work'];
            $catid = $row1['entryid'];
            // echo "Percentage : " . $per_of_work . "<br>";
            $query2 = "select * from order_customers where id='" . $orderid . "'";
            $select_posts2 = mysqli_query($connection, $query2);
            while ($row2 = mysqli_fetch_assoc($select_posts2)) {
                $order_expense = $row2['order_expense'];
                $orderamt2 = $row2['quotedAmt'];
            }

            $querycategory = "select * from order_category where order_id='" .  $orderid . "'";
            $select_postscategory = mysqli_query($connection, $querycategory);
            if ($select_postscategory) {
                // Check the number of records
                $num_records = mysqli_num_rows($select_postscategory);
                while ($rowcategory = mysqli_fetch_assoc($select_postscategory)) {
                    $querysplitup = "select * from quote_splitup where orderid='" . $orderid . "' and itemid='" . $catid . "'";
                    $select_postssplitup = mysqli_query($connection, $querysplitup);
                    while ($rowsplitup = mysqli_fetch_assoc($select_postssplitup)) {
                        $orderamt1 = $rowsplitup['price'];
                        $order_expense = $rowsplitup['order_expense'];
                    }
                }
                if ($orderamt1 == 0) {
                    $orderamt = $orderamt2;
                } else {
                    $orderamt = $orderamt1;
                }
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            $project_quote = $orderamt - $order_expense;
            $involvementpercentage = $project_quote *  $per_of_work / 100;
            $post_timetaken = '200';
            $green_completion = round($involvementpercentage / $per_hour_cost, 2);
            $pts1 = round($green_completion / $post_timetaken * 100, 2);
            $pts  += $pts1;
        }
        //    ============================== staff allocation =======================
        // ================================= staff DM allocation ===============================
        $query1 = "select * from staff_dm_allocation where staffid='" . $id . "' AND MONTH(assigndate) = MONTH(CURRENT_DATE)-1 and work_status='Active'";
        $select_posts1 = mysqli_query($connection, $query1);
        while ($row1 = mysqli_fetch_assoc($select_posts1)) {
            $post_timetaken = 0;
            $orderid = $row1['orderid'];
            $per_of_work = $row1['workpercentage'];
            $order_expense = $row1['promoamt'];
            $orderamt = $row1['payment'];

            $project_quote = $orderamt - $order_expense;
            $involvementpercentage = $project_quote *  $per_of_work / 100;

            $post_timetaken = "200";  // 200 hours - full hours work for digital marketers

            $green_completion = round($involvementpercentage / $per_hour_cost, 2);
            $pts1 = round($green_completion / $post_timetaken * 100, 2);
            $pts  += $pts1;
        }
        // ================================= staff DM allocation ===============================
        // ================================= staff GD allocation ===============================
        $postercount = 0;
        $videocount = 0;
        $gifcount = 0;
        $timecount = 0;
        $posterpervalue  = 0;
        $videopervalue = 0;
        $gifpervalue  = 0;

        $query21 = "select * from graphics_masters";
        $select_posts21 = mysqli_query($connection, $query21);
        while ($row21 = mysqli_fetch_assoc($select_posts21)) {
            $postervalue = intval($row21['poster']);
            $videovalue = intval($row21['video']);
            $gifvalue = intval($row21['gif']);
        }


        $query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'Poster'";
        $select_posts1 = mysqli_query($connection, $query1);
        if ($select_posts1->num_rows > 0) {
            // $postercount = $select_posts1->num_rows;
            $postercount = 0;

            while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
                // echo "pos1";
                $query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
                $select_posts21 = mysqli_query($connection, $query21);
                while ($row21 = mysqli_fetch_assoc($select_posts21)) {
                    $postercount += 1;
                }
            }
        } else {
            // echo "StaffId :" . $id;
        }
        $query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'GIF'";
        $select_posts1 = mysqli_query($connection, $query1);
        if ($select_posts1->num_rows > 0) {
            // $gifcount = $select_posts1->num_rows;

            $gifcount = 0;
            while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
                // echo "gif1";
                $query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
                $select_posts21 = mysqli_query($connection, $query21);
                while ($row21 = mysqli_fetch_assoc($select_posts21)) {
                    $gifcount += 1;
                }
            }
        }
        $query1 = "SELECT * 
                FROM staff_dm_graphics_allocation 
                WHERE staffid = '" . $id . "' 
                AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
                AND work_status = 'Active' and postings = 'Video'";
        $select_posts1 = mysqli_query($connection, $query1);
        if ($select_posts1->num_rows > 0) {
            // $videocount = $select_posts1->num_rows;

            $videocount = 0;
            while ($rowposter = mysqli_fetch_assoc($select_posts1)) {
                // echo "vid1";
                $query21 = "select * from gd_work_approval where workid='" . $rowposter['id'] . "'";
                $select_posts21 = mysqli_query($connection, $query21);
                while ($row21 = mysqli_fetch_assoc($select_posts21)) {
                    $videocount += 1;
                }
            }
        }


        $post_timetaken = '200';
        $order_expense = 0;

        // echo "StaffId :" . $id . "<br>";
        // echo "Poster : " . $postercount. "<br>";
        // echo "Video :" . $videocount. "<br>";
        // echo "GIF  :" . $gifcount. "<br>";
        // echo "<hr>";

        if ($post_timetaken > 0) {

            $videoamt = $videocount * $videovalue;
            $gifamt = $gifcount * $gifvalue;
            $posteramt = $postercount * $postervalue;

            $involvementpercentage = $videoamt + $gifamt + $posteramt;
            $project_quote = ($involvementpercentage - $order_expense) / 2;
            $green_completion = round($project_quote / $per_hour_cost, 2);
            $pts1 = round(($green_completion / $post_timetaken) * 100, 2);
            $pts  += $pts1;
        }








        // ================================= staff GD allocation ===============================
        // ================================= staff GD allocation ===============================

        // $query1 = "SELECT * 
        //         FROM staff_dm_graphics_allocation 
        //         WHERE staffid = '" . $id . "' 
        //         AND MONTH(STR_TO_DATE(assigndate, '%d-%m-%Y')) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) 
        //         AND YEAR(STR_TO_DATE(assigndate, '%d-%m-%Y')) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) 
        //         AND work_status = 'Active'";
        // $select_posts1 = mysqli_query($connection, $query1);
        // while ($row1 = mysqli_fetch_assoc($select_posts1)) {

        //     $post_timetaken = 0;
        //     $orderid = $row1['orderid'];


        //     $query21 = "select * from staff_dm_allocation where  orderid='" . $orderid . "'";
        //     $select_posts21 = mysqli_query($connection, $query21);
        //     while ($row21 = mysqli_fetch_assoc($select_posts21)) {
        //         $order_expense = intval($row21['promoamt']);
        //         $orderamt = intval($row21['payment']);
        //     }



        //     $workid = $row1['id'];
        //     $querywstatus = "select * from gd_work_approval where workid='" .  $workid . "'";
        //     $select_postswstatus = mysqli_query($connection, $querywstatus);
        //     while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
        //         $timetaken = $rowwstatus['total_hours_worked'];
        //         $post_timetaken += timeToMinutes($timetaken);
        //         $per_of_work = $rowwstatus['percentage_completion'];
        //     }



        //     if ($post_timetaken > 0) {
        //         $involvementpercentage = $orderamt *  intval($per_of_work) / 100;
        //         $project_quote = $involvementpercentage - $order_expense;
        //         $green_completion = round($project_quote / $per_hour_cost, 2);
        //         $pts1 = round($green_completion / $post_timetaken * 100, 2);
        //         $pts  += $pts1;
        //     }
        // }




        // ================================= staff GD allocation ===============================
        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$id</td>";
        echo "<td>$post_title</td>";
        echo "<td>$pts</td>";





        echo "</tr>";
    }
}
function timeToMinutes($time)
{
    $parts = explode(':', $time);
    if (count($parts) == 2) {
        $hours = intval($parts[0]);
        $minutes = intval($parts[1]);
        return ($hours * 60) + $minutes;
    }
    return intval($time) * 60; // In case there's no colon, treat it as hours
}

function minutesToTime($minutes)
{
    $hours = floor($minutes / 60);
    $remainingMinutes = $minutes % 60;
    return sprintf('%d:%02d', $hours, $remainingMinutes);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon">

    <!-- Title -->
    <title>Signsoft - Empowering Efficiency, Unleashing Possibilities</title>

    <!---bootstrap css-->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!---Style css-->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!---Plugins css-->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini">


    <!-- Loader -->
    <!-- <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div> -->
    <!-- End Loader -->

    <!-- Page -->
    <div class="page">
        <div>
            <?php include 'includes/header.php'; ?>
        </div>
        <!-- Main Content-->
        <div class="main-content side-content pt-0">
            <div class="side-app">

                <div class="main-container container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-5">Productivity</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Last Month</li>
                            </ol>
                        </div>

                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">Employee Productivity Score [Last Month]</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p">#</th>
                                                    <th class="wd-20p">emp id</th>
                                                    <th class="wd-20p">Emp Name</th>
                                                    <th class="wd-5p">Productivity</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                employeechk();
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->


                </div>
            </div>
        </div>
        <!-- End Main Content-->


        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->

    </div>
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- Jquery js-->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select2 js-->
    <script src="../assets/plugins/select2/js/select2.min.js"></script>

    <!-- DATA TABLE JS-->
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/js/table-data.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>
    <!-- Select2 js-->
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/js/select2.js"></script>
    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
    <script>
        function confirmationDelete(anchor) {
            var conf = confirm('Are you sure want to delete this record?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>
</body>

</html>