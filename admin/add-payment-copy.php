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
                            <h2 class="main-content-title tx-24 mg-b-5">Add Payment</h2>
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
                                                    <br /><br />
                                                    <hr>
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
                                                            <option value="Bank-Transfer">Bank Transfer</option>
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
                                                            <option value="Advance-Payment">Advance Payment</option>
                                                            <option value="Intrim-Payment">Intrim Payment</option>
                                                            <option value="Final-Payment">Final Payment</option>

                                                        </select>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <label class="form-label" for="paymenttransmode">Transaction Mode :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="paymenttransmode" id="paymenttransmode" required>
                                                            <option value="" disabled selected>Select Transaction Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Card">Card</option>
                                                            <option value="UPI">UPI</option>
                                                            <option value="Bank-Transfer">Bank Transfer</option>
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
            // Get the selected values from the first two select boxes
            var selectBox1 = document.getElementById("orders").value;
            var selectBox2 = document.getElementById("supplier").value;

            // Check if both select boxes are selected
            // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
            if (selectBox1 === "" || selectBox2 === "") {
                alert("Please select values for the orders & suppliers.");
                return; // Exit the function if not selected
            }
            var table = document.getElementById("dataTable");
            var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
            var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody


            // Numbering Column
            var cell1 = newRow.insertCell(0);

            cell1.innerHTML = ++rowCounter; // Increment before setting the innerHTML

            // Select Box 1
            var cell2 = newRow.insertCell(1);
            var selectBox1 = document.getElementById("orders");
            cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

            // Select Box 2
            var cell3 = newRow.insertCell(2);
            var selectBox2 = document.getElementById("orders");
            cell3.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
            cell3.classList.add('hidden-cell');

            // Select Box 1
            var cell4 = newRow.insertCell(3);
            var selectBox1 = document.getElementById("supplier");
            cell4.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

            // Select Box 2
            var cell5 = newRow.insertCell(4);
            var selectBox2 = document.getElementById("supplier");
            cell5.innerHTML = selectBox2.options[selectBox2.selectedIndex].value;
            cell5.classList.add('hidden-cell');
            // Text Box 1
            var cell6 = newRow.insertCell(5);
            var textBox1 = document.getElementById("donework");
            cell6.innerHTML = textBox1.value;

            // Text Box 2
            var cell7 = newRow.insertCell(6);
            var textBox2 = document.getElementById("supbillno");
            cell7.innerHTML = textBox2.value;

            // Text Box 3
            var cell8 = newRow.insertCell(7);
            var textBox3 = document.getElementById("payamt");
            cell8.innerHTML = textBox3.value;
            cell8.style.textAlign = "right";
            // Text Box 3
            var cell9 = newRow.insertCell(8);
            var selectBox3 = document.getElementById("orders");
            cell9.innerHTML = selectBox3.options[selectBox3.selectedIndex].text;

            // Text Box 3
            var cell10 = newRow.insertCell(9);
            var textBox3 = document.getElementById("custbillno");
            cell10.innerHTML = textBox3.value;

            // Clear input values after adding to the table
            textBox1.value = "";
            textBox2.value = "";
            textBox3.value = "";
            // Clear select box values
            selectBox1.selectedIndex = -1;
            selectBox2.selectedIndex = -1;
            selectBox3.selectedIndex = -1;
        }

        // ==============================
        var rowpaymentCounter = 0; // Move the initialization here
        function addPayment() {
            // alert("payment");
            // Get the selected values from the first two select boxes
            var selectBox3 = document.getElementById("paytype").value;
            var selectBox4 = document.getElementById("paymenttransmode").value;
            // alert (selectBox3 );
            // alert (selectBox4 );
            // Check if both select boxes are selected
            // if (selectBox1.selectedIndex === -1 || selectBox2.selectedIndex === -1) {
            if (selectBox3 === "" || selectBox4 === "") {
                alert("Please select values for the Payment Type & Transaction Mode.");
                return; // Exit the function if not selected
            }
            var table = document.getElementById("paydataTable");
            var tbody = table.getElementsByTagName("tbody")[0]; // Get the tbody element
            var newRow = tbody.insertRow(tbody.rows.length); // Insert row into tbody


            // Numbering Column
            var cell1 = newRow.insertCell(0);

            cell1.innerHTML = ++rowpaymentCounter; // Increment before setting the innerHTML

            // Select Box 1
            var cell2 = newRow.insertCell(1);
            var selectBox1 = document.getElementById("paytype");
            cell2.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;

            // Select Box 1
            var cell3 = newRow.insertCell(2);
            var selectBox1 = document.getElementById("paymenttransmode");
            cell3.innerHTML = selectBox1.options[selectBox1.selectedIndex].text;


            // Text Box 1
            var cell4 = newRow.insertCell(3);
            var textBox1 = document.getElementById("paymentamt");
            cell4.innerHTML = textBox1.value;
            cell4.style.textAlign = "right";

            // Text Box 2
            var cell5 = newRow.insertCell(4);
            var textBox2 = document.getElementById("paycustbillno");
            cell5.innerHTML = textBox2.value;

            // Text Box 3

            // Clear input values after adding to the table
            textBox1.value = "";
            textBox2.value = "";

            // Clear select box values
            selectBox1.selectedIndex = -1;
            // selectBox2.selectedIndex = -1;

        }

        // ============================================
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
                    orderid: document.getElementById("orderiddisplay").value,
                    entry: cells[1].innerHTML, // Adjust the index based on your table structure
                    entryid: cells[2].innerHTML, // Adjust the index based on your table structure
                    SupplierName: cells[3].innerHTML, // Adjust the index based on your table structure
                    Supplierid: cells[4].innerHTML, // Adjust the index based on your table structure
                    workDone: cells[5].innerHTML, // Adjust the index based on your table structure
                    SupplierBillNo: cells[6].innerHTML, // Adjust the index based on your table structure
                    PaymentAmount: cells[7].innerHTML, // Adjust the index based on your table structure
                    TransactionMode: cells[8].innerHTML, // Adjust the index based on your table structure
                    CustomerBillNo: cells[9].innerHTML // Adjust the index based on your table structure
                    // Add more fields as needed
                };

                dataToSave.push(rowData);
            }
            console.log(rowData);
            // ============= second table

            var table1 = document.getElementById("paydataTable");
            var rows1 = table1.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
            console.log("hai   :" + rows1)
            var dataToSave1 = [];

            // Iterate through each row
            for (var i = 0; i < rows1.length; i++) {
                console.log(i);
                var row = rows1[i];
                var cells = row.getElementsByTagName("td");

                var rowData1 = {
                    orderid: document.getElementById("orderiddisplay").value,
                    PaymentType: cells[1].innerHTML, // Adjust the index based on your table structure
                    TransactionMode: cells[2].innerHTML, // Adjust the index based on your table structure
                    PaymentAmount: cells[3].innerHTML, // Adjust the index based on your table structure
                    CustomerBillNo: cells[4].innerHTML, // Adjust the index based on your table structure

                };

                dataToSave1.push(rowData1);
            }
            console.log(rowData1);
            // ==============================================
            // Combine the two arrays into a single object for the AJAX request
            var combinedData = {
                dataToSave: dataToSave,
                dataToSave1: dataToSave1
            };

            // Send data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "save-paymentdetails.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        // Handle the response from the server if needed
                        console.log("res " + xhr.responseText);
                        alert("Succesfully Saved Data.");
                        window.location.href = 'add-payment.php';
                    } else {
                        // Handle errors if any
                        console.error("Error saving data: " + xhr.status);
                        alert("Error saving data. Please try again.");
                    }
                }
            };

            xhr.send(JSON.stringify(combinedData));
        }
    </script>

    <script>
        // Add an event listener to the select element
        document.getElementById('ordersdisplay').addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];

            // Get the values from the selected option
            var selectedOrderId = selectedOption.value;
            var selectedbrandName = selectedOption.getAttribute('data-brandName');
            var selectedquoteAmt = selectedOption.getAttribute('data-quotedAmt');
            // Update other input tags with the selected values
            document.getElementById('amountdisplay').value = selectedquoteAmt;
            document.getElementById('branddisplay').value = selectedbrandName;
            document.getElementById('orderiddisplay').value = selectedOrderId;
            // Fetch data for the second select using AJAX
            $.ajax({
                type: 'POST',
                url: 'getorderdetails.php', // Replace with the actual URL that fetches data based on selectedOrderId
                data: {
                    selectedOrderId: selectedOrderId
                },
                success: function(data) {
                    // Update options of the second select
                    $('#orders').html(data);
                }
            });
        });
    </script>
</body>

</html>