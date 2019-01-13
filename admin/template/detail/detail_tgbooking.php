<?php
	$bookingBillData = getBookingBillData($_GET['id']);
	$bookingBill = mysqli_fetch_assoc($bookingBillData);

	$bookingData = getBookingData($bookingBill['book_id']);
	$booking = mysqli_fetch_assoc($bookingData);

	$sqlAddon = "
				SELECT
					`kostin_addons`.`ao_name`,
					`kostin_addons`.`ao_price`,
					`kostin_booking_ao`.`jumlah`
				FROM `kostin_booking_ao`
				INNER JOIN `kostin_addons` ON `kostin_addons`.`ao_id` = `kostin_booking_ao`.`ao_id`
				WHERE `kostin_booking_ao`.`book_id` = '".$bookingBill['book_id']."'
			";
	$addonsData = mysqli_query($conn, $sqlAddon);
	
	$roomData = getRoomData($booking['kamar_id']);
	$room = mysqli_fetch_assoc($roomData);

	$aoPrice = 0;

	$dueDateCount = dueDateCounter($bookingBill['tagihan_duedate']);

	if ($bookingBill['tagihan_status']=='pending' AND $dueDateCount > 0) {
		$color = 'blue';
		$status = 'Belum Dibayar';
	} else if($bookingBill['tagihan_status']=='waiting') {
		$color = 'orange';
		$status = 'Menunggu Konfirmasi';
	} else if($bookingBill['tagihan_status']=='paid') {
		$color = 'green';
		$status = 'Lunas';
	} else {
		$color = 'red';
		$status = 'Batal';
		if ($bookingBill['tagihan_status']=='cancel') {
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
						<h3 class="title-1">Tagihan Booking</h3>
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
				                      No. Tagihan : <?php echo $bookingBill['tagihan_id']; ?><br>
				                      No. Booking : <?php echo "<a href='index.php?category=detail&module=booking&id=".$booking['book_id']."' target='_blank'>".$booking['book_id']."</a>"; ?><br>
				                    </div>
								</div>
								<div class="col-md-4 text-right">
									Tanggal Booking<br>
									<h5 class="pb-2 display-5"><?php echo date('d F Y', strtotime($booking['book_date'])); ?></h5>
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
											<td><?php echo $booking['kamar_id']; ?></td>
											<td><?php echo 'Rp. '.number_format($room['kamar_harga']); ?></td>
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
											$totalPrice = $aoPrice + $room['kamar_harga'];
										?>
										<tr>
											<td colspan="3"><h5 class="pb-2 display-5">Total Tagihan</h5></td>
											<td><h5 class="pb-2 display-5"><?php echo 'Rp. '.number_format($totalPrice); ?></h5></td>
										</tr>
									</tbody>
								</table>
							</div>
							<h5 class="pb-2 display-5">Info Tagihan :</h5>
							<div class="table-responsive table-detail m-b-15 m-t-10">
								<table class="table ">
									<tbody>
										<tr>
											<td>Jatuh Tempo</td>
											<td><?php echo date('d F Y', strtotime($bookingBill['tagihan_duedate'])); ?></td>
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
													if (is_null($bookingBill['tagihan_paiddate'])){
														echo "-";
													} else {
														echo $bookingBill['tagihan_paiddate'];
													}
												 ?></td>
										</tr>
										<tr>
											<td>Metode Pembayaran</td>
											<td><?php
													if (is_null($bookingBill['tagihan_paymthd'])){
														echo "-";
													} else {
														echo ucfirst( $bookingBill['tagihan_paymthd']);
													}
												 ?></td>
										</tr>
										<tr>
											<td>Bukti Pembayaran</td>
											<td>
												<?php
													if (is_null($bookingBill['tagihan_bukti_bayar'])){
														echo "-";
													}
												 ?>
												<img src="<?php echo @$bookingBill['tagihan_bukti_bayar'] ?>" style="width: 500px; height: auto;" >
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
								if ($bookingBill['tagihan_status']!= 'paid') {
									if ($bookingBill['tagihan_status']=='waiting') {
									echo '<a href="index.php?category=form&module=tambahPenghuni&id='.$bookingBill['tagihan_id'].'"><button class="btn btn-success">Konfirmasi</button></a>';
									} else {
										echo '<button class="btn btn-success" disabled="disabled">Konfirmasi</button>';
									}
								}
							?> 
						<a onclick="goBack()">
							<button class="btn btn-danger">Kembali</button>
						</a>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>