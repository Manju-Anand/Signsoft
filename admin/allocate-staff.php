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
$orderid = $_GET["add"];

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
                            <h2 class="main-content-title tx-24 mg-b-5">Allocate Staff</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Staff Allocation</a></li>
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
                                    <div class="card-title">Add New Staff Allocation</div>
                                </div>
                                <form id="adddesig" method="post" action="">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <strong><label class="form-label" for="orderid">Order Id : <?php echo $orderid; ?></label></strong>
                                                        <input type="hidden" class="form-control" id="orderid" name="orderid" value="<?php echo $orderid; ?>">
                                                    </div><br />
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="dept">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="dept" id="dept" required>
                                                            <option value="" disabled selected>Select Order Entry</option>
                                                            <?php
                                                            $queryorder = "select * from order_category where id ='" . $orderid . "'";
                                                            $select_postsorder = mysqli_query($connection, $queryorder);
                                                            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
                                                                $query = "select * from category where id ='" . $roworder['category_id'] . "'";
                                                                $select_posts = mysqli_query($connection, $query);
                                                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                                            ?>
                                                                    <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option>
                                                            <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="staff">Staff Name :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="staff" id="staff" required>
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
                                                        <input type="text" class="form-control" id="workper" name="workper" placeholder="Percentage of work" required>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                        <button type="button" name="submit" class="btn btn-primary" onclick="addRow()" style="color:white;cursor:pointer;">Allocate Staff</button>

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
                                                                    <th>Staff Name</th>
                                                                    <th class="hidden-cell">Emp Id</th>
                                                                    <th>Work Assigned</th>
                                                                    <th>Dead Line</th>
                                                                    <th>% of work</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>

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

                            </div>
                        </div>
                        <?php
                        $query = "select * from staff_allocation where orderid='" . $orderid . "'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                        ?>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title" style="color:green;text-decoration: underline;font-weight:bold;">Already Allocated Staffs</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered mg-b-0" id="dataTable12345">
                                                        <thead>
                                                            <tr style="background-color: #ffa07a;">
                                                                <th>#</th>
                                                                <th>Order</th>
                                                                <th class="hidden-cell">order Id</th>
                                                                <th>Staff Name</th>
                                                                <th class="hidden-cell">Emp Id</th>
                                                                <th>Work Assigned</th>
                                                                <th>Dead Line</th>
                                                                <th>% of work</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $u = 0;
                                                            while ($row = $result->fetch_assoc()) {
                                                                $u = $u + 1;
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $u; ?></td>
                                                                    <td><?php echo $row['entryname']; ?></td>
                                                                    <td class="hidden-cell"><?php echo $row['entryid']; ?></td>
                                                                    <td><?php echo $row['empname']; ?></td>
                                                                    <td class="hidden-cell"><?php echo $row['empid']; ?></td>
                                                                    <td><?php echo $row['work_assigned']; ?></td>
                                                                    <td><?php echo $row['deadline']; ?></td>
                                                                    <td><?php echo $row['per_of_work']; ?></td>
                                                                </tr>


                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
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
                window.location = "staffAllocation.php";
                return false;
            });
        });
    </script>
    <script>
        var rowCounter = 0; // Move the initialization here
        function addRow() {
            var table = document.getElementById("dataTable");
            var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
            var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody


            // Numbering Column
            var cell1 = newRow.insertCell(0);

            cell1.innerHTML = ++rowCounter; // Increment before setting the innerHTML

            // Select Box 1
            var cell2 = newRow.insertCell(1);
            var selectBox1 = document.getElementById("dept");
            cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

            // Select Box 2
            var cell3 = newRow.insertCell(2);
            var selectBox2 = document.getElementById("dept");
            cell3.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
            cell3.classList.add('hidden-cell');

            // Select Box 1
            var cell4 = newRow.insertCell(3);
            var selectBox1 = document.getElementById("staff");
            cell4.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

            // Select Box 2
            var cell5 = newRow.insertCell(4);
            var selectBox2 = document.getElementById("staff");
            cell5.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
            cell5.classList.add('hidden-cell');
            // Text Box 1
            var cell6 = newRow.insertCell(5);
            var textBox1 = document.getElementById("assignwork");
            cell6.innerHTML = textBox1.value;

            // Text Box 2
            var cell7 = newRow.insertCell(6);
            var textBox2 = document.getElementById("deadline");
            cell7.innerHTML = textBox2.value;

            // Text Box 3
            var cell8 = newRow.insertCell(7);
            var textBox3 = document.getElementById("workper");
            cell8.innerHTML = textBox3.value;

            // Clear input values after adding to the table
            textBox1.value = "";
            textBox2.value = "";
            textBox3.value = "";
            // Clear select box values
            selectBox1.selectedIndex = -1;
            selectBox2.selectedIndex = -1;
        }

        function saveDataToDatabase() {
            var table = document.getElementById("dataTable");
            var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
            console.log("hai   :" + rows)
            var dataToSave = [];

            // Iterate through each row
            for (var i = 0; i < rows.length; i++) {
                console.log(i);
                var row = rows[i];
                var cells = row.getElementsByTagName("td");

                var rowData = {
                    orderid: document.getElementById("orderid").value,
                    entry: cells[1].innerHTML, // Adjust the index based on your table structure
                    entryid: cells[2].innerHTML, // Adjust the index based on your table structure
                    staffName: cells[3].innerHTML, // Adjust the index based on your table structure
                    staffid: cells[4].innerHTML, // Adjust the index based on your table structure
                    workAssigned: cells[5].innerHTML, // Adjust the index based on your table structure
                    deadline: cells[6].innerHTML, // Adjust the index based on your table structure
                    percentOfWork: cells[7].innerHTML // Adjust the index based on your table structure
                    // Add more fields as needed
                };

                dataToSave.push(rowData);
            }
            console.log(rowData);
            // Send data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save-staff-allocation.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server if needed
                    console.log("res " + xhr.responseText);
                    alert("Succesfully Saved Data.");
                    window.location.href = 'staffAllocation.php';
                }
            };

            xhr.send(JSON.stringify(dataToSave));
        }
    </script>
</body>

</html>