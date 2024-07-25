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
                            <h2 class="main-content-title tx-24 mg-b-5" style="color:brown;text-transform:uppercase; text-decoration: underline;">View & Close Order</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment Details</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Closing Order Form</li>
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
                    <div class="card custom-card" id="success">
                        <div class="card-header rounded-bottom-0">
                            <h5 class="mt-2">View & Close Order</h5>
                        </div>
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs panel-success">
                                            <li><a href="#tab17" class="active" data-bs-toggle="tab"><span><i class="fe fe-book-open mx-1"></i></span>Order Details</a>
                                            </li>
                                            <li><a href="#tab18" data-bs-toggle="tab"><span><i class="fe fe-calendar mx-1"></i></span>Supplier Details</a>
                                            </li>
                                            <li><a href="#tab19" data-bs-toggle="tab"><span><i class="fe fe-dollar-sign mx-1"></i></span>Payment Details</a>
                                            </li>
                                            <li><a href="#tab20" data-bs-toggle="tab"><span><i class="fe fe-serverl mx-1"></i></span>Quotation Splitup</a>
                                            </li>
                                            <li><a href="#tab21" data-bs-toggle="tab"><span><i class="fe fe-user mx-1"></i></span>Staff Allocation</a>
                                            </li>
                                            <li><a href="#tab22" data-bs-toggle="tab"><span><i class="fe fe-phone-call mx-1"></i></span>Follow-Up History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab17">
                                            <form method="post">
                                                <div class="row mb-4">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="ordersdisplay">Orders :</label>
                                                        <select class="form-select mb-3" aria-label="Default select example" name="ordersdisplay" id="ordersdisplay" required>
                                                            <option value="" disabled selected>Select Order Entry</option>
                                                            <?php
                                                            $queryorder = "select * from order_customers where order_status='Active' and ordertype='External' order by id desc";
                                                            $select_postsorder = mysqli_query($connection, $queryorder);
                                                            while ($roworder = mysqli_fetch_assoc($select_postsorder)) {
                                                                $mainorderid = $roworder['id'];
                                                            ?>
                                                                <option value="<?php echo $roworder['id'] ?>" data-brandName="<?php echo $roworder['brandName'] ?>" data-quotedAmt="<?php echo $roworder['quotedAmt'] ?>"><?php echo $roworder['custName'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">

                                                
                                                   
                                                    <div class="col-lg-6">
                                                        <div class="expanel expanel-secondary">
                                                            <div class="expanel-heading">
                                                                <h3 class="expanel-title">Order Closing Details</h3>
                                                            </div>
                                                            <div class="expanel-body">
                                                                <div class="row">
                                                                    <div class="col-md-3"> <label class="form-label" for="status">Close Order :</label></div>
                                                                    <div class="col-md-9">
                                                                        <select name="status" id="status" class="form-control form-select select2" style="margin: bottom 20px;" data-bs-placeholder="Select Status" required>
                                                                            <option value="" disabled selected>Select Option</option>
                                                                            <option value="Close">Close</option>
                                                                            <option value="Renew-Order">Renew Order</option>
                                                                        </select>
                                                                    </div>
                                                                </div><br>
                                                                <div class="row">
                                                                    <div class="col-md-5"><label class="form-label" for="greview">Received Google Reviews? </label></div>
                                                                    <div class="col-md-7"><input type="checkbox" id="greview" name="greview"></div>
                                                                </div><br>
                                                                <!-- <div class="row">
                                                                    <div class="col-md-3"><label class="form-label" for="cquality">Client Quality :</label></div>
                                                                    <div class="col-md-9"><select name="cquality" id="cquality" class="form-control form-select select2" data-bs-placeholder="Select Status" required>
                                                                            <option value="" disabled selected>Select Option</option>
                                                                            <option value="Good">Good</option>
                                                                            <option value="Average">Average</option>
                                                                            <option value="Poor">Poor</option>
                                                                        </select>
                                                                    </div>

                                                                </div><br> -->
                                                                <div class="row">
                                                                    <div class="col-md-3"> <label class="form-label" for="notes">Notes if Any :</label></div>

                                                                    <div class="col-md-9">  
                                                                        <textarea class="form-control" name="notes" id="notes" palceholder="Here notes" rows="4"></textarea>
                                                                    </div>
                                                                </div>
                                                               
                                                                
                                                                
                                                                
                                                                
                                                                
                                                               

                                                              
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="expanel expanel-primary">
                                                            <div class="expanel-heading">
                                                                <h3 class="expanel-title">Order Details</h3>
                                                            </div>
                                                            <div class="expanel-body"  id="orderdetails">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                               

                                                    
                                                  
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <button type="submit" name="submit" class="btn btn-primary float-end" style="color:white;cursor:pointer;">Close Order</button>
                                                        <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                                        <!-- float-end -->

                                                    </div>
                                                </div>
<?php
if (isset($_POST['submit'])) {
    $closestatus = "false";
    $supplierstatus = "false";
    $paymentstatus = "false";
    $monthlyreportstatus = "false";

    $orderstatus = $_POST["status"];
    if ($orderstatus !== null) {
        $orderclosed = "Closed";
        $cquality = $_POST['cquality'];
        $quoteamt =$_POST['quoteamt'];
        $orderid = $_POST['ordersdisplay'];
        $statusreason = $_POST["notes"];

        date_default_timezone_set("Asia/Calcutta");
        $postdate = date("M d,Y h:i:s a");

        $sql = "SELECT * FROM payment_supplier where orderid='" . $orderid . "'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['transaction_mode'] !== 'CASH') {
                    if ($row['supplier_billno'] !== '' ) {
                        // echo "suppliertrue";
                        $supplierstatus = "true";
                        $closestatus = "true";
                    } else {
                        // echo "supplierfalse";
                        $supplierstatus = "false";
                        $closestatus = "false";
                        goto pc;
                    }
                    if ( $row['customer_billno'] !== '') {
                        // echo "suppliertrue";
                        $supplierstatus = "true";
                        $closestatus = "true";
                    } else {
                        // echo "supplierfalse";
                        $supplierstatus = "false";
                        $closestatus = "false";
                        goto pc;
                    }
                }
            }
        }
        pc:
        $sql = "SELECT * FROM payment_customer where orderid='" . $orderid . "'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['transaction_mode'] !== 'CASH') {
                    if ($row['customer_billno'] !== '') {
                        // echo "custtrue";
                        $paymentstatus = "true";
                        $closestatus = "true";
                    } else {
                        // echo "custfalse";
                        $paymentstatus = "false";
                        $closestatus = "false";
                        goto ppc;
                    }
                }
            }
        }
        ppc:


        // ===================================================== if order dtails contain DM works, then after submitting monthly report renewal process should work.===========
        $queryorder = "select * from order_customers where id = '" . $orderid . "'";
        $select_postsorder = mysqli_query($connection, $queryorder);
        while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

            $mainorderid = $roworder['id'];
            $dmorder = "false";
            $querydigital = "select * from category where dept_id=(select id from department where dname='Digital')";
            $select_postsdigital = mysqli_query($connection, $querydigital);
            while ($rowdigital = mysqli_fetch_assoc($select_postsdigital)) {
                $catId = $rowdigital['id'];



                $queryordercat = "select * from order_category where order_id='" . $roworder['id'] . "' and category_id='" . $catId . "'";
                $select_postsordercat = mysqli_query($connection, $queryordercat);
                while ($rowordercat = mysqli_fetch_assoc($select_postsordercat)) {
                    $categoryId = $rowordercat['category_id'];
                    $querydmallot = "select * from staff_dm_allocation where orderid='" . $roworder['id'] . "' and staffid='" .  $_SESSION['empid'] . "'";
                    $select_postsdmallot = mysqli_query($connection, $querydmallot);
                    while ($rowdmallot = mysqli_fetch_assoc($select_postsdmallot)) {
                        $dmorder = "true";
                    }
                }
            }

            if ($dmorder == "true") {
                $monthlyreportstatus = "true";
                $closestatus = "true";
            }else {
                // echo "custfalse";
                $monthlyreportstatus = "false";
                $closestatus = "false";
                goto ppc1;
            }
        }
ppc1:
        // =======================================================================================
        if ($closestatus == "false") {
                if( $monthlyreportstatus == "false"){
                    echo "<script> alert('Monthly Report Not Submitted.'); </script>";
                }

                if ( $paymentstatus == "false"){
                    echo "<script> alert('Order cannot be closed because there are missing billnos.'); </script>";
                }


        } else {
            // *************** transaction entry ****** based on $cquality ****************
            if ($cquality=="Good"){

                $actid="1";
                $actname="Signefo";

            }elseif ($cquality=="Average") {
                $actid="2";
                $actname="Signefo Media";
            }else {
                $actid="";
                $actname="";
            }
            $querycategory = "INSERT INTO transactions (orderid, action, actid, amount, add_date, created)
            VALUES('$orderid','Credited','$actid', '$quoteamt','$postdate','$postdate')";

            if ($connection->query($querycategory) === TRUE) {
            }

            $querycategory = "UPDATE order_customers SET order_status='Closed', close_date='" . $postdate . "' where id='" . $orderid . "'";

            if ($connection->query($querycategory) === TRUE) {
            }

            $querystaffdm = "UPDATE staff_dm_allocation SET work_status='Closed' where orderid='" . $orderid . "'";

            if ($connection->query($querystaffdm) === TRUE) {
            }

            $querystaffdm = "UPDATE staff_allocation SET work_status='Closed' where orderid='" . $orderid . "'";

            if ($connection->query($querystaffdm) === TRUE) {
            }


            $querycategory = "INSERT INTO order_tracking (order_id, status, status_date, notes)
            VALUES('$orderid', '$orderclosed','$postdate','$statusreason')";

            if ($connection->query($querycategory) === TRUE) {
            }
            if ($orderstatus = "Renew-Order") {
                $sqlneworder = "SELECT * FROM order_customers where id='" . $orderid . "'";
                $resultneworder = $connection->query($sqlneworder);

                if ($resultneworder->num_rows > 0) {
                    while ($rowneworder = $resultneworder->fetch_assoc()) {
                        $cusname = $rowneworder["custName"];
                        $brandname = $rowneworder["brandName"];

                        $addr = $rowneworder["addr"];
                        $phoneno = $rowneworder["custPhone"];
                        $emailid = $rowneworder["custEmail"];
                        $contacteddate = $rowneworder["contactDate"];
                        $contactedtime = $rowneworder["contactTime"];

                        $qutamt = $rowneworder["quotedAmt"];
                        $leadsource = $rowneworder["leadSource"];
                        $orderstatus = "Active";
                        $statusreason = $rowneworder["status_reason"];

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
                                                '" . mysqli_real_escape_string($connection, $_SESSION['adminempid']) . "','" . mysqli_real_escape_string($connection, $orderstatus) . "',
                                                '" . mysqli_real_escape_string($connection, $statusreason) . "')";
                                                if ($connection->query($sql) === TRUE) {
                                                    $last_lead_id = $connection->insert_id;
                                                    $sqlnewcat = "SELECT * FROM order_category where order_id='" . $orderid . "'";
                                                    $resultnewcat = $connection->query($sqlnewcat);
                                    
                                                    if ($resultnewcat->num_rows > 0) {
                                                        while ($rownewcat = $resultnewcat->fetch_assoc()) {
                                                            $catid = $rownewcat["category_id"];
                                                            $querycategory = "INSERT INTO order_category (order_id, category_id)
                                                            VALUES('$last_lead_id', '$catid')";
        
                                                            if ($connection->query($querycategory) === TRUE) {
                                                            }
                                                        }}
                                                        $sqlnewsubcat = "SELECT * FROM order_subcategory where order_id='" . $orderid . "'";
                                                        $resultnewsubcat = $connection->query($sqlnewsubcat);
                                        
                                                        if ($resultnewsubcat->num_rows > 0) {
                                                            while ($rownewsubcat = $resultnewsubcat->fetch_assoc()) {
                                                                $subcatid = $rownewsubcat["subcategory_id"];
                                                                $querycategory = "INSERT INTO order_subcategory (order_id, subcategory_id)
                                                                VALUES('$last_lead_id', '$subcatid')";
            
                                                                if ($connection->query($querycategory) === TRUE) {
                                                                }
                                                            }}
                                                            $sqlnewsubcat = "SELECT * FROM staff_dm_allocation where orderid='" . $orderid . "'";
                                                            $resultnewsubcat = $connection->query($sqlnewsubcat);
                                            
                                                            if ($resultnewsubcat->num_rows > 0) {
                                                                while ($rownewsubcat = $resultnewsubcat->fetch_assoc()) {

                                                                    $Payment = $rownewsubcat['payment'];
                                                                    $Postings = $rownewsubcat['postings'];
                                                                    $staffName = $rownewsubcat['staffname'];
                                                                    $staffid = $rownewsubcat['staffid'];
                                                                    $Frequency = $rownewsubcat['frequency'];
                                                                    // $StartDate = $rownewsubcat['StartDate'];
                                                                    $EndDate = $rownewsubcat['enddate'];

                                                                    $newDate = date("Y-m-d", strtotime($EndDate . " +1 month"));
                                                                    $promoamt = $rownewsubcat['promoamt'];
                                                                    $assigndate = $rownewsubcat['assigndate'];
                                                                    $recordstatus= "New";
                                                                    date_default_timezone_set("Asia/Calcutta");
                                                                    $postdate = date("M d,Y h:i:s a");
                                                                    $today = date("Y-m-d");
                                                                    $sql = "INSERT INTO staff_dm_allocation (orderid,payment,postings,staffname, staffid, frequency, startdate, enddate,promoamt,status,assigndate,created,work_status) VALUES
                                                                    ('$last_lead_id','$Payment','$Postings','$staffName', '$staffid', '$Frequency', '$EndDate', '$newDate', '$promoamt','$recordstatus','$today','$postdate','Active')";
                                                                    if ($connection->query($sql) !== TRUE) {
                                                                        
                                                                        echo "Error: " . $sql . "<br>" . $connection->error;
                                                                    }else {
                                                                        $last_id = $connection->insert_id;
                                                                    }
                                                                    // dm_reports adding
                                                                    $sql = "INSERT INTO dm_reports (orderid,dm_allot_id,dmreport_date,status,created,empid) VALUES
                                                                    ('$last_lead_id','$last_id', '$newDate', 'Not Done','$postdate','$staffid')";
                                                                    if ($connection->query($sql) !== TRUE) {
                                                                        echo "Error: " . $sql . "<br>" . $connection->error;
                                                                    }
                                                                    // dmevents adding
                                                                    $cDate =    $newDate;
                                                                    $estartDate = formatnewDate($cDate);
                                                                    $eendDate = addOneDay($cDate);
                                                                    $title=$brandname . " - Monthly report";
                                                                    $sql = "INSERT INTO dmevents (orderid,title,start_date,end_date,empid,dm_allotid) VALUES
                                                                    ('$last_lead_id','$title', '$estartDate', '$eendDate','$staffid','$last_id')";

                                                                        if ($connection->query($sql) !== TRUE) {
                                                                        echo "Error: " . $sql . "<br>" . $connection->error;
                                                                        }

                                                        }}






                                                      

                                                }

        

                    }

                }

            }



        }
    }
}
function formatnewDate($dateString)
{
  $date = new DateTime($dateString);
  return $date->format('Y-m-d');
}

function addOneDay($dateString)
{
  $date = new DateTime($dateString);
  $date->add(new DateInterval('P1D'));
  return $date->format('Y-m-d');
}
?>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="tab18">
                                            <div class="row mb-4">


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
                                                                <th>Date of Pay</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxsupplierresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab19">
                                            <div class="row mb-4">
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
                                                                <th>Date of Pay</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxpaymentresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab20">
                                            <div class="row mb-4">


                                                <div class="table-responsive">

                                                    <table class="table table-bordered mg-b-0" id="quotesplitupTable">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Item Name</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxquotesplitupresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab21">
                                            <div class="row mb-4">


                                                <div class="table-responsive">

                                                    <table class="table table-bordered mg-b-0" id="staffallocateTable">
                                                        <thead>
                                                            <tr style="background-color: #add8e6;">
                                                                <th>#</th>
                                                                <th>Category Assigned</th>
                                                                <th>Employee Name</th>
                                                                <th>Work Descripton</th>
                                                                <th>Dead Line</th>
                                                                <th>Percentage of Work</th>
                                                                <th>Assigned Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxstaffallocateresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab22">
                                            <div class="row mb-4">
											       
                                                <div class="table-responsive">
                                                    
                                                    <table class="table table-bordered mg-b-0" id="followupdataTable">
                                                        <thead>
                                                            <tr style="background-color:#add8e6;">
                                                                <th>#</th>
                                                                <th>Followup Date</th>
                                                                <th>Mode of Contact</th>
                                                                <th>Remarks</th>
                                                                

                                                            </tr>
                                                        </thead>
                                                        <tbody id="ajaxfollowupresults">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
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
    <script src="view-payment.js"></script>




</body>

</html>