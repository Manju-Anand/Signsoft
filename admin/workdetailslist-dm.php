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
    $query = "select * from staff_dm_allocation where work_status = 'Active' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_orderid = $row['orderid'];
        $post_staffname = $row['staffname'];
        $post_startdate = $row['startdate'];
        $post_startdate1 = date('d-m-Y', strtotime($post_startdate));


        $post_enddate = $row['enddate'];
        $date = new DateTime($post_enddate);
        $post_enddate1 = $date->format('d-m-Y');



        $post_allotamt = $row['payment'];
        $sql = "SELECT * FROM order_customers where id='" . $post_orderid . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
        while($row1 = $result->fetch_assoc()) {
            if ($row1['ordertype']=="Internal"){
                $post_brandName= $row1['projectname'];
            } else {
            $post_brandName= $row1['brandName'];
            }
        }}

        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_staffname</td>";
        echo "<td>$post_brandName</td>";
        echo "<td>$post_allotamt</td>";
        echo "<td>$post_startdate1</td>";
        echo "<td>$post_enddate1</td>"; 
        echo "<td>$post_orderid</td>";    
        echo "<td><a href='view-DM-work-details.php?edit={$post_orderid}' class='btn btn-sm btn-cyan'   data-recordid={$post_orderid}  title='View DM Content &  Details' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;
        </td>";
 
        // echo "<td><a class='btn btn-sm btn-cyan  view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$post_orderid}  title='View DM Content &  Details' style='color:white'>
        // <span class='fe fe-eye'> </span></a>&nbsp;
        // </td>";

        // <a class='btn btn-sm btn-success edit-details-btn' data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='Edit DM Content' style='color:white'>
        // <span class='fe fe-edit'> </span></a>&nbsp;</a>
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
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
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
                            <h2 class="main-content-title tx-24 mg-b-5">DM Team Work List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Work Details List</li>
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
                                        <h6 class="card-title mb-1">List of DM Work Details List</h6>
                                       
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Staff Name</th>
                                                    <th>Brand Name</th>
                                                    <th>Alloted Amount</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Order Id</th>
                                                    <th>Action</th>
                                                   
                                                    
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

</body>

</html>