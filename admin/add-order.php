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
                            <h2 class="main-content-title tx-24 mg-b-5">Add Order</h2>
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
                                    <div class="card-title">Add New Order</div>
                                </div>
                                <form id="adddesig" method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="card-body">
                                                <h6>Basic Informations</h6>
                                                <hr>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="empname">Customer Name :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="cusname" name="cusname" placeholder="Customer Name" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="empname">Brand Name :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="brandname" name="brandname" placeholder="Brand Name" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="addr">Address :</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" name="addr" id="addr" palceholder="Here Address" rows="4"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="poneno">Phone No :</label>
                                                    <div class="col-md-9">
                                                        <input type="number"  pattern="[6-9]\d{9}" class="form-control" name="phoneno" id="phoneno" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="emailid">Email ID :</label>
                                                    <div class="col-md-9">
                                                        <input type="email"   pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" name="emailid" id="emailid" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="contacteddate">Contacted Date :</label>
                                                    <div class="col-md-9">
                                                        <input type="date" name="contacteddate" id="contacteddate" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="contactedtime">Contacted Time :</label>
                                                    <div class="col-md-9">
                                                        <input type="time" name="contactedtime" id="contactedtime" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <!-- -->


                                                <!-- Row -->

                                                <!--End Rowcontent-->



                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <h5>Order Informations</h5>
                                                <hr>
                                                <!-- =================================== -->
                                                <div class="row mb-4">

                                                    <style>
                                                        ul {
                                                            list-style: none;
                                                            margin: 0;
                                                            padding: 0;
                                                        }

                                                        li {
                                                            margin-bottom: 5px;
                                                        }
                                                    </style>
                                                    <?php
                                                    // Fetch categories from the database
                                                    $categoriesQuery = "SELECT * FROM category";
                                                    $categoriesResult = $connection->query($categoriesQuery);

                                                    if ($categoriesResult->num_rows > 0) {
                                                        echo '<div class="col-md-6">';
                                                        echo '<h6>Select Categories</h6>';
                                                        echo '<ul id="categoriesList" name="categoriesList">';
                                                        while ($categoryRow = $categoriesResult->fetch_assoc()) {
                                                            echo '<li><input type="checkbox" name="categories[]" value="' . $categoryRow['id'] . '">' . $categoryRow['category'] . '</li>';
                                                        }
                                                        echo '</ul>';
                                                        echo '</div>';
                                                        echo '<div class="col-md-6">';
                                                        echo '<h5>Select Subcategories</h5>';
                                                        echo '<ul id="subcategoriesList" name="subcategoriesList"></ul>';

                                                        echo '<script>
                                                                document.addEventListener("DOMContentLoaded", function () {
                                                                    var categoriesCheckbox = document.getElementsByName("categories[]");
                                                                    var subcategoriesList = document.getElementById("subcategoriesList");

                                                                    for (var i = 0; i < categoriesCheckbox.length; i++) {
                                                                        categoriesCheckbox[i].addEventListener("change", function () {
                                                                            updateSubcategories();
                                                                        });
                                                                    }

                                                                    function updateSubcategories() {
                                                                        subcategoriesList.innerHTML = "";
                                                                        for (var i = 0; i < categoriesCheckbox.length; i++) {
                                                                            if (categoriesCheckbox[i].checked) {
                                                                                var categoryId = categoriesCheckbox[i].value;

                                                                                // Fetch subcategories from the server/database using AJAX
                                                                                var xhr = new XMLHttpRequest();
                                                                                xhr.onreadystatechange = function () {
                                                                                    if (this.readyState === 4 && this.status === 200) {
                                                                                        var subcategories = JSON.parse(this.responseText);

                                                                                        for (var j = 0; j < subcategories.length; j++) {
                                                                                            var subcategoryItem = document.createElement("li");
                                                                                            var subcategoryCheckbox = document.createElement("input");
                                                                                            subcategoryCheckbox.type = "checkbox";
                                                                                            subcategoryCheckbox.name = "subcategories[]";
                                                                                            subcategoryCheckbox.value = subcategories[j].id;
                                                                                            // Add a data attribute to store the category ID
                                                                                            subcategoryItem.setAttribute("data-categoryid", categoryId);        
                                                                                            subcategoryItem.appendChild(subcategoryCheckbox);
                                                                                                                                                                                       subcategoryItem.appendChild(document.createTextNode(subcategories[j].subcategory));
                                                                                            subcategoriesList.appendChild(subcategoryItem);
                                                                                        }
                                                                                    }
                                                                                };
                                                                                xhr.open("GET", "get_subcategories.php?category_id=" + categoryId, true);
                                                                                xhr.send();
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                            </script>';
                                                        echo '</div>';
                                                    } else {
                                                        echo "No categories found in the database.";
                                                    }


                                                    ?>
                                                </div>
                                                <!-- ============================================================= -->

                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="qutamt">Quoted Amount :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="qutamt" name="qutamt" placeholder="Quoted Amount" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="leadsource">Lead Source :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="leadsource" name="leadsource" placeholder="Lead Source" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="status">Order Status :</label>
                                                    <div class="col-md-9">
                                                        <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
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
                                                        <textarea class="form-control" name="statusreason" id="statusreason" palceholder="Here statusreason" rows="4"></textarea>

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
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Add Order</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>

                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $cusname = $_POST["cusname"];
                                        $brandname = $_POST["brandname"];

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

                                        $sql = "INSERT INTO order_customers (custName,brandName,addr,custPhone,custEmail,contactDate,contactTime,quotedAmt,leadSource,created,modified,lead_entered,
                                        empid,order_status,status_reason) 
                                        values('" . mysqli_real_escape_string($connection, $cusname) . "','" . mysqli_real_escape_string($connection, $brandname) . "',
                                                '" . mysqli_real_escape_string($connection, $addr) . "','" . mysqli_real_escape_string($connection, $phoneno) . "',
                                                                '" . mysqli_real_escape_string($connection, $emailid) . "','" . mysqli_real_escape_string($connection, $contacteddate) . "',
                                                                '" . mysqli_real_escape_string($connection, $contactedtime) . "',
                                                                '" . mysqli_real_escape_string($connection, $qutamt) . "','" . mysqli_real_escape_string($connection, $leadsource) . "',
                                                                '" . mysqli_real_escape_string($connection, $postdate) . "',
                                                                '" . mysqli_real_escape_string($connection, $postdate) . "','Administrator',
                                                                '" . mysqli_real_escape_string($connection, $_SESSION['salesempid']) . "','" . mysqli_real_escape_string($connection, $orderstatus) . "',
                                                                '" . mysqli_real_escape_string($connection, $statusreason) . "')";

                                        if ($connection->query($sql) === TRUE) {

                                            //  ======================= userid creation =========================  
                                            $last_lead_id = $connection->insert_id;

                                            if (isset($_POST['categories'])) {
                                                $selectedCategories = $_POST['categories'];

                                                // Loop through selected categories and insert into the database
                                                foreach ($selectedCategories as $categoryId) {
                                                    $querycategory = "INSERT INTO order_category (order_id, category_id)
                                                    VALUES('$last_lead_id', '$categoryId')";

                                                    if ($connection->query($querycategory) === TRUE) {
                                                    }
                                                }
                                            }

                                            if (isset($_POST['subcategories'])) {
                                                $selectedSubcategories = $_POST['subcategories'];
                                        

                                                // $subcategoryCategoryIds = "<script> document.getElementById('subcategories').getAttribute('data-categoryid')</script>";
                                                // Loop through selected subcategories and corresponding category IDs
                                                for ($i = 0; $i < count($selectedSubcategories); $i++) {
                                                    $subcategoryId = $selectedSubcategories[$i];
                                                    // $categoryId = $subcategoryCategoryIds[$i];

                                                    // Perform appropriate SQL query to insert into your database
                                                    $sql = "INSERT INTO order_subcategory (order_id,  subcategory_id)
                                                    VALUES ('$last_lead_id',  '$subcategoryId')";

                                                    if ($connection->query($sql) === TRUE) {
                                                        // Successfully inserted into the database
                                                    } else {
                                                        // Handle error if necessary
                                                        echo "Error: " . $sql . "<br>" . $connection->error;
                                                    }
                                                }
                                            }

                                            $querycategory = "INSERT INTO order_tracking (order_id, status, status_date, notes)
                                            VALUES('$last_lead_id', '$orderstatus','$postdate','$statusreason')";

                                            if ($connection->query($querycategory) === TRUE) {
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