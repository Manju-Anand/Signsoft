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
// $orderid = $_GET["add"];
$mainorderid = "";
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

    <!--- bootstrap css -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!--- Style css -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!--- Plugins css -->
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
                            <h2 class="main-content-title tx-24 mg-b-5">Add Payment Form</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment Details</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Adding Form</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
                            <a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
                            <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
                            <a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
                            </a>
                            <!-- <div class="dropdown-menu tx-13">
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

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <div class="card-title">Add New Payment Details</div>
                                </div> -->
                                <form id="adddesig" method="post" action="">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <h4>Order Details Display</h4>
                                                    <div class="col-md-4">
                                                        <label class="form-label" for="ordersdisplay">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
                                                            <option value="" disabled selected>Select Order Entry</option>
                                                            <?php
                                                            $queryorder = "select * from order_customers where order_status='Active' order by id desc";
                                                            $select_postsorder = mysqli_query($connection, $queryorder);
                                                            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
                                                                $mainorderid = $roworder['id'];
                                                            ?>
                                                                <option value="<?php echo $roworder['id'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['custName'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4" style="margin: bottom 10px;">
                                                        <label class="form-label" for="branddisplay">Brand Name :</label>
                                                        <input type="text" class="form-control" id="branddisplay" name="branddisplay" placeholder="" readonly>
                                                    </div>
                                                    <div class="col-md-2" style="margin: bottom 10px;">
                                                        <label class="form-label" for="amountdisplay">Quoted Amount :</label>
                                                        <input type="text" class="form-control" id="amountdisplay" name="amountdisplay" placeholder="" readonly>
                                                    </div>
                                                    <div class="col-md-2" style="margin: bottom 10px;">
                                                        <label class="form-label" for="orderiddisplay">Order Id :</label>
                                                        <input type="text" class="form-control" id="orderiddisplay" name="orderiddisplay" placeholder="" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="hidden" id="paystatus" name="paystatus" value="Payment Add" readonly>
                                                    </div>
                                                    <!-- <br /> -->
                                                    <!-- <hr> -->
                                                    <hr>
                                                    <h4>Add Suppliers [ If Any ]</h4>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="orders">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="orders" id="orders" required>
                                                            <option value="" disabled selected>Select Order Entry</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="supplier">Supplier Name :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="supplier" id="supplier" required>
                                                            <option value="" disabled selected>Select Supplier</option>
                                                            <?php
                                                            $query = "select * from suppliers order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['supplier_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="donework">Work Done :</label>
                                                        <input type="text" class="form-control" id="donework" name="donework" placeholder="Work Done" required>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="supbillno">Supplier Bill No :</label>
                                                        <input type="text" class="form-control" id="supbillno" name="supbillno" placeholder="Supplier Bill No" required>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="payamt">Payment Amount :</label>
                                                        <input type="number" class="form-control" id="payamt" name="payamt" placeholder="Payment Amount" required>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="transmode">Transaction Mode :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="transmode" id="transmode" required>
                                                            <option value="" disabled selected>Select Transaction Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                            <option value="UPI">UPI</option>
                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="workper">Customer Bill No :</label>
                                                        <input type="text" class="form-control" id="custbillno" name="custbillno" placeholder="Customer Bill No" required>

                                                    </div>


                                                    <div class="col-md-3">
                                                        <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                        <button type="button" name="submit" class="btn btn-primary" onclick="addRow()" style="color:white;cursor:pointer;">Add Supplier Details</button>

                                                    </div>
                                                    <hr>

                                                    <div class="table-responsive">
                                                        <style>
                                                            .hidden-cell {
                                                                display: none;
                                                            }
                                                        </style>
                                                        <table class="table table-bordered mg-b-0" id="dataTable">
                                                            <thead>
                                                                <tr style="background-color: #add8e6;">
                                                                    <th>#</th>
                                                                    <th>Order</th>
                                                                    <th class="hidden-cell">order Id</th>
                                                                    <th>Supplier Name</th>
                                                                    <th class="hidden-cell">Sup Id</th>
                                                                    <th>Work Done</th>
                                                                    <th>Supplier Bill No</th>
                                                                    <th style="text-align: right;">Payment Amount</th>
                                                                    <th>Transaction Mode</th>
                                                                    <th>Customer Bill No</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajaxaddsupplierresults">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <h4>Add Payment Details for Customers</h4>




                                                    <div class="col-md-3">
                                                        <label class="form-label" for="paytype">Payment Type :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="paytype" id="paytype" required>
                                                            <option value="" disabled selected>Select Payment Type</option>
                                                            <option value="Advance Payment">Advance Payment</option>
                                                            <option value="Intrim Payment">Intrim Payment</option>
                                                            <option value="Final Payment">Final Payment</option>

                                                        </select>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label class="form-label" for="paymenttransmode">Transaction Mode :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="paymenttransmode" id="paymenttransmode" required>
                                                            <option value="" disabled selected>Select Transaction Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                            <option value="UPI">UPI</option>
                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="paymentamt">Payment Amount :</label>
                                                        <input type="number" class="form-control" id="paymentamt" name="paymentamt" placeholder="Payment Amount" required>

                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label" for="paycustbillno">Customer Bill No :</label>
                                                        <input type="text" class="form-control" id="paycustbillno" name="paycustbillno" placeholder="Customer Bill No" required>

                                                    </div>


                                                    <div class="col-md-2">
                                                        <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                        <button type="button" name="submit" class="btn btn-primary" onclick="addPayment()" style="color:white;cursor:pointer;">Add Payment Details</button>

                                                    </div>
                                                    <hr>

                                                    <div class="table-responsive">
                                                        <style>
                                                            .hidden-cell {
                                                                display: none;
                                                            }
                                                        </style>
                                                        <table class="table table-bordered mg-b-0" id="paydataTable">
                                                            <thead>
                                                                <tr style="background-color: #add8e6;">
                                                                    <th>#</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Transaction Mode</th>
                                                                    <th>Payment Amount</th>
                                                                    <th>Customer Bill No</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="ajaxaddpaymentresults">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="button" name="submit" onclick="saveDataToDatabase()" class="btn btn-primary" style="color:white;cursor:pointer;">Add Order</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>

                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>


                                </form>
                                <br>
                                <hr>



                            </div>
                        </div>

                    </div>
                    <!-- /ROW-1 CLOSED -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->
        <!-- ===========================modals ======================================= -->
        <!-- Basic modal -->
        <div class="modal fade" id="suppliermodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Supplier Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="modalrowid" name="modalrowid" required>

                            <div class="col-md-6">
                                <label class="form-label" for="orders">Orders :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalorders" id="modalorders" required>
                                    <option value="" disabled selected>Select Order Entry</option>

                                    <?php

                                    $query = "SELECT * FROM order_category WHERE order_id = ' $mainorderid'";
                                    $result = mysqli_query($connection, $query);

                                    // Build the options for the second select
                                    $options = '<option value="" disabled selected>Select Option</option>';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $querycat = "select * from category where id ='" . $row['category_id'] . "'";
                                        $select_postscat  = mysqli_query($connection, $querycat);
                                        while ($rowcat = mysqli_fetch_assoc($select_postscat)) {
                                            $options .= '<option value="' . $rowcat['id'] . '"  data-brandName="' .  $roworder['brandName'] . '" data-quotedAmt="' . $roworder['quotedAmt'] . '">' . $rowcat['category'] . '</option>';
                                        }
                                    }





                                    ?>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="supplier">Supplier Name :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalsupplier" id="modalsupplier" required>
                                    <option value="" disabled selected>Select Supplier</option>
                                    <?php
                                    $query = "select * from suppliers order by id desc";
                                    $select_posts = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_posts)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['supplier_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="donework">Work Done :</label>
                                <input type="text" class="form-control" id="modaldonework" name="modaldonework" placeholder="Work Done" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="supbillno">Supplier Bill No :</label>
                                <input type="text" class="form-control" id="modalsupbillno" name="modalsupbillno" placeholder="Supplier Bill No" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="payamt">Payment Amount :</label>
                                <input type="number" class="form-control" id="modalpayamt" name="modalpayamt" placeholder="Payment Amount" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="transmode">Transaction Mode :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modaltransmode" id="modaltransmode" required>
                                    <option value="" disabled selected>Select Transaction Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Card">Card</option>
                                    <option value="UPI">UPI</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="workper">Customer Bill No :</label>
                                <input type="text" class="form-control" id="modalcustbillno" name="modalcustbillno" placeholder="Customer Bill No" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="saveChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
        <!-- Basic modal -->
        <div class="modal fade" id="paymentmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Payment Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="modalpayrowid" name="modalpayrowid" required>

                            <div class="col-md-6">
                                <label class="form-label" for="paytype">Payment Type :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalpaytype" id="modalpaytype" required>
                                    <option value="" disabled selected>Select Payment Type</option>
                                    <option value="Advance Payment">Advance Payment</option>
                                    <option value="Intrim Payment">Intrim Payment</option>
                                    <option value="Final Payment">Final Payment</option>

                                </select>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label" for="paymenttransmode">Transaction Mode :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalpaymenttransmode" id="modalpaymenttransmode" required>
                                    <option value="" disabled selected>Select Transaction Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Card">Card</option>
                                    <option value="UPI">UPI</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="paymentamt">Payment Amount :</label>
                                <input type="number" class="form-control" id="modalpaymentamt" name="modalpaymentamt" placeholder="Payment Amount" required>

                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Customer Bill No :</label>
                                <input type="text" class="form-control" id="modalpaycustbillno" name="modalpaycustbillno" placeholder="Customer Bill No" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savepayChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
        <!-- ===========================modals ======================================= -->
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

    <!-- INTERNAL SELECT2 JS -->
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/js/select2.js"></script>

    <!-- Chart.Bundle js-->
    <script src="../assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="../assets/plugins/wysiwyag/jquery.richtext.js "></script>
    <script src="../assets/plugins/wysiwyag/wysiwyag.js "></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="../assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="../assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="../assets/plugins/fancyuploder/fancy-uploader.js"></script>
    <!-- Sweet-Alert js-->
    <script src="../assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>
    <script src="../assets/js/sweet-alert.js"></script>

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

    <!-- password-addon init -->
    <!-- <script src="../assets/js/password-addon.js"></script> -->
    <script src="add-payment.js"></script>




</body>

</html>