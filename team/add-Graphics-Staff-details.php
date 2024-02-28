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
    <style>
        .hidden-cell {
            display: none;
        }
    </style>

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
                            <h2 class="main-content-title tx-24 mg-b-5" ;">Assign Graphics Designers</h2>
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
                                        <div class="col-md-5">
                                            <h5 class="mt-2">You can Add & Edit Graphics Designers here.</h5>
                                            <input type="hidden" id="paystatus" name="paystatus" value="Payment Add" readonly>
                                            <input type="hidden" id="datastatus" name="datastatus" value="" readonly>
                                        </div>
                                        <div class="col-md-7">
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
                                                <ul class="nav panel-tabs panel-info">
                                                    <li><a href="#tab17" class="active" data-bs-toggle="tab"><span><i class="fe fe-book-open mx-1"></i></span>Work Details</a>
                                                    </li>




                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <form method="post">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab17">

                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="ordersdisplay">Clients :</label>
                                                                <select class="form-select mb-3" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
                                                                    <option value="" disabled selected>Select Clients</option>
                                                                    <?php
                                                                    $queryorder = "select * from order_customers where order_status='Active' order by id desc";
                                                                    $select_postsorder = mysqli_query($connection, $queryorder);
                                                                    while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

                                                                        $mainorderid = $roworder['id'];


                                                                        $querydigital = "select * from category where category='Social Media'";
                                                                        $select_postsdigital = mysqli_query($connection, $querydigital);
                                                                        while ($rowdigital = mysqli_fetch_assoc($select_postsdigital)) {
                                                                            $catId = $rowdigital['id'];
                                                                        }
                                                                        $dmorder = "false";

                                                                        $queryordercat = "select * from order_category where order_id='" . $roworder['id'] . "' and category_id='" . $catId . "'";
                                                                        $select_postsordercat = mysqli_query($connection, $queryordercat);
                                                                        while ($rowordercat = mysqli_fetch_assoc($select_postsordercat)) {
                                                                            $categoryId = $rowordercat['category_id'];
                                                                            $dmorder = "true";
                                                                        }

                                                                        if ($dmorder == "true") {
                                                                    ?>

                                                                            <option value="<?php echo $roworder['id'] ?>" data-custName="<?php echo $roworder['custName'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['brandName'] ?></option>
                                                                    <?php }
                                                                    }    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-8" style="margin: bottom 10px; border: 1px double  rgb(210, 180, 140);padding:15px;
                                                    border-top-style: dotted;  border-right-style: solid;  border-bottom-style: dotted;
                                                      border-left-style: solid; border-left: 6px solid red;" id="orderdetails"></div>
                                                        </div>
                                                        <div class="row mb-4">




                                                        </div>

                                                        <div class="row mb-4">

                                                            

                                                            <div class="col-md-2">
                                                                <label class="form-label" for="postings">Postings :</label>
                                                                <select class="form-select mb-3" name="postings" id="postings" required>
                                                                    <option value="" disabled selected>Select Postings</option>
                                                                    <option value="Poster">Poster</option>
                                                                    <option value="Video">Video</option>
                                                                    <option value="GIF">GIF</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-md-8">
                                                                <label class="form-label" for="dmpayment">Content :</label>
                                                               <textarea class="form-control" name="content" id="content" rows="4" style="margin-bottom: 10px;"></textarea>

                                                            </div>
                                                            
                                                          
                                                           
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                                <button type="button" name="submit" class="btn btn-primary" onclick="addstaffRow()" style="color:white;cursor:pointer;">Assign</button>

                                                            </div><br>
                                                            <hr>

                                                            <div class="table-responsive">

                                                                <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                                    <thead>
                                                                        <tr style="background-color: #add8e6;">
                                                                            <th>#</th>
                                                                            <th>Assign Date</th>
                                                                            <th>Posting</th>
                                                                            <th>Content</th>
                                                                
                                                                            
                                                                            <th>Action</th>
                                                                            <!-- class="hidden-cell" -->
                                                                            <th class="hidden-cell">status</th>
                                                                            <th class="hidden-cell">editid</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajaxstaffallocateresults">

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
        <div class="modal fade" id="staffmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Graphics Work Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" id="modalstaffrowid" name="modalstaffrowid" required>
                            <input type="text" class="form-control" id="modaleditid" name="modaleditid" required>
                            <div class="col-md-6">
                                <label class="form-label" for="modalpost">Postings :</label>
                               
                                <select class="form-select"  name="modalpost" id="modalpost" required>
                                    <option value="Poster">Poster</option>
                                    <option value="Video">Video</option>
                                    <option value="GIF">GIF</option>
                                </select>


                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalassigndate">Assigned Date :</label>
                                <input type="date" class="form-control" id="modalassigndate" name="modalassigndate" placeholder="Assigndate">

                            </div>
                                    

                            
                            <div class="col-md-12">
                                <label class="form-label" for="modalcontent">Content :</label>
                                <textarea class="form-control" name="modalcontent" id="modalcontent" rows="4" style="margin-bottom: 10px;"></textarea>

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
    <script src="add-graphics-details.js"></script>
    <script src="notification.js"></script>
    <!--- TABS JS -->
    <script src="../assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
    <script src="../assets/plugins/tabs/tab-content.js"></script>

    <script>
        $(document).ready(function(e) {
            $('#modalpostings').select2();
   $('#modalpostings123').select2();
       
            // $('#mulselect').delegate('', 'click change', function() {
            //     var ordersValueid = $('#mulselect').val();
            //     console.log(ordersValueid);
            // });
        });
    </script>

</body>

</html>