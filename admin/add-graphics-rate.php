<?php
session_start();
ob_start();
if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}
include "includes/connection.php";

$posterrate = 0;
$videorate = 0;
$gifrate = 0;

$query = "select * from graphics_masters";
$select_edits = mysqli_query($connection,$query);
while($row1 = mysqli_fetch_assoc($select_edits))
{
    $posterrate=$row1['poster'];
    $videorate=$row1['video'];
    $gifrate=$row1['gif'];
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
                            <h2 class="main-content-title tx-24 mg-b-5">Graphics Master</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Employee Masters</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Graphics</li>
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
                                    <div class="card-title">Graphics Master</div>
                                </div>
                                <form id="addcateg" method="post" action="">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label" for="poster">Poster Rate :</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="poster" id="poster" placeholder="Poster Rate" value="<?php echo $posterrate; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label" for="Video">Video Rate :</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="video" id="video" placeholder="Video Rate" value="<?php echo $videorate; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-md-3 form-label" for="gif">Gif Rate :</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="gif" id="gif" placeholder="Gif Rate" value="<?php echo $gifrate; ?>">
                                            </div>
                                        </div>
                                       

                                       
                                       




                                    </div>
                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" name="submit" class="btn btn-primary" style="color:white;cursor:pointer;">Add Master</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                    <?php
                                    if (isset($_POST['submit'])) {

                                        $sql = "DELETE FROM graphics_masters ";

                                        if ($connection->query($sql) === TRUE) {
                                          echo "Record deleted successfully";
                                        } else {
                                          echo "Error deleting record: " . $conn->error;
                                        }



                                        $poster = $_POST["poster"];
                                        $Video = $_POST["video"];
                                        $gif = $_POST["gif"];
                                       




                                        $sql = "INSERT INTO graphics_masters (poster,video,gif) values('" . mysqli_real_escape_string($connection, $poster) . "',
                                                        '" . mysqli_real_escape_string($connection, $Video) . "',
                                                        '" . mysqli_real_escape_string($connection, $gif) . "')";

                                        if ($connection->query($sql) === TRUE) {
                                            header("Location: add-graphics-rate.php");
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
    <script>
    $(document).ready(function(e){
        $('#cancel').delegate('','click change',function(){
        window.location = "index.php";
        return false;
    });
    });
    </script>
</body>

</html>
<?php ob_end_flush(); ?>