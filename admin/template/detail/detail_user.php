<?php
	$sqlUser = "SELECT
	`kostin_user`.*,
	`kostin_user_role`.*
	FROM `kostin_user`
	INNER JOIN `kostin_user_role` ON `kostin_user`.`role_id` = `kostin_user_role`.`role_id`
	WHERE `kostin_user`.`user_id` = '".$_GET['id']."'";
	
	$dataUser = mysqli_fetch_assoc(mysqli_query($conn,$sqlUser));

	$sqlSewa = "SELECT
	`kostin_sewa`.*,
	`kostin_tagihan`.*
	FROM `kostin_sewa`
	INNER JOIN `kostin_tagihan` ON `kostin_sewa`.`sewa_id` = `kostin_tagihan`.`sewa_id`
	WHERE `kostin_sewa`.`user_id` = '".$dataUser['user_id']."'";

	if ($dataUser['role_name']!='admin') {
		$dataSewa = mysqli_fetch_assoc(mysqli_query($conn,$sqlSewa));
	}
?>

<div class="row m-b-5">
	<div class="col col-lg-12">
		<div class="card">
	        <div class="card-body">
	            <div class="mx-auto d-block">
	                <img class="rounded-circle mx-auto d-block" src="<?php echo $dataUser['user_imagefile']; ?>" alt="Card image cap" style="width: 180px; height: 180px;">
	                <h5 class="text-sm-center mt-2 mb-1"><?php echo $dataUser['user_fullname']; ?></h5>
	                <div class="location text-sm-center">
	                    <i class="fa fa-map-marker"></i> <?php 
	                    	if (!is_null($dataUser['user_addr'])) {
	                    		echo $dataUser['user_addr'];
	                    	} else {
	                    		echo "Alamat";
	                    	}
	                    ?>
	                    <br>
	                    <i class="fa fa-envelope"></i> 
	                    <?php echo $dataUser['user_email']; ?>
	                    <br>
	                    <i class="fa fa-phone"></i> 
	                    <?php echo $dataUser['user_phone']; ?>
	                </div>
	            </div>
	            <hr>
	            <div class="row">
	            		<?php
	            			if ($dataUser['role_name']=='penghuni') {
	            				include 'template/detail/user_detail/penghuni.php';
	            			}
	            		?>
	            </div>
	        </div>
	    </div>
	</div>
</div>