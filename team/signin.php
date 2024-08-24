<?php 
session_start();
include "includes/connection.php";
$errors = array(); // Initialize errors array

// if (isset($_POST['submit'])) {
//     $email = mysqli_real_escape_string($connection, $_POST['email']);
//     $password = mysqli_real_escape_string($connection, $_POST['password']);
//     $deptid = mysqli_real_escape_string($connection, $_POST['dept']);
//     $desigid = mysqli_real_escape_string($connection, $_POST['desig']);

//     if (empty($email)) {
//         array_push($errors, "Email is required");
//     }

//     if (empty($password)) {
//         array_push($errors, "Password is required");
//     }

//     if (count($errors) === 0) {
//         $sqldept = "SELECT * FROM department WHERE id='" . $deptid . "'";
//         $resultdept = $connection->query($sqldept);

//         if ($resultdept->num_rows > 0) {
//             while ($rowuserdept = $resultdept->fetch_assoc()) {
//                 $modulename = $rowuserdept['dname'];
//                 $deptid = $rowuserdept['id'];
//                 $_SESSION['deptid'] = $deptid;
//                 $_SESSION['modulename'] = $modulename;

//                 $sql = "SELECT * FROM employee_user WHERE email='$email' and department='$deptid' and designation='$desigid'";
//                 $result = mysqli_query($connection, $sql);

//                 if ($result) {
//                     if (mysqli_num_rows($result) === 1) {
//                         $rowuser = mysqli_fetch_assoc($result);
//                         $login_successful = false;

//                         if (password_verify($password, $rowuser['password'])) {
//                             $_SESSION['empname'] = $rowuser['username'];
//                             $_SESSION['empemail'] = $email;
//                             $_SESSION['empid'] = $rowuser['empid'];
//                             $login_successful = true;
//                         } else {
//                             array_push($errors, "Wrong username/password combination");
//                         }

//                         if ($login_successful) {
//                             header('Location: index.php');
//                             exit(); 
//                         } else {
//                             array_push($errors, "Wrong username/password/department/designation combination");
//                         }
//                     } else {
//                         array_push($errors, "Wrong username/password/department/designation combination");
//                     }
//                     mysqli_free_result($result);
//                 } else {
//                     array_push($errors, "Query error: " . mysqli_error($connection));
//                 }
//             }
//         }
//     }
// }

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $deptid = mysqli_real_escape_string($connection, $_POST['dept']);
    $desigid = mysqli_real_escape_string($connection, $_POST['desig']);

    $errors = array();

    if (empty($email)) {
        array_push($errors, "Email is required");
    }

    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (empty($deptid)) {
        array_push($errors, "Department is required");
    }

    if (empty($desigid)) {
        array_push($errors, "Designation is required");
    }

    if (count($errors) === 0) {
        $sqldept = "SELECT * FROM department WHERE id='" . $deptid . "'";
        $resultdept = $connection->query($sqldept);

        if ($resultdept->num_rows > 0) {
            while ($rowuserdept = $resultdept->fetch_assoc()) {
                $modulename = $rowuserdept['dname'];
                $deptid = $rowuserdept['id'];
                $_SESSION['deptid'] = $deptid;
                $_SESSION['modulename'] = $modulename;

                $sql = "SELECT * FROM employee_user WHERE email='$email' AND department='$deptid' AND designation='$desigid'";
                $result = mysqli_query($connection, $sql);

                if ($result) {
                    if (mysqli_num_rows($result) === 1) {
                        $rowuser = mysqli_fetch_assoc($result);
                        if (password_verify($password, $rowuser['password'])) {
                            $_SESSION['empname'] = $rowuser['username'];
                            $_SESSION['empemail'] = $email;
                            $_SESSION['empid'] = $rowuser['empid'];
                            header('Location: index.php');
                            exit(); // Ensure that the script stops execution after redirect
                        } else {
                            array_push($errors, "Incorrect password");
                        }
                    } else {
                        array_push($errors, "No user found with the provided email, department, and designation");
                    }
                    mysqli_free_result($result);
                } else {
                    array_push($errors, "Query error: " . mysqli_error($connection));
                }
            }
        } else {
            array_push($errors, "Invalid department ID");
        }
    }

    if (count($errors) > 0) {
        // Display all errors in a single alert
        // echo "<script>alert('".implode("\\n", $errors)."');</script>";
    }
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
    <style>
        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 70%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<!-- <body class="main-body ltr login-img"> -->
<body class="main-body ltr login-img" style="background: url('../assets/img/login/un4.png') no-repeat center center fixed; background-size: cover; margin: 0; padding: 0; font-family: 'Arial', sans-serif; color: #333;">

    <!-- Loader -->
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page main-signin-wrapper">
        <!-- Row -->
        <div class="row text-center ps-0 pe-0 ms-0 me-0">
            <div class=" col-xl-4 col-lg-5 col-md-5 d-block mx-auto">
                <div class="text-center mb-2">
                    <a href="index.php">
                        <img src="../assets/img/SLogoBlue.png" class="header-brand-img" alt="logo">
                        <img src="../assets/img/SLogoBlue.png" class="header-brand-img theme-logos" alt="logo">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body pd-30">
                        <h4 class="text-center">Signin to SignSoft</h4>
                        <form method="post" action="signin.php">
                        <?php if (!empty($errors)) include('errors.php'); ?> 
                            <div class="form-group text-start">
                                <label>Email</label>
                                <input class="form-control" placeholder="Enter your email" name="email" id="email" type="text">
                            </div>
                            <div class="form-group text-start password-container">
                                <label>Password</label>
                                <input class="form-control" placeholder="Enter your password" name="password" id="password" type="password">
                                <span id="togglePassword" class="password-toggle" data-toggle="loginpassword" onclick="togglePasswordVisibility('password')">👁️</span>
                            </div>
                            <div class="form-group text-start">
                                <label>Department</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="dept" id="dept" required>
                                    <option value="" disabled selected>Select Department</option>
                                    <?php
                                    $querydept = "select * from department";
                                    $select_postsdept = mysqli_query($connection, $querydept);
                                    while ($rowdept = mysqli_fetch_assoc($select_postsdept)) {
                                    ?>
                                        <option value="<?php echo $rowdept['id'] ?>" data-questions="<?php echo $rowdept['id'] ?>"><?php echo $rowdept['department'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group text-start" id="ajaxresult">
                                <label>Designation</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="desig" id="desig" required>
                                    <option value="" disabled selected>Select Designation</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn ripple btn-main-primary btn-block">Sign In</button>
                        </form>
                        <div class="mt-3 text-center">
                            <!-- <p class="mb-1"><a href="javascript:void(0);">Forgot password?</a></p>
                            <p class="mb-0">Don't have an account? <a href="signup.html" class="text-primary">Create an Account</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    <!-- End Page -->

    <!-- Jquery js-->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/plugins/bootstrap/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
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
