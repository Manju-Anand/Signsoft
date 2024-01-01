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
$categid = $_GET["edit"];
$designame="";
$deptname="";
$username="";
$cmded="";
$sqlemployee = "SELECT * FROM employee where id='" . $categid  . "'";
$resultemployee = $connection->query($sqlemployee);

if ($resultemployee->num_rows > 0) {
  while($rowemployee = $resultemployee->fetch_assoc()) {

$sqldept = "SELECT * FROM department where id='" . $rowemployee['department_id']  . "'";
$resultdept = $connection->query($sqldept);
if ($resultdept->num_rows > 0) {
  while($rowdept = $resultdept->fetch_assoc()) {
    $deptname=$rowdept['department'];
  }}

$sqldesig = "SELECT * FROM designation where id='" . $rowemployee['desig_id']  . "'";
$resultdesig = $connection->query($sqldesig);
if ($resultdesig->num_rows > 0) {
  while($rowdesig = $resultdesig->fetch_assoc()) {
    $designame=$rowdesig['designation'];
  }}

$sqluser = "SELECT * FROM employee_user where id='" . $rowemployee['user_id']  . "'";
$resultuser = $connection->query($sqluser);
if ($resultuser->num_rows > 0) {
  while($rowuser = $resultuser->fetch_assoc()) {
    $username=$rowuser['email'];
    $cmded=$rowuser['cmded'];
  }}

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
                            <h2 class="main-content-title tx-24 mg-b-5">Edit Employee</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Edit Employee</a></li>
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
                                    <div class="card-title">Edit Employee</div>
                                </div>
                                <form id="adddesig" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="empid" name="empid" value="<?php echo $categid;  ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="empname">Employee Name :</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="empname" name="empname" value="<?php echo $rowemployee['empname'] ?>" placeholder="Employee Name" required>
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
                                                            <option selected value="<?php echo $rowemployee['department_id'] ?>" data-questions="<?php echo $rowemployee['department_id']; ?>" data-ans="<?php echo $deptname; ?>"><?php echo $deptname ?></option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4" id="ajaxresult">
                                                    <label class="col-md-3 form-label" for="desig">Designation :</label>
                                                    <div class="col-md-9">
                                                        <select name="desig" id="desig" class="form-control form-select select2" data-bs-placeholder="Select Designation" required>
                                                        <option selected value="<?php echo $rowemployee['desig_id'] ?>" data-questions="<?php echo $rowemployee['desig_id']; ?>" data-ans="<?php echo $designame; ?>"><?php echo $designame ?></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Row -->
                                                <div class="row">
                                                    <label class="col-md-3 form-label mb-4" for="addr">Address :</label>
                                                    <div class="col-md-9 mb-4">
                                                        <textarea class="form-control" name="addr" id="addr" palceholder="Here Address"><?php echo $rowemployee['addres'] ?></textarea>
                                                    </div>
                                                </div>
                                                <!--End Rowcontent-->
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="poneno">Phone No :</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" name="phoneno" id="phoneno" placeholder="" value="<?php echo $rowemployee['phoneno'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="emailid">Email ID :</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="emailid" id="emailid" class="form-control" value="<?php echo $rowemployee['emailid'] ?>"  placeholder="">
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
                                                        <input type="email" name="loginemailid" id="loginemailid" class="form-control"  value="<?php echo $username ?>" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="row mb-4 ">
                                                    <label class="col-md-3 form-label mb-4">Login Password :</label>
                                                    <div class="col-md-9  password-container">
                                                        <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  -->
                                                        <input type="password" class="form-control" autocomplete="off" name="loginpassword" id="loginpassword" placeholder="Password"  value="<?php echo $cmded ?>"  required>
                                                        <span id="togglePassword" class="password-toggle" data-toggle="loginpassword" onclick="togglePasswordVisibility('loginpassword')">👁️</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="joindate">Joining Date :</label>
                                                    <div class="col-md-9">
                                                        <input type="date" name="joindate" id="joindate" class="form-control"  value="<?php echo $rowemployee['joindate'] ?>" placeholder="">
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
                                                            <option selected value="<?php echo $rowemployee['bloodgrp'] ?>"><?php echo $rowemployee['bloodgrp'] ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label mb-4">Photo Upload :</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" type="file" name="files" id="files" accept=".jpg, .png, image/jpeg, image/png">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <img src="../assets/img/staff/<?php echo $rowemployee['emppic'] ?>" name="uppic" id="uppic" width="40%">
                                                    </div>
                                                </div>
                                                <!--End Row-->
                                                <div class="row mb-4">
                                                    <label class="col-md-3 form-label" for="status">Status :</label>
                                                    <div class="col-md-9">
                                                        <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                            <option selected value="<?php echo $rowemployee['status'] ?>"><?php echo $rowemployee['status'] ?></option>
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
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Update Employee</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>

                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $empid = $_POST["empid"];
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

                                      

                                        $status = $_POST["status"];
                                        date_default_timezone_set("Asia/Calcutta");
                                        $postdate = date("M d,Y h:i:s a");
                                        if (isset($_FILES['files']) && !empty($_FILES['files']['tmp_name'])) {
                                            // File is uploaded, process it here
                                            $file_tmpname = $_FILES['files']['tmp_name'];

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
                                        

                                        $sql = "UPDATE employee set desig_id ='" . mysqli_real_escape_string($connection, $desig) . "',
                                            status='" . mysqli_real_escape_string($connection, $status) . "',modified='" . mysqli_real_escape_string($connection, $postdate) . "'
                                            ,department_id='" . mysqli_real_escape_string($connection, $department) . "',addres='" . mysqli_real_escape_string($connection, $addr) . "',
                                            phoneno='" . mysqli_real_escape_string($connection, $phoneno) . "',emailid='" . mysqli_real_escape_string($connection, $emailid) . "',
                                            joindate='" . mysqli_real_escape_string($connection, $joindate) . "',
                                            emppic='" . mysqli_real_escape_string($connection, $saveFileName) . "',bloodgrp='" . mysqli_real_escape_string($connection, $bloodgroup) . "',
                                            empname='" . mysqli_real_escape_string($connection, $empname) . "' WHERE id = {$empid}";
                                        } else {
                                            $sql = "UPDATE employee set desig_id ='" . mysqli_real_escape_string($connection, $desig) . "',
                                            status='" . mysqli_real_escape_string($connection, $status) . "',modified='" . mysqli_real_escape_string($connection, $postdate) . "'
                                            ,department_id='" . mysqli_real_escape_string($connection, $department) . "',addres='" . mysqli_real_escape_string($connection, $addr) . "',
                                            phoneno='" . mysqli_real_escape_string($connection, $phoneno) . "',emailid='" . mysqli_real_escape_string($connection, $emailid) . "',
                                            joindate='" . mysqli_real_escape_string($connection, $joindate) . "',
                                            bloodgrp='" . mysqli_real_escape_string($connection, $bloodgroup) . "',
                                            empname='" . mysqli_real_escape_string($connection, $empname) . "' WHERE id = {$empid}";
                                            
                                        }





                                        if ($connection->query($sql) === TRUE) {
                                            
                                        } else {
                                            echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                        }

                                        $password = md5($pass1); //encrypt the password before saving in the database
                                        $sqlempuser = "UPDATE employee_user SET email='$loginname',password='$password',
                                        username='$empname',cmded='$pass1',designation='$desig',department='$department' WHERE empid='" . $empid . "'";
                                        if ($connection->query($sqlempuser) === TRUE) {
                                        }else {
                                            echo "Error:ans1 " . $sqlempuser . "<br>" . $connection->error;
                                        }
                                        header("Location: employeelist.php");
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
<?php }} ?>