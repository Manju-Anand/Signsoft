<?php
ob_start();
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['adminname']);
    header("location: signin.php");
}

include "includes/connection.php";
function showorderlist()
{
    global $connection;
    $query = "select * from order_customers where order_status='Active' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_custName= $row['custName'];
        $post_brandName = $row['brandName'];
        $post_order_status = $row['order_status'];
        $post_addr = $row['addr'];
        // $post_modified = $row['modified'];
        $post_custPhone = $row['custPhone'];
        $post_custEmail = $row['custEmail'];


        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_custName</td>";
        echo "<td>$post_brandName</td>";
        echo "<td>$post_custPhone</td>";
        echo "<td>$post_custEmail</td>";
        echo "<td>$post_addr</td>";
        // echo "<td><button class='badge bg-yellow' style='font-size:15px;'></button><a href='allocate-staff.php?add={$id}'><span class='badge bg-yellow' style='font-size:15px;'>Allocate Staff</span></a></td>";
        // <button class="btn ripple btn-outline-primary">Primary</button>
        echo "<td><button class='btn btn-blue' ><a href='allocate-staff.php?add={$id}' style='font-size:15px;color:white;'>Allocate Staff</a></button></td>";

        echo "<td><a class='btn btn-sm btn-warning' href='view-staff-allocation.php?edit={$id}' title='View' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;<a class='btn btn-sm btn-success' href='edit-staff-allocation.php?edit={$id}' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;<a class='btn btn-sm btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='orderlist.php?delete={$id}' class='text-inverse' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
        <span class='fe fe-trash-2'> </span></a>
        </td>";


        // echo "<td><button class='btn ripple btn-outline-success' style='font-size:15px;color:white;'><a href='edit-staff-allocation.php?edit={$id}'>Edit Allocation</a></button></td>";
        // echo "<td><button class='btn ripple btn-outline-danger' style='font-size:15px;color:white;'><a onclick='javascript:confirmationDelete($(this));return false;' href='staffAllocation.php?delete={$id}'>Delete Allocate</a></button></td>";
        echo "</tr>";
    }
}

function deleteorderlist()
{
    global $connection;
    if (isset($_GET['delete'])) {
        // $the_cat_id = $_GET['delete'];
        // $query = "DELETE FROM order_category WHERE empid = '" . $the_cat_id . "'";
        // $delete_query = mysqli_query($connection, $query);
        // if (!$delete_query) {
        //     die('QUERY FAILED' . mysqli_error($connection));
        // }
        // $query = "DELETE FROM order_subcategory WHERE empid = '" . $the_cat_id . "'";
        // $delete_query = mysqli_query($connection, $query);
        // if (!$delete_query) {
        //     die('QUERY FAILED' . mysqli_error($connection));
        // }
        // $query = "DELETE FROM order_followup WHERE empid = '" . $the_cat_id . "'";
        // $delete_query = mysqli_query($connection, $query);
        // if (!$delete_query) {
        //     die('QUERY FAILED' . mysqli_error($connection));
        // }
        // $query = "DELETE FROM order_customers WHERE id = '" . $the_cat_id . "'";
        // $delete_query = mysqli_query($connection, $query);
        // if (!$delete_query) {
        //     die('QUERY FAILED' . mysqli_error($connection));
        // }

        // header("Location: staffAllocation.php");
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
                            <h2 class="main-content-title tx-24 mg-b-5">Staff Allocation</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Staff Allocation</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                         
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">Staff Allocation List</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th class="wd-1p">#</th>
                                                    <th class="wd-15p">Customer Name</th>
                                                    <th class="wd-15p">Brand Name</th>
                                                    <th class="wd-5p">Phone no</th>
                                                    <th class="wd-10p">Emailid</th>
                                                    <th class="wd-5p">Address</th>
                                                    <th class="wd-15p">Allocate</th>
                                                    <th class="wd-15p">Action</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showorderlist();
                                                ?>
                                                <?php
                                                deleteorderlist();
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

                function confirmationDelete(anchor)
                {
                var conf = confirm('Are you sure want to delete this record?');
                if(conf)
                    window.location=anchor.attr("href");
                }
            </script>
</body>

</html>