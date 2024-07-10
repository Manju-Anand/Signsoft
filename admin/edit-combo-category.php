<?php
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
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
                            <h2 class="main-content-title tx-24 mg-b-5">Edit Combo Category</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Employee Masters</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                                    <div class="card-title">Edit Combo Category</div>
                                </div>
                                <form id="addcateg" method="post" action="">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <label class="col-md-2 form-label" for="category">Category Name :</label>
                                            <div class="col-md-10">
                                            <select class="form-select mb-3" aria-label="Default select example" name="category" id="category" required>
                                                        <option value="" disabled selected>Select Category</option>
                                                    <?php
                                                        $query = "select DISTINCT category_id from combocategory";
                                                        $select_posts = mysqli_query($connection,$query);
                                                        while($row = mysqli_fetch_assoc($select_posts))
                                                        {
                                                            $querycat = "select * from category where id='" . $row['category_id'] . "'";
                                                        $select_postscat = mysqli_query($connection,$querycat);
                                                        while($rowcat = mysqli_fetch_assoc($select_postscat))
                                                        {

                                                    ?>
                                                            <option value="<?php echo $row['category_id'] ?>" data-questions="<?php echo $row['category_id'] ?>"><?php echo $rowcat['category'] ?></option>
                                                    <?php }} ?>
                                             </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4" id="ajaxresult">
                                            <label class="col-md-2 form-label" for="catesubcategorygory">Sub Category Name :</label>
                                            <div class="col-md-10">
                                            <select class="form-control select2"  multiple="multiple" name="subcategory[]" id="subcategory[]" required>
                                                      
                                                   
                                             </select>
                                            </div>
                                        </div>
                                 

                                     




                                    </div>
                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Update Combo Category</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $category = $_POST["category"];
                                        date_default_timezone_set("Asia/Calcutta");
                                        $postdate = date("M d,Y h:i:s a");

                                        $query = "DELETE FROM combocategory WHERE category_id = '" . $category . "'";
                                        $delete_query = mysqli_query($connection, $query);
                                        if (!$delete_query) {
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                




                                        if (isset($_POST['subcategory'])) {
                                            $selectedOptions = $_POST['subcategory'];
                                            // echo $selectedOptions ;

                                            // Loop through selected options and insert into the database
                                            foreach ($selectedOptions as $subcategoryId) {

                                                $sql = "INSERT INTO combocategory (category_id,subcategory_id,created) values('" . mysqli_real_escape_string($connection, $category) . "',
                                                                '" . mysqli_real_escape_string($connection, $subcategoryId) . "',
                                                                '" . mysqli_real_escape_string($connection, $postdate) . "')";

                                                if ($connection->query($sql) === TRUE) {
                                                    header("Location: combocategorylist.php");
                                                } else {
                                                    echo "Error:ans1 " . $sql . "<br>" . $connection->error;
                                                }
                                            }}
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
    <script>
    $(document).ready(function(e){
        $('#cancel').delegate('','click change',function(){
        window.location = "combocategorylist.php";
        return false;
    });


    $("#category").on("change", function() {
            var fname = $(this).find(":selected").attr("data-questions");
            $.ajax({
                type: "POST",
                url: "ajaxcombosubcategory.php",
                data: "fname=" + fname,
                success: function(data) {
                    $('#ajaxresult').html(data);
                }
            });
        });
    });
    </script>
</body>

</html>