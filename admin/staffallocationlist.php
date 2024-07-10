<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

include "includes/connection.php";
function showorderlist()
{
    global $connection;
    $i = 0;
    $query = "select * from order_customers where order_status='Active'";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_custName = $row['custName'];
        $post_brandName = $row['brandName'];
        $post_allocated = "No";
        $post_dmallocated = "No";
        $post_otherallocated = "No";
        $post_dmexist = "No";
        $post_otherexist = "No";
        $post_staffname = "";
        $post_assigndate = "";

        $sql1 = "SELECT * FROM order_category WHERE order_id='" . $row['id'] . "' AND category_id IN (SELECT id FROM category WHERE category='Social Media')";

        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row2 = $result1->fetch_assoc()) {
                $post_dmexist = "Yes";
            }}
            $sql1 = "SELECT * FROM order_category WHERE order_id='" . $row['id'] . "' AND category_id not IN (SELECT id FROM category WHERE category='Social Media Marketing')";

            $result1 = $connection->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row2 = $result1->fetch_assoc()) {
                    $post_otherexist = "Yes";
                }}    
    

if ($post_dmexist == "Yes"){
        $sql1 = "SELECT * FROM staff_dm_allocation where orderid='" . $row['id'] . "'";
        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row2 = $result1->fetch_assoc()) {
                $post_allocated = "Yes";
                $post_dmallocated = "Yes";
                $post_staffid = $row2['staffid'];
                $post_assigndate = $row2['assigndate'];
                $sql2 = "SELECT * FROM employee where id='" . $post_staffid . "'";
                $result2 = $connection->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $post_staffname = $row2['empname'];
                    }
                }
            }
        }
    }
    if ($post_otherexist == "Yes"){
        $sql1 = "SELECT * FROM staff_allocation where orderid='" . $row['id'] . "'";
        $result1 = $connection->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row2 = $result1->fetch_assoc()) {
                $post_allocated = "Yes";
                $post_otherallocated = "Yes";
                $post_staffid = $row2['empid'];
                $post_assigndate = $row2['assignedDate'];
                $sql2 = "SELECT * FROM employee where id='" . $post_staffid . "'";
                $result2 = $connection->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $post_staffname = $row2['empname'];
                    }
                }
            }
        }
    }

        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_custName</td>";
        echo "<td>$post_brandName</td>";

        if ($post_allocated == 'Yes') {
            echo "<td>";
if ($post_dmexist == "Yes"){
            if ($post_dmallocated == 'Yes' ) {
                echo "<span class='badge bg-success' style='font-size:15px;'>DM Allocated</span>";
            } else {
                echo "<span class='badge bg-danger' style='font-size:15px;'>DM not Allocated</span>";
            }

            echo "&nbsp;";
        }
        if ($post_otherexist == "Yes"){
            if ($post_otherallocated == 'Yes') {
                echo "<span class='badge bg-warning' style='font-size:15px;'>Other Allocated</span>";
            } else {
                echo "<span class='badge bg-danger' style='font-size:15px;'>Other Not Allocated</span>";
            }
        }
            echo "</td>";
            // echo "<td><span class='badge bg-success' style='font-size:15px;'>Allocated</span><span class='badge bg-warning' style='font-size:15px;'>Allocated</span></td>";
        }

        if ($post_allocated == 'No') {

            echo "<td><span class='badge bg-danger' style='font-size:15px;'>Not Allocated</span></td>";
        }

        echo "<td>$post_staffname</td>";
        echo "<td>$post_assigndate</td>";



        echo "</tr>";
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
                            <h2 class="main-content-title tx-24 mg-b-5">Staff Allocation List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DM Orders</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a> -->
                            <a class="btn ripple btn-primary" href="add-DM-Staff-details.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add & Edit New Staff Allocation</a>
                            <!-- <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
						<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="true">
							<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
						</a>
						<div class="dropdown-menu tx-13">
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
						</div> -->
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Orders</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Allocation Status</th>
                                                    <th>Staff Name</th>
                                                    <th>Assign Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showorderlist();
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