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
function showorderlist()
{
    global $connection;
    $done_splitup = "0";
    $query = "select * from order_customers where order_status='Active' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $done_splitup = "0";
        $id = $row['id'];
        $post_custName = $row['custName'];
        $post_brandName = $row['brandName'];

        $post_quotedAmt = $row['quotedAmt'];
        // $post_modified = $row['modified'];
        $post_custPhone = $row['custPhone'];
        $post_custEmail = $row['custEmail'];

        $sql = "SELECT * FROM quote_splitup WHERE orderid = $id";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $done_splitup = "1";
        }

        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_custName</td>";
        echo "<td>$post_brandName</td>";
        echo "<td>$post_custPhone</td>";
        echo "<td>$post_custEmail</td>";
        echo "<td>$post_quotedAmt</td>";
        if ($done_splitup == "0") {
            echo "<td><a data-bs-target='#modaldemo1' data-bs-toggle='modal' data-effect='effect-slide-in-right'
                href='javascript:void(0);' id='quoteSplit-{$id}' data-quoteid='{$id}' 
                data-custname='{$post_custName}' data-brandname='{$post_brandName}'  data-quotedamt='{$post_quotedAmt}'
                style='font-size:15px;color:white;'><button class='btn btn-indigo' >Itemized Quote</button></a></td>";
        } else {
            echo "<td><a href='javascript:void(0);' style='font-size:15px;color:white;'><button class='btn btn-secondary' >Quote Splitup Done</button></a></td>";
        }

        echo "<td>
        <a class='btn btn-sm btn-warning' href='#' title='View' style='color:white' onclick='checkRecordAndOpenModal(" . $id . ", \"view\", \"". $post_custName . "\", \"" . $post_brandName . "\", \"" . $post_quotedAmt . "\")'>
            <span class='fe fe-eye'></span>
        </a>&nbsp;
        <a class='btn btn-sm btn-success' href='#' title='Edit' style='color:white' onclick='checkRecordAndOpenModal(" . $id . ", \"edit\", \"". $post_custName . "\", \"" . $post_brandName . "\", \"" . $post_quotedAmt . "\")'>
            <span class='fe fe-edit'></span>
        </a>&nbsp;
        <a class='btn btn-sm btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='quote_splitup.php?delete={$id}' class='text-inverse' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
            <span class='fe fe-trash-2'></span>
        </a>
        </td>";
        // echo "<td><a class='btn btn-sm btn-warning' href='view-staff-allocation.php?edit={$id}' title='View' style='color:white'>
        // <span class='fe fe-eye'> </span></a>&nbsp;<a class='btn btn-sm btn-success' href='edit-staff-allocation.php?edit={$id}' title='Edit' style='color:white'>
        // <span class='fe fe-edit'> </span></a>&nbsp;<a class='btn btn-sm btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='quote_splitup.php?delete={$id}' class='text-inverse' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
        // <span class='fe fe-trash-2'> </span></a>
        // </td>";

        echo "</tr>";
    }
}

function deletesplitup()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM quote_splitup WHERE orderid = '" . $the_cat_id . "'";
        $delete_query = mysqli_query($connection, $query);
        if (!$delete_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }


        header("Location: quote_splitup.php");
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
                            <h2 class="main-content-title tx-24 mg-b-5">Quotation Splitup</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Splitup Quotation</li>
                            </ol>
                        </div>
                        <div class="btn-list">

                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">Order List</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example3">
                                            <thead>
                                                <tr>
                                                    <th class="wd-1p">#</th>
                                                    <th class="wd-15p">Customer Name</th>
                                                    <th class="wd-15p">Brand Name</th>
                                                    <th class="wd-5p">Phone no</th>
                                                    <th class="wd-10p">Emailid</th>
                                                    <th class="wd-5p">Amount Quoted</th>
                                                    <th class="wd-15p">Quotation Splitup</th>
                                                    <th class="wd-15p">Action</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showorderlist();
                                                ?>
                                                <?php
                                                deletesplitup();
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->


                </div>
            </div>
        </div>
        <!-- End Main Content-->


        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->
        <!-- ************* add modal ****************** -->
        <div class="modal fade" id="modaldemo1">
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
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Customer Name :</label>
                                <input class="form-control" type="text" id="custname" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Brand Name :</label>
                                <input class="form-control" type="text" id="brandname" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Quoted Amount</label>
                                <input class="form-control" type="text" id="quoteamt" value="" readonly>
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

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                            </tr>

                                        </tbody>
                                    </table>
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
        </div>
          <!-- ************* edit modal ****************** -->
          <div class="modal fade" id="modaldemo2">
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
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Customer Name :</label>
                                <input class="form-control" type="text" id="custname" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Brand Name :</label>
                                <input class="form-control" type="text" id="brandname" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Quoted Amount</label>
                                <input class="form-control" type="text" id="quoteamt" value="" readonly>
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

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                            </tr>

                                        </tbody>
                                    </table>
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
        </div>
         <!-- ************* view modal ****************** -->
        <div class="modal fade" id="modaldemo3">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Detailed Estimate</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Order ID :</label>
                                <input class="form-control" type="text" id="viewquoteid" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Customer Name :</label>
                                <input class="form-control" type="text" id="viewcustname" value="" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="dept">Brand Name :</label>
                                <input class="form-control" type="text" id="viewbrandname" value="" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="dept">Quoted Amount</label>
                                <input class="form-control" type="text" id="viewquoteamt" value="" readonly>
                            </div>



                        </div><br>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mg-b-0" id="vieworderTable">
                                        <thead>
                                            <tr style="background-color: lightblue;">
                                                <th>#</th>
                                                <th>Item ID</th>
                                                <th>Item Name</th>
                                                <th>Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Joan Powell</td>
                                                <td>Associate Developer</td>
                                                <td>$450,870</td>
                                            </tr>

                                        </tbody>
                                    </table>
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
        </div>
        <!-- ******************************************************************** -->
        <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

        <!-- Jquery js-->
        <script src="../assets/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap js-->
        <script src="../assets/plugins/bootstrap/popper.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Select2 js-->
        <script src="../assets/plugins/select2/js/select2.min.js"></script>

        <!-- DATA TABLE JS-->
        <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
        <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="../assets/js/table-data.js"></script>
        <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
        <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
        <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>

        <!-- Perfect-scrollbar js-->
        <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

        <!-- Sidemenu js-->
        <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

        <!-- Sidebar js-->
        <script src="../assets/plugins/sidebar/sidebar.js"></script>

        <!-- Sticky js-->
        <script src="../assets/js/sticky.js"></script>
        <!-- Select2 js-->
        <script src="../assets/plugins/select2/js/select2.min.js"></script>
        <script src="../assets/js/select2.js"></script>
        <!-- Custom-Switcher js -->
        <script src="../assets/js/custom-switcher.js"></script>

        <!-- Custom js-->
        <script src="../assets/js/custom.js"></script>

        <!-- Switcher js -->
        <script src="../assets/switcher/js/switcher.js"></script>
        <script>
            function confirmationDelete(anchor) {
                var conf = confirm('Are you sure want to delete this record?');
                if (conf)
                    window.location = anchor.attr("href");
            }
        </script>
        <script>
            $(document).ready(function() {
                // Attach click event to the element with id 'quoteSplit'
                $('[id^="quoteSplit-"]').on('click', function() {
                    // Access the value of the data attribute 'data_quoteid'
                    var quoteIdValue = $(this).data('quoteid');
                    $('#quoteid').val(quoteIdValue);
                    var custName = $(this).data('custname');

                    $('#custname').val(custName);
                    var brandName = $(this).data('brandname');

                    $('#brandname').val(brandName);
                    var quoteAmt = $(this).data('quotedamt');

                    $('#quoteamt').val(quoteAmt);
                    // Your code to be executed when the element is clicked
                    // alert('Element with id "quoteSplit" clicked! Data Quote ID: ' + quoteIdValue);
                    // Fetch data from the server using AJAX (you may need to adjust the URL)
                    $.ajax({
                        url: 'quotation_details.php',
                        method: 'POST',
                        data: {
                            order_id: quoteIdValue
                        },
                        success: function(data) {
                            // Populate the table body with the fetched data
                            $('#orderTable tbody').html(data);
                        },
                        error: function() {
                            alert('Error fetching data from the server.');
                        }
                    });
                });

                $('.numeric-column').on('input', function() {
                    // Remove non-numeric characters
                    var currentValue = $(this).text().replace(/[^0-9]/g, '');

                    // Update the content with the numeric value
                    $(this).text(currentValue);
                });

                $('#saveChangesBtn').on('click', function() {
                    // Calculate the total amount entered in the numeric column
                    var totalAmount = 0;
                    $('.numeric-column').each(function() {
                        var numericValue = parseInt($(this).text()) || 0;
                        totalAmount += numericValue;
                    });

                    // Get the value from the quoteamt input
                    var quoteAmount = parseInt($('#quoteamt').val()) || 0;
                    var quoteId = $('#quoteid').val();
                    // Compare the total amount with quoteAmount
                    if (totalAmount > quoteAmount) {
                        alert('Total amount entered exceeds the Quoted Amount!');
                    } else {
                        // alert('Total amount is within the Quoted Amount.');

                        // Save data to the server (replace this with your actual AJAX call)
                        var tableData = [];
                        var tablechk=0;
                        $('#orderTable tbody tr').each(function() {
                            var priceValue = $(this).find('td:eq(3)').text().trim();
                            if (priceValue !== "") {
                                tablechk=1;
                            var rowData = {
                                itemId: $(this).find('td:nth-child(2)').text(),
                                itemName: $(this).find('td:nth-child(3)').text(),
                                price: $(this).find('td:nth-child(4)').text()
                            };
                            tableData.push(rowData);
                        }
                        });
                       if ( tablechk == 1 ){
                        // Send the data to the server using AJAX
                        $.ajax({
                            url: 'quote_splitup_save.php',
                            method: 'POST',
                            data: {
                                quoteId: quoteId,
                                tableData: JSON.stringify(tableData)
                            },
                            success: function(response) {
                                console.log('Data saved successfully:', response); +
                                alert('Data saved successfully:');
                                $('#modaldemo1').modal('hide');
                                window.location.href="quote_splitup.php";
                            },
                            error: function() {
                                console.error('Error saving data to the server.');
                                alert(response);
                            }
                        });
                     } else {
                        alert("Enter Itemwise Price ");
                    }



                    }
                });





            });



            function checkRecordAndOpenModal(recordId, action, custname, brandname, qutamt) {
                // Send an AJAX request to check if the record exists
                $.ajax({
                    url: 'quotation_splitup_check.php',
                    method: 'POST',
                    data: {
                        recordId: recordId 
                    },
                    success: function(response) {
                        // alert (response);
                       
                        if (response.trim() === 'exists') {
                            // Record exists, open the modal or navigate to edit page
                            if (action === 'view') {
                                // Open the view modal
                                $('#viewquoteid').val(recordId);
                                $('#viewcustname').val(custname);
                                $('#viewbrandname').val(brandname);
                                $('#viewquoteamt').val(qutamt);


                                $.ajax({
                                    url: 'quotation_details_view.php',
                                    method: 'POST',
                                    data: {
                                        order_id: recordId
                                    },
                                    success: function(data) {
                                        // Populate the table body with the fetched data
                                        $('#vieworderTable tbody').html(data);
                                        $('#modaldemo3').modal('show');
                                    },
                                    error: function() {
                                        alert('Error fetching data from the server.');
                                    }
                                });


                                
                            } else if (action === 'edit') {
                                // Redirect to the edit page
                                window.location.href = 'edit-staff-allocation.php?edit=' + recordId;
                            }
                        } else {
                            // Record doesn't exist, show an alert
                            alert('Record does not exist.');
                        }
                    },
                    error: function() {
                        // Handle AJAX error
                        alert('Error checking record existence.');
                    }
                });
            }
        </script>
</body>

</html>