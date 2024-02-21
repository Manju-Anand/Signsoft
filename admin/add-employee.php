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
                            <h2 class="main-content-title tx-24 mg-b-5">Add Employee</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Add Employee</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Masters</li>
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
                                <div class="card-header">
                                    <div class="card-title">Add New Employee</div>
                                </div>
                                <form id="adddesig" method="post" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="empname">Employee Name :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="empname" name="empname" placeholder="Employee Name" required>
                                                    </div>
                                                </div>
                                                <!-- -->
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="dept">Department :</label>
                                                    <div class="col-md-9">
                                                        <select class="form-select mb-3" aria-label="Default select example" name="dept" id="dept" required>
                                                            <option value="" disabled selected>Select Department</option>
                                                            <?php
                                                            $query = "select * from department order by id desc";
                                                            $select_posts = mysqli_query($connection, $query);
                                                            while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['department'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4" id="ajaxresult">
                                                    <label class="col-md-3 form-label" for="desig">Designation :</label>
                                                    <div class="col-md-9">
                                                        <select name="desig" id="desig" class="form-control form-select select2" data-bs-placeholder="Select Designation" required>

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Row -->
                                                <div class="row">
                                                    <label class="col-md-3 form-label mb-4" for="addr">Address :</label>
                                                    <div class="col-md-9 mb-4">
                                                        <textarea class="form-control" name="addr" id="addr" palceholder="Here Address"></textarea>
                                                    </div>
                                                </div>
                                                <!--End Rowcontent-->
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="poneno">Phone No :</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" class="form-control" name="phoneno" id="phoneno" pattern="[6-9]\d{9}" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="emailid">Email ID :</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="emailid" id="emailid"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" class="form-control" placeholder="">
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                            <style>
                                                .password-container {
                                                    position: relative;
                                                }

                                                .password-toggle {
                                                    position: absolute;
                                                    top: 50%;
                                                    right: 20px;
                                                    transform: translateY(-50%);
                                                    cursor: pointer;
                                                }
                                            </style>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label mb-4">Login E-mailid :</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="loginemailid" id="loginemailid"  pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4 ">
                                                    <label class="col-md-3 form-label mb-4">Login Password :</label>
                                                    <div class="col-md-9  password-container">
                                                        <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  -->
                                                        <input type="password" class="form-control" autocomplete="off" name="loginpassword" id="loginpassword" placeholder="Password" required>
                                                        <span id="togglePassword" class="password-toggle" data-toggle="loginpassword" onclick="togglePasswordVisibility('loginpassword')">👁️</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="joindate">Joining Date :</label>
                                                    <div class="col-md-9">
                                                        <input type="date" name="joindate" id="joindate" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="bloodgroup">Blood Group :</label>
                                                    <div class="col-md-9">
                                                        <select name="bloodgroup" id="bloodgroup" class="form-control form-select select2" data-bs-placeholder="Select Blood Group">
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label mb-4">Photo Upload :</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="file" name="files" id="files" accept=".jpg, .png, image/jpeg, image/png">
                                                    </div>
                                                </div>
                                                <!--End Row-->
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="status">Status :</label>
                                                    <div class="col-md-9">
                                                        <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>

                                                        </select>
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
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Add Employee</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>

                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $empname = $_POST["empname"];
                                        $department = $_POST["dept"];
                                        $desig = $_POST["desig"];
                                        $addr = $_POST["addr"];
                                        $phoneno = $_POST["phoneno"];
                                        $emailid = $_POST["emailid"];
                                        $joindate = $_POST["joindate"];
                                        $bloodgroup = $_POST["bloodgroup"];

                                        $loginname = $_POST["loginemailid"];
                                        $pass1 = $_POST["loginpassword"];
                                        $saveFileName ="";
                                        if (!empty(array_filter($_FILES['files']['name']))) {
                                        $upload_dir = '../assets/img/staff/';
                                        $file_tmpname = $_FILES['files']['tmp_name'];
                                        $file_name = $_FILES['files']['name'];
                                        $file_size = $_FILES['files']['size'];
                                        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                                        // Set upload file path
                                        $filepath = $upload_dir . $file_name;
                                        $randomNumber = mt_rand(100000, 999999);
                                        // Create a new file name with the random number
                                        $newFileName = $upload_dir  .  $randomNumber . '.' . $file_ext;
                                        $saveFileName =   $randomNumber . '.' . $file_ext;
                                        if (move_uploaded_file($file_tmpname,  $newFileName)) {
                                            echo "{$file_name} successfully uploaded <br />";
                                        } else {
                                            echo "{$file_name} not uploaded <br />";
                                        }
                                    }
                                        $status = $_POST["status"];
                                        date_default_timezone_set("Asia/Calcutta");
                                        $postdate = date("M d,Y h:i:s a");

                                        $sql = "INSERT INTO employee (empname,department_id,desig_id,status,created,modified,addres,phoneno,emailid,
                                                joindate,emppic,bloodgrp) values('" . mysqli_real_escape_string($connection, $empname) . "','" . mysqli_real_escape_string($connection, $department) . "',
                                                '" . mysqli_real_escape_string($connection, $desig) . "','" . mysqli_real_escape_string($connection, $status) . "',
                                                                '" . mysqli_real_escape_string($connection, $postdate) . "','" . mysqli_real_escape_string($connection, $postdate) . "',
                                                                '" . mysqli_real_escape_string($connection, $addr) . "',
                                                                '" . mysqli_real_escape_string($connection, $phoneno) . "','" . mysqli_real_escape_string($connection, $emailid) . "',
                                                                '" . mysqli_real_escape_string($connection, $joindate) . "',
                                                                '" . mysqli_real_escape_string($connection, $saveFileName) . "','" . mysqli_real_escape_string($connection, $bloodgroup) . "')";

                                        if ($connection->query($sql) === TRUE) {

                                            //  ======================= userid creation =========================  
                                            $last_emp_id = $connection->insert_id;
                                             // Use password_hash to securely hash the password
                                            $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
                                            // $password = md5($pass1); //encrypt the password before saving in the database
                                            $queryuser = "INSERT INTO employee_user (username, email, password,designation,empid,cmded,department)
                                                    VALUES('$empname', '$loginname', '$hashed_password','$desig','$last_emp_id','$pass1','$department')";

                                            if ($connection->query($queryuser) === TRUE) {
                                                $last_user_id = $connection->insert_id;

                                                $sqlemp = "UPDATE employee SET user_id='$last_user_id' WHERE id='" . $last_emp_id . "'";

                                                if ($connection->query($sqlemp) === TRUE) {
                                                    header("Location: employeelist.php");
                                                } else {
                                                    echo "Error updating record: " . $connection->error;
                                                }
                                            }




                                            // header("Location: employeelist.php");
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
                window.location = "employeelist.php";
                return false;
            });
        });

        $("#dept").on("change", function() {
            var fname = $(this).find(":selected").attr("data-questions");
            $.ajax({
                type: "POST",
                url: "ajaxdesignation.php",
                data: "fname=" + fname,
                success: function(data) {
                    $('#ajaxresult').html(data);
                }
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