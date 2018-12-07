<?php
	$sqlTagihan = "SELECT 
							`kostin_tagihan`.*,
							DATE_FORMAT(`kostin_tagihan`.`tagihan_duedate`, '%d %M %Y') AS 'jatuh_tempo', 
							`kostin_user`.`user_fullname`, 
							`kostin_user`.`user_email`,
							`kostin_sewa`.`kamar_id`, 
							`kostin_sewa`.`sewa_id`,
							`kostin_kamar`.`kamar_harga` 
						FROM `kostin_tagihan` 
						INNER JOIN `kostin_sewa` ON `kostin_tagihan`.`sewa_id` = `kostin_sewa`.`sewa_id` 
						INNER JOIN `kostin_kamar` ON `kostin_sewa`.`kamar_id` = `kostin_kamar`.`kamar_id` 
						INNER JOIN `kostin_user` ON `kostin_sewa`.`user_id` = `kostin_user`.`user_id`
						WHERE `kostin_tagihan`.`tagihan_id` = '".$_GET['id']."'";

	$dataTagihan = mysqli_fetch_assoc(mysqli_query($conn, $sqlTagihan));
?>
<div class="row">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Pastikan data pembayaran tagihan sudah lengkap. Konfirmasi tagihan <strong><?php echo $dataTagihan['tagihan_id'] ?></strong> Sekarang ?
			</div>
			<div class="card-footer">
				<form class="form-horizontal" action="data_input.php?category=updateTagihan&id=<?php echo $_GET['id']; ?>" method="post">
					<input type="hidden" name="update" value="tagihan">
					<button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Ya
                      </button>
                      <a href="index.php?category=view&module=addon">
                      	<button type="submit" class="btn btn-danger btn-sm">
	                          <i class="fa fa-ban"></i> Tidak
	                    </button>
                      </a>
				</form>
			</div>
		</div>
	</div>
</div>