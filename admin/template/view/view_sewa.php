<?php
	$dataSewa = getAllData('kostin_sewa','*', null, null);
?>
 <div class="row">
 	<dir class="col-lg-1"></dir>
	<div class="col-lg-10">
		<div class="row">
		    <div class="col-md-12">
		        <div class="overview-wrap">
		            <h2 class="title-1">Data Sewa Kamar</h2>
		        </div>
		    </div>
		</div>
		<div class="table-responsive table--no-card m-b-30 m-t-30">
			<table class="table table-borderless table-tagihan">
				<thead>
					<tr>
						<th>Sewa ID</th>
						<th>Nomor Kamar</th>
						<th>Penguni</th>
						<th>Check In</th>
						<th>Check Out</th>
						<th>Sisa Durasi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($dataSewa as $sewa) {
							$sqlKamarID = "SELECT `kamar_id` FROM `kostin_kamar` WHERE `kamar_id` IN (SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id`='".$sewa['sewa_id']."' )";
							$sqlUser = "SELECT `user_fullname` FROM `kostin_user` WHERE `user_id` IN ( SELECT `user_id` FROM `kostin_sewa` WHERE `sewa_id`='".$sewa['sewa_id']."')";

							if ($sewa['sewa_out']==null) {
								$checkOutDate = "-";
							} else {
								$checkOutDate = $sewa['sewa_out'];
							}

								$getKamarID = mysqli_fetch_assoc(mysqli_query($conn, $sqlKamarID));
								$getUser = mysqli_fetch_assoc(mysqli_query($conn, $sqlUser));
								echo "
									<tr class='row-click' data-href='index.php?category=detail&module=user&id=".$sewa['user_id']."'>
										<td>".$sewa['sewa_id']."</td>
										<td>".$getKamarID['kamar_id']."</td>
										<td>".$getUser['user_fullname']."</td>
										<td>".$sewa['sewa_in']."</td>
										<td>".$checkOutDate."</td>
										<td>".$sewa['sewa_durasi']."</td>
									</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
