<?php
ob_start();
session_start();

if (!isset($_SESSION['salesname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['salesname']);
    header("location: signin.php");
}

include "includes/connection.php";
function showleadlist()
{
    global $connection;
    $query = "select * from leads order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_custName= $row['custName'];
        $post_brandName = $row['brandName'];
        $post_created = $row['created'];
        $post_modified = $row['modified'];
        $post_custPhone = $row['custPhone'];
        $post_custEmail = $row['custEmail'];


        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_custName</td>";
        echo "<td>$post_brandName</td>";
        echo "<td>$post_custPhone</td>";
        echo "<td>$post_created</td>";
        echo "<td>$post_modified </td>";

        // echo "<td><a class='btn btn-sm btn-cyan' data-bs-target='#modaldemo3' data-bs-toggle='modal' href='javascript:void(0);' title='View' style='color:white'>
        // <span class='fe fe-eye'> </span> Add New Follow Ups</a></td>";

        echo "<td><a class='btn btn-sm btn-cyan modal-trigger' data-bs-target='#modaldemo3' data-bs-toggle='modal' data-value='$id' href='#' title='View' style='color:white'>
        <span class='fe fe-eye'> </span> Add New Follow Ups</a>
        </td>";

   

        echo "</tr>";
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
                            <h2 class="main-content-title tx-24 mg-b-5">Lead List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Leads</li>
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
                                        <h6 class="card-title mb-1">List of leads</h6>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p">#</th>
                                                    <th class="wd-15p">Customer Name</th>
                                                    <th class="wd-15p">Brand Name</th>
                                                    <th class="wd-15p">Phone no</th>
                                                    <th class="wd-18p">Created</th>
                                                    <th class="wd-18p">Modified</th>
                                                    <th class="wd-14p">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showleadlist();
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
            <!-- Large Modal -->
                <div class="modal fade" id="modaldemo3">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Large Modal</h6><button aria-label="Close" class="btn-close"
                                    data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <h6>Modal Body</h6>
                                <input type="text" id="modalInput">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-primary" type="button">Save changes</button>
                                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Large Modal -->
                <script>
// Get all modal-trigger elements
var modalTriggers = document.querySelectorAll('.modal-trigger');

// Get the modal element
var modal = document.getElementById('modaldemo3');

// Get the input element inside the modal
var modalInput = document.getElementById('modalInput');

// Attach click event listeners to each modal-trigger
modalTriggers.forEach(function(trigger) {
  trigger.addEventListener('click', function() {

    // Get the value from the data attribute
    var dataValue = trigger.getAttribute('data-value');
    
    // Set the input value in the modal
    modalInput.value = dataValue;

    // Display the modal
    modal.style.display = 'block';
  });
});

// Close the modal when the close button is clicked
// document.querySelector('.close').addEventListener('click', function() {
//   modal.style.display = 'none';
// });

// Close the modal if the user clicks outside the modal
window.addEventListener('click', function(event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});
</script>
            </div>
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

                function confirmationDelete(anchor)
                {
                var conf = confirm('Are you sure want to delete this record?');
                if(conf)
                    window.location=anchor.attr("href");
                }
            </script>
          
</body>

</html>