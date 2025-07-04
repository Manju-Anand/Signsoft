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
                            <h2 class="main-content-title tx-24 mg-b-5" style="color:brown;text-transform:uppercase; text-decoration: underline;">Add & Edit Internal Order Details</h2>
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
                                          
                                            <li><a href="#tab18" data-bs-toggle="tab"><span><i class="fe fe-user mx-1"></i></span>Staff Allocation</a>
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
                                                            $queryorder = "select * from order_customers where order_status='Active' and ordertype='Internal' order by id desc";
                                                            $select_postsorder = mysqli_query($connection, $queryorder);
                                                            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
                                                                $mainorderid = $roworder['id'];
                                                            ?>
                                                                <option value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['custName'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">

                                                 
                                                    <div class="col-md-12" style="margin: bottom 10px;" id="orderdetails"></div>

                                                </div>

                                                
                                           
                                        </div>
                                      
                                        <div class="tab-pane" id="tab18">
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
                                                            $query = "select * from employee where status='Active' order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['empname'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="assignwork">Work Assigned[ Module Name ] :</label>
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
                                        
                                        <div class="tab-pane" id="tab19345">
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
                                                        <label class="form-label" for="paymentamt">Payment Amount :</label>
                                                        <input type="number" class="form-control" id="paymentamt" name="paymentamt" placeholder="Payment Amount" required>

                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="form-label" for="paycustbillno">Customer Bill No :</label>
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
                                                    <table class="table table-bordered mg-b-0" id="paydataTable345678">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Payment Type</th>
                                                                <th>Transaction Mode</th>
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

        

                  <!-- ************* edit modal ****************** -->
       
        <!-- ===========================modals ======================================= -->
              <!-- Basic modal -->
       
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
    <script src="add-internals.js"></script>

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