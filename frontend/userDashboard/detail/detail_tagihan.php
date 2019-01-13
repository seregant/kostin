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
	
	$sqlAddon = "
				SELECT
					`kostin_addons`.`ao_name`,
					`kostin_addons`.`ao_price`,
					`kostin_sewa_ao`.`jumlah`
				FROM `kostin_sewa_ao`
				INNER JOIN `kostin_addons` ON `kostin_addons`.`ao_id` = `kostin_sewa_ao`.`ao_id`
				WHERE `kostin_sewa_ao`.`sewa_id` = '".$dataTagihan['sewa_id']."'
			";
	$addonsData = mysqli_query($conn, $sqlAddon);

	$convertMonth = DateTime::createFromFormat('!m', date("m",strtotime($dataTagihan['tagihan_duedate'])));

	$aoPrice = 0;

	$dueDateCount = dueDateCounter($dataTagihan['tagihan_duedate']);

	if ($dataTagihan['tagihan_status']=='pending' AND $dueDateCount > 0) {
		$color = 'blue';
		$status = 'Belum Dibayar';
	} else if($dataTagihan['tagihan_status']=='waiting') {
		$color = 'orange';
		$status = 'Menunggu Verifikasi';
	} else if($dataTagihan['tagihan_status']=='paid') {
		$color = 'green';
		$status = 'Lunas';
	} else {
		$color = 'red';
		$status = 'Batal';
		if ($dataTagihan['tagihan_status']=='cancel') {
			$keterangan = '(Transaksi dibatalkan)';
		} else {
			$keterangan = '(Sudah melewati jatuh tempo)';
		}
	}

?>

<div class="row">
	<div class="col col-md-12">
		<div class="card">
			<div class="row m-t-20">
				<div class="col col-md-12">
					<center>
						<h3 class="title-1">Tagihan Sewa <?php echo @$dataTagihan['sewa_id']; ?></h3>
					</center>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col col-md-1"></div>
				<div class="col col-md-10 ">
					<div class="row">
						<div class="col-md-12">
							<hr>
							<div class="row">
								<div class="col-md-8">
									<div class="typo-articles">
				                      No. Tagihan : <?php echo $dataTagihan['tagihan_id']; ?><br>
				                    </div>
								</div>
							</div>
		                    <hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h5 class="pb-2 display-5">Kamar :</h5>
							<div class="table-responsive table-detail m-b-15 m-t-10">
								<table class="table ">
									<thead>
										<tr>
											<th>No.</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $dataTagihan['kamar_id']; ?></td>
											<td><?php echo 'Rp. '.number_format($dataTagihan['kamar_harga']); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<h5 class="pb-2 display-5">Addon :</h5>
							<div class="table-responsive table-detail m-b-15 m-t-10">
								<table class="table ">
									<thead>
										<tr>
											<th>Nama</th>
											<th>Jumlah</th>
											<th>Harga @</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach ($addonsData as $addon) {
												echo '
													<tr>
														<td>'.$addon['ao_name'].'</td>
														<td>'.$addon['jumlah'].'</td>
														<td>Rp. '.number_format($addon['ao_price']).'</td>
														<td>Rp. '.number_format($addon['ao_price']*$addon['jumlah']).'</td>
													</tr>
												';
												$aoPrice += $addon['ao_price']*$addon['jumlah'];
											}
											$totalPrice = $aoPrice + $dataTagihan['kamar_harga'];
										?>
										<tr>
											<td colspan="3"><h5 class="pb-2 display-5">Total Tagihan</h5></td>
											<td><h5 class="pb-2 display-5"><?php echo 'Rp. '.number_format($dataTagihan['tagihan_jumlah']); ?></h5></td>
										</tr>
									</tbody>
								</table>
							</div>
							<h5 class="pb-2 display-5">Info Tagihan :</h5>
							<div class="table-responsive table-detail m-b-15 m-t-10">
								<table class="table ">
									<tbody>
										<tr>
											<td colspan="2">
												<center>Tagihan Perpanjangan Masa Huni Untuk Bulan <?php echo $convertMonth->format('F'); ?></center>
											</td>
										</tr>
										<tr>
											<td>Jatuh Tempo</td>
											<td><?php echo date('d F Y', strtotime($dataTagihan['tagihan_duedate'])); ?></td>
										</tr>
										<tr>
											<td>Status</td>
											<td <?php echo "style = color:$color"; ?>><?php echo $status;
											 ?>
											 	<div class="typo-articles">
											 		<p>
												 		<?php echo @$keterangan; ?>
												 	</p>
											 	</div>
											 </td>
										</tr>
										<tr>
											<td>Tanggal Pembayaran</td>
											<td><?php
													if (is_null($dataTagihan['tagihan_paiddate'])){
														echo "-";
													} else {
														echo $dataTagihan['tagihan_paiddate'];
													}
												 ?></td>
										</tr>
										<tr>
											<td>Metode Pembayaran</td>
											<td><?php
													if (is_null($dataTagihan['tagihan_paymthd'])){
														echo "-";
													} else {
														echo ucfirst( $dataTagihan['tagihan_paymthd']);
													}
												 ?></td>
										</tr>
										<tr>
											<td>Bukti Pembayaran</td>
											<td>
												<?php
													if (is_null($dataTagihan['tagihan_bukti_bayar'])){
														echo "-";
													}
												 ?>
												<img src="<?php echo @$dataTagihan['tagihan_bukti_bayar'] ?>" style="width: 500px; height: auto;" >
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<hr>
						</div>
					</div>
				</div>
			<div class="col col-md-1"></div>
			</div>
			<div class="row m-t-10 p-b-20">
				<div class="col col-md-12">
					<center>
							<?php 
								if ($dataTagihan['tagihan_status']!= 'paid') {
									if ($dataTagihan['tagihan_status']=='pending') {
									echo '<a href="index.php?category=form&get=bayarTagihan&id='.$dataTagihan['tagihan_id'].'"><button class="btn btn-success">Konfirmasi Pembayaran</button></a>';
									} else {
										echo '<button class="btn btn-success" disabled="disabled">Konfirmasi Pembayaran</button>';
									}
								}
							?> 
							<br>
							<hr>
							<button class="btn-sm btn-danger" onclick="goBack()">Kembali</button>
						
					</center>
				</div>
			</div>
		</div>
	</div>
</div>