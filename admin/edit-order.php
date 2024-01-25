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
function isCategorySelected($orderId, $categoryId)
{
    global $connection;
    $query = "SELECT * FROM order_category WHERE order_id = $orderId AND category_id = $categoryId";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
    // Implement the logic to check if $categoryId is present in order_category table for $orderId
    // Return true if selected, false otherwise
}
// Function to check if a subcategory is selected for the given order
function isSubcategorySelected($orderId, $subcategoryId)
{
    global $connection;

    $query = "SELECT * FROM order_subcategory WHERE order_id = $orderId AND subcategory_id = $subcategoryId";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {

        return true;
    } else {

        return false;
    }
    // Implement the logic to check if $subcategoryId is present in order_subcategory table for $orderId
    // Return true if selected, false otherwise
}

$orderid = $_GET["edit"];

$sqlorders = "SELECT * FROM order_customers where id='" . $orderid  . "'";
$resultorders = $connection->query($sqlorders);

if ($resultorders->num_rows > 0) {
    while ($roworders = $resultorders->fetch_assoc()) {
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
            <!-- Choices JS -->
            <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
            <!-- Choices Css -->
            <link rel="stylesheet" href="../assets/libs/choices.js/public/assets/styles/choices.min.css">
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
                                    <h2 class="main-content-title tx-24 mg-b-5">Edit Order</h2>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Order Entry</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                                    </ol>
                                </div>
                                <div class="btn-list">
                                    <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
                                    <a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
                                    <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
                                    <a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu tx-13">
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Page Header -->

                            <!-- ROW-1 OPEN -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-title">Edit Order Details</div>
                                        </div>
                                        
                                        <form id="adddesig" method="post" action="" enctype="multipart/form-data">
                                        <input type="text" id="orgorderid" name="orgorderid" value="<?php echo $_GET["edit"]; ?>">
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="card-body">
                                                        <h6>Basic Informations</h6>
                                                        <hr>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="empname">Customer Name :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="cusname" name="cusname" value="<?php echo $roworders['custName'] ?>" placeholder="Customer Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="empname">Brand Name :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="brandname" name="brandname" value="<?php echo $roworders['brandName'] ?>" placeholder="Brand Name" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="addr">Address :</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="addr" id="addr" palceholder="Here Address" rows="4"><?php echo $roworders['addr'] ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="poneno">Phone No :</label>
                                                            <div class="col-md-9">
                                                                <input type="number" pattern="[6-9]\d{9}" class="form-control" value="<?php echo $roworders['custPhone'] ?>" name="phoneno" id="phoneno" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="emailid">Email ID :</label>
                                                            <div class="col-md-9">
                                                                <input type="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" value="<?php echo $roworders['custEmail'] ?>" name="emailid" id="emailid" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="contacteddate">Contacted Date :</label>
                                                            <div class="col-md-9">
                                                                <input type="date" name="contacteddate" id="contacteddate" value="<?php echo $roworders['contactDate'] ?>" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="contactedtime">Contacted Time :</label>
                                                            <div class="col-md-9">
                                                                <input type="time" name="contactedtime" id="contactedtime" value="<?php echo $roworders['contactTime'] ?>" class="form-control" placeholder="">
                                                            </div>
                                                        </div>
                                                    
  
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card-body">
                                                        <h5>Order Informations</h5>
                                                        <hr>
                                                        <!-- =================================== -->
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="contacteddate">Categories :</label>
                                                            <div class="col-md-9">
                                                                
                                                                <select class="form-control select2" multiple="multiple" id="mulselect[]" name="mulselect[]">
                                                                    <?php
                                                                    $presentchk = "false";
                                                                    $sql = "SELECT * FROM category";
                                                                    $result = $connection->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $presentchk = "false";
                                                                            $sqlcatcheck = "SELECT * FROM order_category where order_id='" . $orderid . "' and category_id ='" . $row['id'] . "'";
                                                                            $resultcatcheck = $connection->query($sqlcatcheck);
                                                                            if ($resultcatcheck->num_rows > 0) {
                                                                                while ($rowcatcheck = $resultcatcheck->fetch_assoc()) {
                                                                                    $presentchk = "true";
                                                                                }
                                                                            }

                                                                    ?>
                                                                            <option <?php if ($presentchk == "true") { ?>selected <?php } ?> value="<?php echo $row['id'];  ?>">
                                                                                <?php echo $row['category'];  ?>
                                                                            </option>
                                                                    <?php }
                                                                    } ?>

                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="contacteddate">Sub-Categories :</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control select2" multiple="multiple" id="mulselectsub[]" name="mulselectsub[]">
                                                                    <?php
                                                                    $presentchk = "false";
                                                                    $sql = "SELECT * FROM subcategory";
                                                                    $result = $connection->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            $presentchk = "false";
                                                                            $sqlcatcheck = "SELECT * FROM order_subcategory where order_id='" . $orderid . "' and subcategory_id ='" . $row['id'] . "'";
                                                                            $resultcatcheck = $connection->query($sqlcatcheck);
                                                                            if ($resultcatcheck->num_rows > 0) {
                                                                                while ($rowcatcheck = $resultcatcheck->fetch_assoc()) {
                                                                                    $presentchk = "true";
                                                                                }
                                                                            }

                                                                    ?>
                                                                            <option <?php if ($presentchk == "true") { ?>selected <?php } ?> value="<?php echo $row['id'];  ?>">
                                                                                <?php echo $row['subcategory'];  ?>
                                                                            </option>
                                                                    <?php }
                                                                    } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                        <!-- ============================================================= -->

                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="qutamt">Quoted Amount :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="qutamt" name="qutamt" value="<?php echo $roworders['quotedAmt'] ?>" placeholder="Quoted Amount" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="leadsource">Lead Source :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="leadsource" value="<?php echo $roworders['leadSource'] ?>" name="leadsource" placeholder="Lead Source" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="status">Order Status :</label>
                                                            <div class="col-md-9">
                                                                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                                                    <option value="<?php echo $roworders['order_status'] ?>"><?php echo $roworders['order_status'] ?></option>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Processing">Processing</option>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Stopped">Stopped</option>
                                                                    <option value="On-Hold">On Hold</option>
                                                                    <option value="Completed">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="statusreason">Status Reason<br>[If any] :</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="statusreason" id="statusreason" placeholder="Here statusreason" rows="4"><?php echo $roworders['status_reason'] ?></textarea>

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
                                                        <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Update Order</button>
                                                        <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>

                                                    </div>
                                                </div>
                                                <!--End Row-->
                                            </div>
                                            <?php
                                            if (isset($_POST['submit'])) {
                                                $cusname = $_POST["cusname"];
                                                $brandname = $_POST["brandname"];
                                                $orgorderid= $_POST["orgorderid"];
                                                echo   $orgorderid;
                                                $addr = $_POST["addr"];
                                                $phoneno = $_POST["phoneno"];
                                                $emailid = $_POST["emailid"];
                                                $contacteddate = $_POST["contacteddate"];
                                                $contactedtime = $_POST["contactedtime"];

                                                $qutamt = $_POST["qutamt"];
                                                $leadsource = $_POST["leadsource"];
                                                $orderstatus = $_POST["status"];
                                                $statusreason = $_POST["statusreason"];

                                                date_default_timezone_set("Asia/Calcutta");
                                                $postdate = date("M d,Y h:i:s a");
                                                $sql = "UPDATE order_customers SET custName='". mysqli_real_escape_string($connection, $cusname) . "',
                                                brandName='". mysqli_real_escape_string($connection, $brandname) . "', addr='". mysqli_real_escape_string($connection, $addr) . "',
                                                custPhone='". mysqli_real_escape_string($connection, $phoneno) . "',custEmail='". mysqli_real_escape_string($connection, $emailid) . "',
                                                contactDate='". mysqli_real_escape_string($connection, $contacteddate) . "',contactTime='". mysqli_real_escape_string($connection, $contactedtime) . "',
                                                quotedAmt='". mysqli_real_escape_string($connection, $qutamt) . "',leadSource='". mysqli_real_escape_string($connection, $leadsource) . "',
                                                modified='". mysqli_real_escape_string($connection, $postdate) . "',order_status='". mysqli_real_escape_string($connection, $orderstatus) . "',
                                                status_reason='". mysqli_real_escape_string($connection, $statusreason) . "'  WHERE id='". $orgorderid ."'";



                                  
                                                if ($connection->query($sql) === TRUE) {

                                                    //  ======================= userid creation =========================  
                                                    $sql = "DELETE FROM order_category WHERE order_id='" . $orgorderid . "'";

                                                    if ($connection->query($sql) === TRUE) {
                                                      echo "Record deleted successfully";
                                                    } else {
                                                      echo "Error deleting record: " . $connection->error;
                                                    }
                                                    $sql = "DELETE FROM order_subcategory WHERE order_id='" . $orgorderid . "'";

                                                    if ($connection->query($sql) === TRUE) {
                                                    echo "Record deleted successfully";
                                                    } else {
                                                    echo "Error deleting record: " . $connection->error;
                                                    }

                                                    if (isset($_POST['mulselect'])) {
                                                        $selectedOptions = $_POST['mulselect'];
                                                    
                                                        // Loop through selected options and insert into the database
                                                        foreach ($selectedOptions as $categoryId) {
                                                            $querycategory = "INSERT INTO order_category (order_id, category_id)
                                                            VALUES('$orgorderid', '$categoryId')";
                                                    
                                                            if ($connection->query($querycategory) === TRUE) {
                                                                // Successfully inserted into the database
                                                            } else {
                                                                // Handle the error if the insertion fails
                                                                echo "Error: " . $querycategory . "<br>" . $connection->error;
                                                            }
                                                        }
                                                    }
                                                    if (isset($_POST['mulselectsub'])) {
                                                        $selectedOptions = $_POST['mulselectsub'];
                                                    
                                                        // Loop through selected options and insert into the database
                                                        foreach ($selectedOptions as $subcategoryId) {
                                                            $querysubcategory = "INSERT INTO order_subcategory (order_id,  subcategory_id)
                                                            VALUES ('$orgorderid',  '$subcategoryId')";
                                                    
                                                            if ($connection->query($querysubcategory) === TRUE) {
                                                                // Successfully inserted into the database
                                                            } else {
                                                                // Handle the error if the insertion fails
                                                                echo "Error: " . $querysubcategory . "<br>" . $connection->error;
                                                            }
                                                        }
                                                    }


                                                    header("Location: orderlist.php");
                                                } else {
                                                    echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                }
                                            }
                                            ?>

                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- /ROW-1 CLOSED -->
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

            <script>
                $(document).ready(function(e) {
                    $('#cancel').delegate('', 'click change', function() {
                        window.location = "orderlist.php";
                        return false;
                    });

                    $('#mulselect').delegate('', 'click change', function() {
                        var ordersValueid = $('#mulselect').val();
                        console.log(ordersValueid);
                    });
                });



                function togglePasswordVisibility(inputId) {
                    const passwordField = document.getElementById(inputId);
                    const togglePassword = document.querySelector(`[data-toggle="${inputId}"]`);

                    if (passwordField.type === "password") {
                        passwordField.type = "text";
                        togglePassword.textContent = "👁️";
                    } else {
                        passwordField.type = "password";
                        togglePassword.textContent = "👁️";
                    }
                }
            </script>
        </body>

        </html>

<?php }
} ?>