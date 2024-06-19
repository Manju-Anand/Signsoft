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

$currentMonth = date('m'); // Get the current month (as '01' for January, '02' for February, etc.)


function showorderlist($currentMonth)
{
    global $connection;
    // $lastMonth = date('m', strtotime('-1 month')); // Get the previous month

    $tot_invoice_amt = 0;
    $tot_gst_amt = 0;
    $gstamt =0;
    $i = 0;
     echo "<tbody>";

    $sqlgst = "SELECT * FROM gstamt where SUBSTRING(paiddate, 6, 2) = '$currentMonth'";
    $resultgst = $connection->query($sqlgst);
    if ($resultgst->num_rows > 0) {
        while ($rowgst = $resultgst->fetch_assoc()) {
            // ================================
            $orderid = $rowgst['orderid'];
            $gstamt = $rowgst['gst_amt'];

            $invoice_amt = $rowgst['invoice_amt'];


            $invoice_no = $rowgst['invoice_no'];


            // Perform addition
            $tot_invoice_amt = $tot_invoice_amt + $invoice_amt;
            $tot_gst_amt = $tot_gst_amt + $gstamt;
            $paid_date = $rowgst['paiddate'];
        

            // =========================
            $query = "select * from order_customers where id='" . $rowgst['orderid'] . "'";
            $select_posts = $connection->query($query);
            if ($select_posts->num_rows > 0) {
                while ($rowbrand = $select_posts->fetch_assoc()) {
                    $brandname =   $rowbrand['brandName'];
                }
            }

         


            $i = $i + 1;
            echo "<tr>";
            echo "<td>$i</td>";

            echo "<td>$orderid</td>";
            echo "<td>$brandname</td>";
            echo "<td>$invoice_no</td>";
            echo "<td style='text-align:right;padding-right:20px;'>$invoice_amt</td>";
            echo "<td style='text-align:right;padding-right:20px;'>$gstamt</td>";
            echo "<td>$paid_date</td>";

            echo "</tr>";
        }
    }
    echo "</tbody><tfoot>";

    echo "<tr>";
    echo "<td colspan='4' style='font-weight:bold;'>Total </td>";
    echo "<td style='text-align:right;padding-right:20px;font-weight:bold;' id='total-invoice-amt'> &#8377;&nbsp;$tot_invoice_amt</td>";
    echo "<td style='text-align:right;padding-right:20px;font-weight:bold;' id='total-gst-amt'> &#8377;&nbsp;$tot_gst_amt</td>";
    echo "<td></td>";

    echo "</tfoot>";
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
                            <h2 class="main-content-title tx-24 mg-b-5">GST Details</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">GST Amount Paid Details</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a> -->
                            <!-- <a class="btn ripple btn-success  view-details-btn" data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='View DM Content &  Details' onclick="fetchGstAmount()"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Save GST Details</a> -->
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
                                        <!-- <a class="btn btn-sm btn-success  view-details-btn" data-bs-target='#editmodal' data-bs-toggle='modal' data-recordid={$id} title='View DM Content &  Details' ><i class="fe fe-external-link"></i> &nbsp;&nbsp; Save GST Details</a> -->

                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4 class="card-title mb-1">GST Amount </h4>
                                            </div>
                                            <div class="col-md-4">

                                                <label for="designation" class="form-label">Select Month</label>
                                                <select id="month-select" name="month-select" class="form-select mb-3" required onchange="filterOrders()">
                                                    <option value="" disabled selected>Select Month</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                    < </select>


                                            </div>
                                            <div class="col-md-4">
                                                <label for="designation" class="form-label">Select Year</label>
                                                <select id="year-select" name="year-select" class="form-select mb-3" required onchange="filterOrders()">

                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th>Order Id</th>
                                                    <th>Brand Name</th>
                                                    <th>Invoice No</th>
                                                    <th>Invoice Amount</th>
                                                    <th>GST Amount</th>
                                                    <th>Paid Date</th>

                                                </tr>
                                            </thead>
                                            <?php
                                            $currentMonth = date('m');
                                            showorderlist($currentMonth);
                                            ?>


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
        <!-- <div class="modal fade" id="editmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Content</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" class="form-control" id="modaleditid" name="modaleditid" required>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="editpostercontent">Poster Content :</label>
                                <textarea class="form-control" name="editpostercontent" id="editpostercontent" rows="5" > </textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="editposteridea">Poster Idea :</label>
                                <textarea class="form-control" name="editposteridea" id="editposteridea" rows="5" > </textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="updatecontent" data-bs-dismiss="modal" type="button">Update Content</button>
                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div> -->

        <!-- <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">GST Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>Order Id</th>
                                                <th>Brand Name</th>
                                                <th>Invoice No</th>
                                                <th>Invoice Amount</th>
                                                <th>GST Amount</th>
                                                <th>Taxable Value</th>

                                            </tr>
                                        </thead>
                                        <?php
                                        $currentMonth = date('m');
                                        showorderlist($currentMonth);
                                        ?>


                                    </table>
                                    <hr>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="gst-amount-input" class="form-label">Total GST Amount</label>
                                <input type="text" class="form-control" id="gst-amount-input" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="gst-amount-input" class="form-label">Paid Date</label>
                                <input type="date" class="form-control" id="gst-paid-date">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveGstAmount()">Save changes</button>
                    </div>
                </div>
            </div>

        </div> -->
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
        // JavaScript to select the current month
        document.addEventListener('DOMContentLoaded', function() {
            var currentMonth = new Date().getMonth() + 1; // getMonth() returns month index (0-11), so add 1
            var monthSelect = document.getElementById('month-select');
            monthSelect.value = currentMonth; // Set the value to the current month
        });
        // JavaScript to select the current year
        window.onload = function() {
            const currentYear = new Date().getFullYear().toString();
            const select = document.getElementById("year-select");
            for (let i = 0; i < select.options.length; i++) {
                if (select.options[i].value === currentYear) {
                    select.options[i].selected = true;
                    break;
                }
            }
        };
    </script>

    <script>
        // Get the current month
        // var currentMonth = new Date().getMonth() + 1; // JavaScript months are zero-based, so add 1

  
        function filterOrders() {
            var monthselect = document.getElementById('month-select').value;
            var yearselect = document.getElementById('year-select').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_gst_data_collected.php?monthselect=' + monthselect + '&yearselect=' + yearselect, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.querySelector('#example3 tbody').innerHTML = response.tableData;
                    document.querySelector('#example3 tfoot #total-invoice-amt').innerText = response.totalInvoiceAmt;
                    document.querySelector('#example3 tfoot #total-gst-amt').innerText = response.totalGstAmt;
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>