<?php
	include ('config/database.php');
	include ('module/data_login.php');
	include ('module/data_get.php');
	if(isset($_POST['username'],$_POST['password'])){
		$passHash = md5($_POST['password']);
		$validation = userDataValidation($_POST['username'],$passHash);

		if(strcasecmp($validation, "true")==0){
			$userData = getUserData($_POST['username']);
			$userDatas = mysqli_fetch_assoc($userData);
			$_SESSION['user_id'] = $userDatas['user_id'];
			$_SESSION['username'] = $userDatas['user_name'];
			$_SESSION['images'] = $userDatas['user_imagefile'];
			$_SESSION['name'] = $userDatas['user_fullname'];
			$_SESSION['userrole'] = $userDatas['role_id'];
			$_SESSION['email'] = $userDatas['user_email'];
			header('location:index.php');
		} else {
			$errMsg = "Kombinasi Email/Username dan password anda tidak cocok atau belum terdaftar!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>KostIn</title>

	<!-- Bootstrap -->
	<link href="frontend/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="frontend/css/custom.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
	<!-- HEADER -->
	<div class="row sticky-top" style="background-color: white;">
		<!-- Social Icons-->
		<!-- Error message failed login-->
		<div class="container-fluid ">
			<?php if(isset($errMsg)){ ?>
			<div class="col  mx-auto">
				<div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
  					<strong>Gagal Login!</strong> <?php echo $errMsg; ?>.
  					<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
  						    <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
  					</button>
				</div>	
			</div>
    		<?php } ?>
			<ul class="social-icons">
         		<li><a href="#"><img src="frontend/icon/fb.png" alt=""></a></li>
          		<li><a href="#"><img src="frontend/icon/ig.png" alt=""></a></li>
          		<li><a href="#"><img src="frontend/icon/tw.png" alt=""></a></li>
        	</ul>
		</div>
		<!--End of Social Icons-->

		<!-- Navigation Bar-->
		<div class="container-fluid "  style="background-color: #2bb1ff;">
			<nav class="navbar navbar-expand-sm navbar-light nav-bg-color">
				<a class="navbar-brand nav-logo" href="index.php">
					<img src="frontend/logo/company.png">
				</a>
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false
		          " aria-label="Toggle navigation" style="float: right; width: 25%;">
		          	<span class="navbar-toggler-icon"></span>
		        </button>
	          	<div class="collapse navbar-collapse " id="navbarNav" >
	            	<ul class="navbar-nav mr-auto nav-text" >
	              		<li class="nav-item paddingNav">
	                		<a class="nav-link" href="index.php" >Home</a>
	              		</li>
	              		<li class="nav-item paddingNav">
	                		<a class="nav-link" href="#"  >Profile</a>
	              		</li>
	              		<li class="nav-item dropdown paddingNav">
	                		<a class="nav-link dropdown-toggle" href="" id="navbarDropDownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  ">Booking</a>
			                
			                <div class="dropdown-menu nav-text-dropdown" aria-labelledby="navbarDropDownMenuLink" style="background-color: #66c6ff; clear: white;">
	                  			<a class="dropdown-item" href="index.php?page=booking" >Pesan Kamar</a>
	                  			<a class="dropdown-item" href="index.php?page=get_data_booking">Konfirmasi Pembayaran</a>
	               			</div>
	              		</li>
	              		<li class="nav-item paddingNav">
	                		<a class="nav-link" href="index.php?page=contact_us" >Contact Us</a>
	              		</li>                                    
	            	</ul>     
	            	<ul class="navbar-nav ml-auto" id="btn-login">
	              		<li>
	               	 		<button type="button" class="btn btn-light" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
	              		</li>
	            	</ul>       
	         	</div>		         				
			</nav>
		</div>
		<!--End of Navigation Bar-->

	<!-- Form Login -->
		<div id="id01" class="modal">

			<form class="modal-content animate" action="" method="post">
			    <div class="imgcontainer">
		    		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		    	</div>

		    <div class="container-fluid">
		      	<label for="uname"><b>Username</b></label>
		      	<input type="text" placeholder="Enter Username" name="username" required>

		      	<label for="psw"><b>Password</b></label>
		      	<input type="password" placeholder="Enter Password" name="password" required>
		        
		      	<button type="submit">Login</button>
		    </div>

			    <div class="container-fluid" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
		      	<span class="psw">Forgot <a href="#">password?</a></span>
		    	</div>
		  	</form>
		</div>
	<!-- End of Form Login -->

	<!-- END of HEADER -->
	</div>