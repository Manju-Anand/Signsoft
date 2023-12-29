<?php include('server.php') ?>
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

	<body class="main-body ltr login-img" style="background: url('../assets/img/login/adminlogin.jpg') no-repeat center center fixed; background-size: cover; margin: 0; padding: 0; font-family: 'Arial', sans-serif; color: #333;">


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
                        <a  href="index.php">
                            <img src="../assets/img/SLogoBlue.png" class="header-brand-img" alt="logo">
                            <img src="../assets/img/SLogoBlue.png" class="header-brand-img theme-logos" alt="logo">
                        </a>
					</div>
					<div class="card custom-card">
						<div class="card-body pd-45">
							<h4 class="text-center">Signin to SignSoft</h4>
							<form method="post" ction="signin.php">
                            <?php include('errors.php'); ?> 
								<div class="form-group text-start">
									<label>Email</label>
									<input class="form-control" placeholder="Enter your email" name="email" id="email" type="text">
								</div>
								<div class="form-group text-start">
									<label>Password</label>
									<input class="form-control" placeholder="Enter your password"  name="password" id="password" type="password">
								</div>
							    <button type="submit" class="btn ripple btn-main-primary btn-block" name="login_user">Sign In</button>
											
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

	</body>
</html>
