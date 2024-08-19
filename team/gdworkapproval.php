<?php
session_start();

if (!isset($_SESSION['empname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
	unset($_SESSION['empname']);
		session_destroy();
	header("location: signin.php");
}

include "includes/connection.php";
function showworklist()
{
    global $connection;
    $queryemphod = "select * from employee where department_id in (select id from department where dname='Graphics') and hod='Yes'";
    $select_postsemphod = mysqli_query($connection, $queryemphod);
    while ($rowemphod = mysqli_fetch_assoc($select_postsemphod)) {
        // $post_empname1 = $rowemphod['empname'];
        $post_emphodid = $rowemphod['id'];
        $post_completed_date ="";
      
        $query = "select * from staff_dm_graphics_allocation where staffid='" . $post_emphodid . "' order by id desc";
        $select_posts = mysqli_query($connection, $query);
        $i = 0;
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $id = $row['id'];
            $redirectStat =  $row['redirect_status'];
            $post_orderid = $row['orderid'];

            $post_deadline_status = "Not-Done";
            $post_completed_date ="";
            $post_staffname ="";
            $approval_status = "No";
            // and order_status='Active'
            $queryorder = "select * from order_customers where id='" .  $post_orderid . "'";
            $select_postsorder = mysqli_query($connection, $queryorder);
            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

                $post_brandName = $roworder['brandName'];
                $post_postings = $row['postings'];
                $post_deadline = $row['deadline'];
                $date = new DateTime($post_deadline); // create a DateTime object
                $formatted_date = $date->format('d-m-Y');

                $post_assigndate = $row['assigndate'];
                $post_redirectstatus = $row['redirect_status'];
                $post_assignstaffid = $row['assigned_staffid'];
                $post_staffid = $row['staffid'];
                $post_redirectstaffid = $row['redirect_staffid'];
                $queryemp = "select * from employee where id='" .  $post_assignstaffid . "'";
                $select_postsemp = mysqli_query($connection, $queryemp);
                while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                    $post_empname = $rowemp['empname'];
                }
               
                $post_wstatus = "Not Yet Updated";
                if ($redirectStat == "Redirected") {

                    $querywstatus1 = "select * from staff_dm_graphics_allocation where redirect_recordid='" .  $id . "'";
                    $select_postswstatus1 = mysqli_query($connection, $querywstatus1);
                    while ($rowwstatus1 = mysqli_fetch_assoc($select_postswstatus1)) {
                        $checkid = $rowwstatus1['id'];

                        $queryemp = "select * from employee where id='" .  $post_redirectstaffid . "'";
                        $select_postsemp = mysqli_query($connection, $queryemp);
                        while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                            $post_staffname = $rowemp['empname'];
                        }

                        $queryapproval = "select * from gd_work_approval where workid='" .  $checkid . "'";
                        $select_postsapproval = mysqli_query($connection, $queryapproval);
                        while ($rowapproval = mysqli_fetch_assoc($select_postsapproval)) {
                            $approval_status = "Yes";
                        }


                        $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $checkid . "' order by id desc limit 1";
                        $select_postswstatus = mysqli_query($connection, $querywstatus);
                        while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
                            $post_wstatus = $rowwstatus['work_status'];
                            $post_completed_date =  $rowwstatus['workdate'];
                        }
                    }
                } else {

                    $queryemp = "select * from employee where id='" .  $post_staffid . "'";
                    $select_postsemp = mysqli_query($connection, $queryemp);
                    while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                        $post_staffname = $rowemp['empname'];
                    }

                    $queryapproval = "select * from gd_work_approval where workid='" .   $id . "'";
                        $select_postsapproval = mysqli_query($connection, $queryapproval);
                        while ($rowapproval = mysqli_fetch_assoc($select_postsapproval)) {
                            $approval_status = "Yes";
                        }


                    $querywstatus = "select * from staff_dm_graphics_allocation_details where staff_dm_allocation_id='" .  $id . "' order by id desc limit 1";
                    $select_postswstatus = mysqli_query($connection, $querywstatus);
                    while ($rowwstatus = mysqli_fetch_assoc($select_postswstatus)) {
                        $post_wstatus = $rowwstatus['work_status'];
                        $post_completed_date =  $rowwstatus['workdate'];
                    }
                }
                if (isset($post_completed_date) && $post_completed_date !== "") {
    
                if ($post_completed_date <= $formatted_date && $post_wstatus == "Completed") {
   
                    $post_deadline_status = "On-time";
                } else {

                    $post_deadline_status = "Overdue";
                }
            }
                


                // if ($post_wstatus === 'Completed') {
                    $i = $i + 1;
                    if ($approval_status == "Yes"){
                        echo "<tr style='color:brown;font-weight:bold;'>";
                    }else {
                        echo "<tr>";
                    }
                    
                    echo "<td>$i</td>";
                    echo "<td>$post_brandName</td>";
                    // echo "<td>$post_postings</td>";

                    echo "<td>$post_empname</td>";
                    echo "<td>$post_assigndate</td>";
                    echo "<td>$post_staffname</td>";
                    echo "<td>$formatted_date </td>";
                    echo "<td>$post_wstatus</td>";


                    if ($post_redirectstatus === 'Self') {
                        echo "<td ><span class='badge bg-primary' style='font-size:15px'>$post_redirectstatus</span></td>";
                    }
                    if ($post_redirectstatus === 'Redirected') {
                        echo "<td ><span class='badge bg-pink' style='font-size:15px'>$post_redirectstatus</span></td>";
                    }

                    if ($post_deadline_status === "On-time") {
                        echo "<td ><span class='badge bg-success' style='font-size:15px'>$post_deadline_status</span></td>";
                    }
                    if ($post_deadline_status === "Overdue") {
                        echo "<td ><span class='badge bg-danger' style='font-size:15px'>$post_deadline_status</span></td>";
                    }
                    if ($post_deadline_status === "Not-Done") {
                        echo "<td ><span class='badge bg-warning' style='font-size:15px'>$post_deadline_status</span></td>";
                    }
                    if ($post_deadline_status === "Not-Done") {
                        echo "<td>";

                        echo "<a class='btn btn-sm btn-blue btn-disabled' href='' title='Enter Work Details' style='color:white;font: weight 200px;' >
                            <span class='fe fe-edit'> </span></a> &nbsp;";
    
     
                        echo "<a class='btn btn-sm btn-gray-dark  view-details-btn btn-disabled' href=''   data-recordid={$id} title='View work Details' style='color:white;font: weight 200px;'>
                            <span class='fe fe-eye'> </span></a>";
    
                        echo "</td>";
                    }else{
                    echo "<td>";

                    echo "<a class='btn btn-sm btn-blue' href='add-gd-work-approval.php?workid={$id}' title='Enter Work Details' style='color:white;font: weight 200px;'>
                        <span class='fe fe-edit'> </span></a> &nbsp;";


                    echo "<a class='btn btn-sm btn-gray-dark  view-details-btn' href='View-gd-work-approval.php?workid={$id}'   data-recordid={$id} title='View work Details' style='color:white;font: weight 200px;'>
                        <span class='fe fe-eye'> </span></a>";

                    echo "</td>";
                    }


                    echo "</tr>";
                // }
            }
        }
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
                            <h2 class="main-content-title tx-24 mg-b-5">Work List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Graphic Designers</a></li>
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
                                        <p class="text-muted card-sub-title"><?php echo $_SESSION['empname'] ?> , These are the List of works details entered by Graphic Designers.</p>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead style="background-color:beige;">
                                                <tr>
                                                    <!-- class="wd-5p" -->
                                                    <th>#</th>

                                                    <th>Brand Name</th>
                                                    <!-- <th>Postings</th> -->
                                                    <th>Assigned By</th>
                                                    <th>Assigned Date</th>
                                                    <th>Staff</th>
                                                    <th>Deadline</th>
                                                    <th>Work Status</th>
                                                    <th class="wd-5p">Redirect Status</th>
                                                    <th class="wd-5p">Deadline Status</th>
                                                    <th class="wd-10p">Action</th>
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
        function confirmationDelete(anchor) {
            var conf = confirm('Are you sure want to delete this record?');
            if (conf)
                window.location = anchor.attr("href");
        }
    </script>

</body>

</html>