<?php
ob_start();
session_start();

if (!isset($_SESSION['empname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['empname']);
    header("location: signin.php");
}

include "includes/connection.php";
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
        .hidden-cell {
            display: none;
        }

        /* Apply styles to the entire table */
        #example1 {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            margin-top: 20px;
            color: black;
            table-layout: fixed;
            /* Allow automatic column width adjustment */
            overflow: auto;
            /* Enable scrollbar */
        }

        /* Apply styles to table header cells */
        #example1 th {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            /* text-align: center; Center-align header cells */
            text-align: left;
            font-weight: bold;

            width: 100px;
            /* Allow automatic column width adjustment */
        }

        /* Apply styles to table data cells */
        #example1 td {
            border: 1px solid #ccc;
            padding: 15px;
            /* text-align: center; Center-align header cells */
        }

        /* Apply alternating row colors for better readability */
        #example1 tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Apply hover effect on table rows */
        #example1 tr:hover {
            background-color: #e0e0e0;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            const currentDate = new Date();
            const currentMonthNumber = currentDate.getMonth() + 1; // Adding 1 to match regular month numbering
            fetchData(currentMonthNumber);

            // Function to fetch data from the database
            function fetchData(month) {
                const currentDate1 = new Date();
                const inputDate = new Date(currentDate1);

                const day = String(inputDate.getDate()).padStart(2, '0');
                const monthname = String(inputDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based
                const year = inputDate.getFullYear();

                const convertedDate = `${day}-${monthname}-${year}`;
                // Assuming you have a server-side script (e.g., PHP) to handle the database query
                $.ajax({
                    type: "POST",
                    url: "fetch_data_daily.php",
                    data: {
                        month: month,
                        tdate: convertedDate
                    },
                    success: function(response) {
                        // Process the retrieved data
                        console.log(response);
                        var data = JSON.parse(response);
                        createTable(data);
                    }
                });

            }

            // Function to create the HTML table
            function createTable(data) {
                // Clear any existing table
                $('#example1').empty();

                // Create table header
                var headerRow = "<tr><th style='width:5%;'}>#</th><th>Questions</th>";
                headerRow += "<th>" + data.daysInMonth + "</th>";
                headerRow += "</tr>";


                // Append the table header row
                $('#example1').append(headerRow);

                // Create table rows with data, ist coulmn qustions and second one '0' 
                for (var i = 0; i < data.questions.length; i++) {
                    var k = i + 1;
                    var rowData = "<tr><td >" + k + "</td><td>" + data.questions[i].question + "</td>";
                    rowData += "<td class='hidden-cell'>" + data.questions[i].qid + "</td>";
                    if (data.questions[i].qtype === 'Count') {

                        rowData += "<td class='numeric-editable' contenteditable='true'></td>";
                    } else {
                        rowData += "<td contenteditable='true'></td>";
                    }
                    rowData += "</tr>";

                    // Append each row to the table
                    $('#example1').append(rowData);
                }
                // Attach input event listener to numeric-editable cells
                $('.numeric-editable').on('input', function() {
                    this.textContent = this.textContent.replace(/[^0-9.]/g, ''); // Allow only numeric and dot characters
                });
            }


        });
    </script>
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
                            <h2 class="main-content-title tx-24 mg-b-5">Daily Work Entry</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Works</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Status Entry</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
                            <a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
                            <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
                            <a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
                            </a>
                           
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row sidemenu-height">
                        <div class="col-lg-12">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="widget-content widget-content-area">

                                        <div class="table-responsive">

                                            <table class="table" id="example1" ></table>

                                        </div>
                                        <div style="width:100%;text-align:right;padding: right 700px;">
                                            <!-- margin-right:300px;my-4-->
                                            <button class="btn ripple btn-primary confirm-cash success" type="button" id="save-button" style="width:200px">Save Details</button>
                                            <button class="btn ripple btn-secondary" name="cancel" id="cancel" style="width:200px">Cancel</button>
                                        </div>
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
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- Jquery js-->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>
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
    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
    <script src="notification.js"></script>
    <script src="save_data.js"></script>
    <script>
        $(document).ready(function() {
         

            $('#cancel').delegate('','click change',function(){
                window.location = "dailyworkstatus.php";
                return false;
            });




        });

    </script>
</body>

</html>