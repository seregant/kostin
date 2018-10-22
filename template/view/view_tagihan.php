<?php
	$tagihanData = getAllData('kostin_tagihan','*', null, null);
	$totalPengeluaran = 0;
?>

<div class="row">
	<div class="col-lg-6">
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-striped table-earning">
				<thead>
					<tr>
						<th>No. Tagihan</th>
						<th>No. Kamar</th>
						<th>Amount</th>
						<th>Tipe Tagihan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($tagihanData as $tagihan) {
							$sqlKamarID = "SELECT `kamar_id` FROM `kostin_kamar` WHERE `kamar_id` IN (SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id` IN 
							(SELECT `sewa_id` FROM `kostin_tagihan` WHERE `tagihan_id` = '".$tagihan['tagihan_id']."' ))";

								$getKamarID = mysqli_fetch_assoc(mysqli_query($conn, $sqlKamarID));
								echo "
									<tr>
										<td>".$tagihan['tagihan_id']."</td>
										<td>".$getKamarID['kamar_id']."</td>
										<td>".number_format($tagihan['tagihan_jumlah'])."</td>
									</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>