<!DOCTYPE html>
<html>
	<?php include('header.php'); ?>
<body class="animsition">
    <div class="page-wrapper">
    	<?php include ('sidebar.php'); ?>
    	 <div class="page-container">
    	 	<?php include('topbar.php'); ?>


        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

    	 	<?php 
		        if(!empty($_GET['get'])) {
                    $module=$_GET['get'];
                    $category = $_GET['category'];
                    include($category.'/'.$category."_".$module.'.php');
		        } else {

		          include('dashboard.php');
		        }

		    ?>
		    <?php include('footer.php'); ?>
    	 </div>

        </div>
    </div>
</div>


 <!-- Jquery JS-->
    <script src="frontend/userDashboard/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="frontend/userDashboard/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="frontend/userDashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="frontend/userDashboard/vendor/slick/slick.min.js">
    </script>
    <script src="frontend/userDashboard/vendor/wow/wow.min.js"></script>
    <script src="frontend/userDashboard/vendor/animsition/animsition.min.js"></script>
    <script src="frontend/userDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="frontend/userDashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="frontend/userDashboard/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="frontend/userDashboard/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="frontend/userDashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="frontend/userDashboard/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="frontend/userDashboard/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="frontend/userDashboard/js/main.js"></script>
    <script src="frontend/userDashboard/js/myScript.js"></script>
</body>
</html>