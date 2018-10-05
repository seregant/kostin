<!DOCTYPE html>
<html>
	<?php include('back_office/header.php'); ?>
<body class="animsition">
    <div class="page-wrapper">
    	<?php include ('back_office/sidebar.php'); ?>
    	 <div class="page-container">
    	 	<?php include('back_office/topbar.php'); ?>

    	 	<?php 
		        if(!empty($_GET['module'])) {

		          $module=$_GET['module'];
                  $category = $_GET['category'];
		          include($category.'/'.$category."_".$module.'.php');
		        } else {

		          include('back_office/dashboard.php');
		        }

		    ?>
		    <?php include('back_office/footer.php'); ?>
    	 </div>

 <!-- Jquery JS-->
    <script src="template/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="template/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="template/vendor/slick/slick.min.js">
    </script>
    <script src="template/vendor/wow/wow.min.js"></script>
    <script src="template/vendor/animsition/animsition.min.js"></script>
    <script src="template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="template/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="template/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="template/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="template/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="template/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="template/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="template/js/main.js"></script>
</body>
</html>