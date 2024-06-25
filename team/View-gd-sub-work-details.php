<?php
ob_start();
session_start();

if (!isset($_SESSION['empname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['empname']);
    header("location: signin.php");
}

include "includes/connection.php";
function showworklist()
{
    global $connection;
    $query = "select * from staff_dm_graphics_allocation where staffid='" . $_SESSION['empid'] . "' order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_orderid = $row['orderid'];
        $queryorder = "select * from order_customers where id='" .  $post_orderid . "' and order_status='Active'";
        $select_postsorder = mysqli_query($connection, $queryorder);
        while ($roworder = mysqli_fetch_assoc($select_postsorder)) {

            $post_brandName = $roworder['brandName'];
            $post_postings = $row['postings'];
            $post_content = $row['content'];
            $post_idea = $row['posteridea'];
            $post_assigndate = $row['assigndate'];
            $post_redirectstatus = $row['redirect_status'];
            $post_assignstaffid = $row['assigned_staffid'];

            $queryemp = "select * from employee where id='" .  $post_assignstaffid . "'";
            $select_postsemp = mysqli_query($connection, $queryemp);
            while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                $post_empname = $rowemp['empname'];
            }
            $queryemp = "select * from employee where id='" .  $_SESSION['empid'] . "'";
            $select_postsemp = mysqli_query($connection, $queryemp);
            while ($rowemp = mysqli_fetch_assoc($select_postsemp)) {
                $post_hod = $rowemp['hod'];
            }

            $post_workstatus = $row['work_status'];

            $i = $i + 1;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$post_brandName</td>";
            echo "<td>$post_postings</td>";
            // echo "<td>$post_content</td>";
            // echo "<td>$post_idea</td>";
            echo "<td>$post_empname</td>";
            echo "<td>$post_assigndate</td>";

            if ($post_workstatus === 'Active') {
                echo "<td><span class='badge bg-success' style='font-size:15px'>$post_workstatus</span></td>";
            }
            if ($post_workstatus === 'Closed') {
                echo "<td><span class='badge bg-danger' style='font-size:15px'>$post_workstatus</span></td>";
            }

            if ($post_redirectstatus === 'Self') {
                echo "<td ><span class='badge bg-secondary' style='font-size:15px'>$post_redirectstatus</span></td>";
            }
            if ($post_redirectstatus === 'Redirected') {
                echo "<td ><span class='badge bg-danger' style='font-size:15px'>$post_redirectstatus</span></td>";
            }

            echo "<td>";
            if ($post_redirectstatus === 'Self') {
                echo "<a class='btn btn-sm btn-blue' href='add-gd-work-details.php?workid={$id}' title='Enter Work Details' style='color:white;font: weight 200px;'>
        <span class='fe fe-edit'> </span></a> &nbsp;";
            }
            if ($post_hod === "Yes") {
                echo "<a class='btn btn-sm btn-yellow redirect-details-btn'   data-bs-target='#staffmodal' data-bs-toggle='modal' data-recordid={$id} title='Redirect work' style='color:white;font: weight 200px;'>
        <span class='fe fe-arrow-right-circle'> </span></a> &nbsp";
            }
            echo "<a class='btn btn-sm btn-gray-dark  view-details-btn' href='View-gd-work-details.php?workid={$id}'   data-recordid={$id} title='View work Details' style='color:white;font: weight 200px;'>
            <span class='fe fe-eye'> </span></a>";
            //     echo "<a class='btn btn-sm btn-gray-dark  view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id} title='View work Details' style='color:white;font: weight 200px;'>
            // <span class='fe fe-eye'> </span></a>";
            echo "</td>";



            echo "</tr>";
        }
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
        .form-label {
            font-weight: bold;
        }
    </style>
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

                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row mt-200">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Works</h6>
                                        <p class="text-muted card-sub-title"><?php echo $_SESSION['empname'] ?> , View Contents assigned by Digital Marketers.</p>
                                    </div>

                                    <div class="row">
                                        <?php
                                        if (isset($_GET['workid'])) {
                                            $the_cat_id = $_GET['workid'];

                                            $query = "select * from staff_dm_graphics_allocation WHERE id = {$the_cat_id}";
                                            $select_edits = mysqli_query($connection, $query);

                                            while ($row1 = mysqli_fetch_assoc($select_edits)) {
  // redirect_recordid
  $redirect_recordid =$row1['redirect_recordid'];


                                        ?>
                                                <div class="col-md-7">
                                                    <div class="col-md-12" style="padding-bottom: 25px;">
                                                        <label class="form-label" for="postercontent">Poster Content :</label>
                                                        <textarea class="form-control" name="postercontent" id="postercontent" rows="5" readonly> <?php echo $row1['content'] ?></textarea>
                                                    </div>
                                                    <div class="col-md-12 " style="padding-bottom: 25px;">
                                                        <label class="form-label" for="posteridea">Poster Idea :</label>
                                                        <textarea class="form-control" name="posteridea" id="posteridea" rows="5" readonly>  <?php echo $row1['posteridea'] ?></textarea>
                                                    </div>
                                                   
                                                        <div class="col-md-12">
                                                            <label class="form-label" for="pdeadline">Deadline Assigned by DM:</label>
                                                            <input class="form-control" type="text" id="pdeadline" name="pdeadline" value=" <?php echo $row1['deadline'] ?>" readonly>
                                                        </div>
                                                        
                                                    
                                                </div>
                                                <!-- =============================================== -->
                                                <div class="col-md-5">
                                                    <?php
                                                    
                                                      

                                                        $querynew = "select * from staff_dm_graphics_images WHERE allocation_id = {$redirect_recordid}";
                                                        $select_editsnew = $connection->query($querynew);

                                                        if ($select_editsnew->num_rows > 0) {
                                                            echo "<span class='form-label'>Click on the image to enlarge it</span>";
                                                            echo "<ul id='lightgallery' class='list-unstyled row mb-0'>";
                                                            while ($rownew = $select_editsnew->fetch_assoc()) {


                                                    ?>




                                                                <li class="col-xs-6 col-sm-6 col-md-6 col-xl-3 mb-3 ps-sm-2 pe-sm-2" data-responsive="<?php echo $rownew['file_name'] ?>" data-src="<?php echo $rownew['file_name'] ?>">
                                                                    <a href="javascript:void(0);">
                                                                        <img class="img-responsive br-3" src="<?php echo $rownew['file_name'] ?>" alt="Thumb-1">
                                                                    </a>
                                                                </li>


                                                    <?php }
                                                            echo "</ul>";
                                                        }
                                                  ?>
                                                </div>
                                                <!-- ========================================= -->

                                        <?php }
                                        } ?>
                                        <!-- </div> -->
                                        <div class="col-md-12">
                                            <a href="gdsubworklist.php" class="btn btn-primary float-end" style="width:200px" id="cancel">Discard</a>
                                        </div>
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
        <!-- Basic modal -->





        <!-- End Basic modal -->

        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->

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

    <!-- Gallery js-->
    <script src="../assets/plugins/gallery/picturefill.js"></script>
    <script src="../assets/plugins/gallery/lightgallery.js"></script>
    <script src="../assets/plugins/gallery/lightgallery-1.js"></script>
    <script src="../assets/plugins/gallery/lg-pager.js"></script>
    <script src="../assets/plugins/gallery/lg-autoplay.js"></script>
    <script src="../assets/plugins/gallery/lg-fullscreen.js"></script>
    <script src="../assets/plugins/gallery/lg-zoom.js"></script>
    <script src="../assets/plugins/gallery/lg-hash.js"></script>
    <script src="../assets/plugins/gallery/lg-share.js"></script>



    <!-- Perfect-scrollbar js-->
    <script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="../assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="../assets/plugins/sidebar/sidebar.js"></script>

    <!-- Sticky js-->
    <script src="../assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="../assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="../assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>
    <script src="notification.js"></script>


</body>

</html>