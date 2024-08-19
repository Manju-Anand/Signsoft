<?php
session_start();
ob_start();
if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}


include "includes/connection.php";
$adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
function showworklist()
{
    global $connection;

        $qaid="";
        $post_completed_date ="";
        $empname="";
        $query = "select * from employee where work_approval_section='1'";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $qaid =$row['id'];
            $empname =$row['empname'];
        }

        $query = "select DATE_FORMAT(STR_TO_DATE(created, '%b %d,%Y %r'), '%m') AS month from gd_work_approval where empid = '" . $qaid . "'";
        $select_posts = mysqli_query($connection, $query);
        $i = 0;
        if ($select_posts->num_rows > 0) {
            $noofapprovals = $select_posts->num_rows;
        // while ($row = mysqli_fetch_assoc($select_posts)) {
        //     $id = $row['id'];
        //     $post_assignstaffid=$row['empid'];
        //     $post_orderid = $row['orderid'];
        //     $post_deadline_status = "Not-Done";
        //     $queryorder = "select * from order_customers where id='" .  $post_orderid . "' and order_status='Active'";
        //     $select_postsorder = mysqli_query($connection, $queryorder);
        //     while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
        //         $post_ordertype = $roworder['ordertype'];
        //         if ($post_ordertype == "Internal"){
        //             $post_brandName = $roworder['projectname'];
        //         } else {
        //         $post_brandName = $roworder['brandName'];
        //         }

        //         $post_deadline = $row['deadline'];
        //         $date = new DateTime($post_deadline); // create a DateTime object
        //         $formatted_date = $date->format('d-m-Y');

        //         $post_assigndate = $row['assignedDate'];
        //         $queryemp = "select * from employee where id='" .  $post_assignstaffid . "'";
        //         $select_postsemp = mysqli_query($connection, $queryemp);
        //         while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
        //             $post_empname = $rowemp['empname'];
        //         }


             
           
        //         $post_wstatus = "Not Yet Updated";
                

        //             $querywstatus = "select * from staff_allocation_details where staff_allocation_id='" .  $id . "' order by id desc limit 1";
        //             $select_postswstatus = mysqli_query($connection, $querywstatus);
        //             while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
        //                 $post_wstatus = $rowwstatus['work_status'];
        //                 $post_completed_date =  $rowwstatus['workdate'];
        //             }
        //        if ($post_wstatus == "Completed"){
        //         if (isset($post_completed_date) && $post_completed_date !== "") {
    
        //         if ($post_completed_date <= $formatted_date) {
   
        //             $post_deadline_status = "On-time";
        //         } else {

        //             $post_deadline_status = "Overdue";
        //         }
        //     }
        // }
                

                    $i = $i + 1;
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$empname</td>";
                    echo "<td>$noofapprovals</td>";
  
            }
}
function showprocessjobworklist()
{
    global $connection;

        $qaid="";
        $post_completed_date ="";
        $empname="";
        $query = "select * from employee where work_approval_section='1'";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $qaid = $row['id'];
            $empname = $row['empname'];
        }

        $query = "select DATE_FORMAT(STR_TO_DATE(created, '%b %d,%Y %r'), '%m') AS month from gd_work_approval where empid = '" . $qaid . "'";
        $select_posts = mysqli_query($connection, $query);
        $i = 0;
        if ($select_posts->num_rows > 0) {
            $noofapprovals = $select_posts->num_rows;
            $query = "SELECT * FROM staff_pjob_allocation WHERE id = '$workid' and work_status='Active'";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              
               
                    $orgwokid = $workid;
                    $querywstatus = "select * from staff_allocation_details where staff_allocation_id='" .  $workid . "' order by id desc";
                    $select_postswstatus = mysqli_query($connection, $querywstatus);
                    while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
                        $timetaken = $rowwstatus['timetaken'];
                        $post_timetaken += timeToMinutes($timetaken);
            
                    }
            
                    $sql1 = "SELECT * FROM gd_work_approval where workid ='" . $workid . "'";
                    $result1 = $connection->query($sql1);
                    if ($result1->num_rows > 0) {
                        while ($row2 = $result1->fetch_assoc()) {
                            $editstatus = "Edit";
                            $editid = $row2['id'];
                            $internal = $row2['no_internal_edits']; 
                            $external = $row2['no_external_edits']; 
                            $percompletion = $row2['percentage_completion']; 
                        }
                    }
             
            }
            $post_timetaken1= minutesToTime($post_timetaken);
                

                    $i = $i + 1;
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$empname</td>";
                    echo "<td>$noofapprovals</td>";
  
            }
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
    <style>
        .btn-disabled {
            pointer-events: none;
            cursor: default;
            opacity: 0.6;
        }
    </style>

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
                            <h2 class="main-content-title tx-24 mg-b-5">QA || Process Job Work Approval</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Employees</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Completed Works</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-success" href="add-lead.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add New Lead</a> -->

                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Works</h6>
                                       
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead style="background-color:beige;">
                                                <tr>
                                                    <!-- class="wd-5p" -->
                                                    <th>#</th>

                                                    <th>Staff Name</th>
                                                    <th>No of Approvals</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                    showworklist();
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">Process Job Works Details</h6>
                                       
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example2">
                                            <thead style="background-color:beige;">
                                                <tr>

                                                    <th>#</th>
                                                    <th>Staff Name</th>
                                                    <th>No of Works</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                    showprocessjobworklist();
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Main Content-->
        <!-- Basic modal -->





        <!-- End Basic modal -->

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

    <!-- Gallery js-->
    <script src="../assets/plugins/gallery/picturefill.js"></script>
    <script src="../assets/plugins/gallery/lightgallery.js"></script>
    <script src="../assets/plugins/gallery/lightgallery-1.js"></script>
    <script src="../assets/plugins/gallery/lg-pager.js"></script>
    <script src="../assets/plugins/gallery/lg-autoplay.js"></script>
    <script src="../assets/plugins/gallery/lg-fullscreen.js"></script>
    <script src="../assets/plugins/gallery/lg-zoom.js"></script>
    <script src="../assets/plugins/gallery/lg-hash.js"></script>
    <script src="../assets/plugins/gallery/lg-share.js"></script>

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
    <script src="notification.js"></script>
    <script>

    $('#example2').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});

        function confirmationDelete(anchor) {
            var conf = confirm('Are you sure want to delete this record?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>

</body>

</html>
<?php ob_end_flush();?>