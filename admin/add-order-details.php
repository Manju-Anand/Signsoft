<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
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
                            <h2 class="main-content-title tx-24 mg-b-5" style="color:brown;text-transform:uppercase; text-decoration: underline;">Add & Edit Order Details</h2>
                            <!-- <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment Details</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Closing Order Form</li>
                            </ol> -->
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
                    <div class="row">
					<div class="col-md-12">
						<div class="card custom-card mt-3" id="right">
							<div class="card-header rounded-bottom-0">
								
                                <div class="row">
                                                    <div class="col-md-3">
                                                        <h5 class="mt-2">You can Add & Edit order details here.</h5>
                                                        <input type="hidden" id="paystatus" name="paystatus" value="Payment Add" readonly>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <button type="submit" name="submit" onclick="saveDataToDatabase()" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Submit Details</button>
                                                        <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                                        <!-- float-end -->

                                                    </div>
                                                </div>
							</div>
							<div class="card-body">
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs panel-secondary">
                                            <li><a href="#tab17" class="active" data-bs-toggle="tab"><span><i class="fe fe-book-open mx-1"></i></span>Order Details</a>
                                            </li>
                                            <li><a href="#tab22" data-bs-toggle="tab"><span><i class="fe fe-phone-call mx-1"></i></span>Follow-Up History</a>
                                            </li>
											<li><a href="#tab20" data-bs-toggle="tab"><span><i class="fe fe-server mx-1"></i></span>Quotation Splitup</a>
                                            </li>
                                            <li><a href="#tab21" data-bs-toggle="tab"><span><i class="fe fe-user mx-1"></i></span>Staff Allocation</a>
                                            </li>
                                            <li><a href="#tab18" data-bs-toggle="tab"><span><i class="fe fe-calendar mx-1"></i></span>Supplier Details</a>
                                            </li>
                                            <li><a href="#tab19" data-bs-toggle="tab"><span><i class="fe fe-dollar-sign mx-1"></i></span>Payment Details</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                <form method="post">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab17">
                                            
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="ordersdisplay">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
                                                            <option value="" disabled selected>Select Order Entry</option>
                                                            <?php
                                                            $adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
                                                            if ($adminname  == 'Signefo') {
                                                                $queryorder = "select * from order_customers where order_status='Active' and ordertype='External' and client_quality='Good' order by id desc";
                                                            } else if ($adminname  == 'SignefoMedia') {
                                                                $queryorder = "select * from order_customers where order_status='Active' and ordertype='External' and client_quality='Average' order by id desc";
                                                            } else {
                                                                $queryorder = "select * from order_customers where order_status='Active' and ordertype='External' order by id desc";
                                                            }



                                                            // $queryorder = "select * from order_customers where order_status='Active' and ordertype='External' order by id desc";
                                                            $select_postsorder = mysqli_query($connection, $queryorder);
                                                            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
                                                                $mainorderid = $roworder['id'];
                                                            ?>
                                                                <option value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>"
                                                                 data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>" data-orderexp="<?php echo $roworder['order_expense'] ?>"><?php echo $roworder['custName'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">

                                                 
                                                    <div class="col-md-12" style="margin: bottom 10px;" id="orderdetails"></div>

                                                </div>

                                                
                                           
                                        </div>
                                        <div class="tab-pane" id="tab20">
                                            <div class="row mb-4">
                                                <div class="col" style="text-align: right;">
                                                <a data-bs-target='#modalquotesplitup' data-bs-toggle='modal' data-effect='effect-slide-in-right'
                                                href='javascript:void(0);' id='quotesplitupbtn' data-quoteid='' style='font-size:15px;color:white;'>
                                                <button class='btn btn-indigo' >Quotation Splitup</button></a>

                                                <a data-bs-target='#modaleditquotesplitup' data-bs-toggle='modal' data-effect='effect-slide-in-right'
                                                href='javascript:void(0);' id='editquotesplitupbtn' data-quoteid='' style='font-size:15px;color:white;'>
                                                <button class='btn btn-success' >Edit Quotation Splitup</button></a>
                                                </div><br>
                                            

                                                <div class="table-responsive">

                                                    <table class="table table-bordered mg-b-0" id="quotesplitupTable">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Item Name</th>
                                                                <th>Price</th>
                                                                <th>Order Expense</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxquotesplitupresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab21">
                                            <div class="row mb-4">
                                          
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="dept">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="dept" id="dept" required>
                                                            <option value="" disabled selected>Select Order Entry</option>
                                                         
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="staff">Staff Name :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="staff" id="staff" required>
                                                            <option value="" disabled selected>Select Employee</option>
                                                            <?php
                                                            $query = "select * from employee  where status='Active'order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['empname'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="assignwork">Work Assigned :</label>
                                                        <input type="text" class="form-control" id="assignwork" name="assignwork" placeholder="Work Assigned" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="deadline">Deadline :</label>
                                                        <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Deadline" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="workper">Percentage of work :</label>
                                                        <input type="number" class="form-control" id="workper" name="workper" max="100" placeholder="Percentage of work" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                        <button type="button" name="submit" class="btn btn-primary" onclick="addstaffRow()" style="color:white;cursor:pointer;">Allocate Staff</button>

                                                    </div>
                                                    <hr>

                                                <div class="table-responsive">

                                                    <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Category Assigned</th>
                                                                <th class="hidden-cell">order Id</th>
                                                                <th>Employee Name</th>
                                                                <th class="hidden-cell">Emp Id</th>
                                                                <th>Work Description</th>
                                                                <th>Dead Line</th>
                                                                <th>Percentage of Work</th>
                                                                <th>Assigned Date</th>
                                                                <th>Action</th>
                                                                <th class="hidden-cell">status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxstaffallocateresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab18">
                                            <div class="row mb-4">

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
                                                    <div class="col-md-2">
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
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="workper">Customer Bill No :</label>
                                                        <input type="text" class="form-control" id="custbillno" name="custbillno" placeholder="Customer Bill No" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                    <label class="form-label" for="deadline">Date of Pay :</label>
                                                        <input type="date" class="form-control" id="suppaydate" name="suppaydate" placeholder="Deadline" required>

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
                                                                <th>Date of Pay</th>
																<th>Action</th>
                                                                <th class="hidden-cell">status</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxsupplierresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab19">
                                            <div class="row mb-4">
											        <div class="col-md-2">
                                                        <label class="form-label" for="paytype">Payment Type :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="paytype" id="paytype" required>
                                                            <option value="" disabled selected>Select Payment Type</option>
                                                            <option value="Advance Payment">Advance Payment</option>
                                                            <option value="Intrim Payment">Intrim Payment</option>
                                                            <option value="Final Payment">Final Payment</option>

                                                        </select>
                                                    </div>


                                                    <div class="col-md-2">
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
                                                        <label class="form-label" for="invoiceamt">Invoice Amount :</label>
                                                        <input type="number" class="form-control" id="invoiceamt" name="invoiceamt" placeholder="Payment Amount" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="paymentamt">Received Amount :</label>
                                                        <input type="number" class="form-control" id="paymentamt" name="paymentamt" placeholder="Payment Amount" required>

                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label" for="paycustbillno">Customer Invoice No :</label>
                                                        <input type="text" class="form-control" id="paycustbillno" name="paycustbillno" placeholder="Customer Bill No" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                    <label class="form-label" for="deadline">Date of Pay :</label>
                                                        <input type="date" class="form-control" id="cuspaydate" name="cuspaydate" placeholder="customer paydate" required>

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
                                                                <th>Invoice Amount</th>
                                                                <th>Payment Amount</th>
                                                                <th>Customer Bill No</th>
                                                                <th>Date of Pay</th>
																<th>Action</th>
                                                                <th class="hidden-cell">status</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxpaymentresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab22">
                                            <div class="row mb-4">
											        <div class="col-md-3">
                                                        <label class="form-label" for="paytype">Date :</label>
                                                        <input type="date" class="form-control" id="followupdate" name="followupdate" placeholder="Followup Date" required>

                                                    </div>


                                                    <div class="col-md-3">
                                                        <label class="form-label" for="paymenttransmode">Mode Of Contact :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="followupmode" id="followupmode" required>
                                                            <option value="" disabled selected>Select Mode Of Contact</option>
                                                            <option value="Phone Call">Phone Call</option>
                                                            <option value="Client Visit">Client Visit</option>
                                                            <option value="Whatsapp">Whatsapp</option>
                                                            <option value="Emailr">Email</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label" for="paymentamt">Remarks :</label>
                                                        <input type="text" class="form-control" id="followupremarks" name="followupremarks" placeholder="Remarks" required>

                                                    </div>

                                                    

                                                    <div class="col-md-3">
                                                        <label class="form-label" for="dept" style="color:transparent" >Transparent Label :</label>
                                                        <button type="button" name="submit" class="btn btn-primary" onclick="addfollowup()" style="color:white;cursor:pointer;">Add Followup Details</button>

                                                    </div>
                                                    <hr>
                                                <div class="table-responsive">
                                                    
                                                    <table class="table table-bordered mg-b-0" id="followupdataTable">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Followup Date</th>
                                                                <th>Mode of Contact</th>
                                                                <th>Remarks</th>
                                                                <th>Action</th>
                                                                <th class="hidden-cell">status</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxfollowupresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                      
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
						</div>
					</div>
				</div>





                    
                    <!-- ROW-1 OPEN -->

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
                        <h6 class="modal-title">Edit Supplier Details - staff</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalrowid" name="modalrowid" required>

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
                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Date of Pay :</label>
                                <input type="date" class="form-control" id="modalsuppayDate" name="modalsuppayDate" placeholder="Customer Pay Date" required>

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
                        <h6 class="modal-title">Edit Payment Details -</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalpayrowid" name="modalpayrowid" required>

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
                                <label class="form-label" for="paymentamt">Invoice Amount :</label>
                                <input type="number" class="form-control" id="modalinvoiceamt" name="modalinvoiceamt" placeholder="Invoice Amount" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="paymentamt">Payment Amount :</label>
                                <input type="number" class="form-control" id="modalpaymentamt" name="modalpaymentamt" placeholder="Payment Amount" required>

                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Customer Bill No :</label>
                                <input type="text" class="form-control" id="modalpaycustbillno" name="modalpaycustbillno" placeholder="Customer Bill No" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Date of Pay :</label>
                                <input type="date" class="form-control" id="modalcuspayDate" name="modalcuspayDate" placeholder="Customer Pay Date" required>

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
          <!-- Basic modal -->
          <div class="modal fade" id="staffmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Staff Allocation Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalstaffrowid" name="modalstaffrowid" required>

                            <div class="col-md-6">
                                <label class="form-label" for="modalstafforders">Orders :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalstafforders" id="modalstafforders" required>
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
                                <label class="form-label" for="modalstaff">Staff Name :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalstaff" id="modalstaff" required>
                                                            <option value="" disabled selected>Select Employee</option>
                                                            <?php
                                                            $query = "select * from employee order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['empname'] ?></option>
                                                            <?php } ?>
                                                        </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalassignwork">Work Assigned :</label>
                                <input type="text" class="form-control" id="modalassignwork" name="modalassignwork" placeholder="" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modaldeadline">Dead Line :</label>
                                <input type="date" class="form-control" id="modaldeadline" name="modaldeadline" placeholder="" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalpercentage">Percentage of work :</label>
                                <input type="number" class="form-control" id="modalpercentage" name="modalpercentage" placeholder="" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalassigndate">Assigned Date :</label>
                                <input type="date" class="form-control" id="modalassigndate" name="modalassigndate" placeholder="" required>

                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savestaffChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->

        <div class="modal fade" id="modalquotesplitup">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Detailed Estimate</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Order ID :</label>
                                <input class="form-control" type="text" id="quoteid" value="" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="dept">Customer Name :</label>
                                <input class="form-control" type="text" id="custname" value="" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="dept">Brand Name :</label>
                                <input class="form-control" type="text" id="brandname" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Quoted Amount</label>
                                <input class="form-control" type="text" id="quotedamt" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Order Expense</label>
                                <input class="form-control" type="text" id="orderexpense" value="" readonly>
                            </div>



                        </div><br>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mg-b-0" id="orderTable">
                                        <thead>
                                            <tr style="background-color: lightblue;">
                                                <th>#</th>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Order Expense</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                                <td>$450,870</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="saveQuotesplitupBtn" type="button">Save changes</button>
                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                  <!-- ************* edit modal ****************** -->
        <div class="modal fade" id="modaleditquotesplitup">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Detailed Estimate</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                        <!-- <input class="form-control" type="text" id="editsplitid" value="" readonly> -->
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Order ID :</label>
                                <input class="form-control" type="text" id="editquoteid" value="" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="dept">Customer Name :</label>
                                <input class="form-control" type="text" id="editcustname" value="" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="dept">Brand Name :</label>
                                <input class="form-control" type="text" id="editbrandname" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Quoted Amount</label>
                                <input class="form-control" type="text" id="editquoteamt" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Order Expense</label>
                                <input class="form-control" type="text" id="editorderexpense" value="" readonly>
                            </div>


                        </div><br>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mg-b-0" id="editorderTable">
                                        <thead>
                                            <tr style="background-color: lightblue;">
                                                <th>#</th>
                                                <th>Splitup ID</th>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Order Expense</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                                <td>$450,870</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-primary" id="updateChangesBtn" type="button">Update changes</button>
                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ===========================modals ======================================= -->
              <!-- Basic modal -->
        <div class="modal fade" id="followupmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit FollowUp Details </h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalfollowuprowid" name="modalfollowuprowid" required>

                            <div class="col-md-12">
                                    <label class="form-label" for="modalfollowupdate">Date :</label>
                                    <input type="date" class="form-control" id="modalfollowupdate" name="modalfollowupdate" placeholder="Followup Date" required>

                               
                            </div>


                            <div class="col-md-12">
                                    <label class="form-label" for="modalfollowupmode">Mode Of Contact :</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="modalfollowupmode" id="modalfollowupmode" required>
                                        <option value="" disabled selected>Select Mode Of Contact</option>
                                        <option value="Phone Call">Phone Call</option>
                                        <option value="Client Visit">Client Visit</option>
                                        <option value="Whatsapp">Whatsapp</option>
                                        <option value="Emailr">Email</option>
                                    </select>
                            </div>
                            <div class="col-md-12">
                                    <label class="form-label" for="modalfollowupremarks">Remarks :</label>
                                    <input type="text" class="form-control" id="modalfollowupremarks" name="modalfollowupremarks" placeholder="Remarks" required>


                            </div>

                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savefollowupChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
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
    <script src="add-payments.js"></script>

	<!--- TABS JS -->
	<script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
	<script src="../assets/plugins/tabs/tab-content.js"></script>
<script>
     $(document).ready(function(e) {
                   

                    $('#mulselect').delegate('', 'click change', function() {
                        var ordersValueid = $('#mulselect').val();
                        console.log(ordersValueid);
                    });
                });
</script>

</body>

</html>