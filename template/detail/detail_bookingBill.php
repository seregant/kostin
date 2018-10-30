<?php
	$bookingBillData = getBookingBillData($_GET['id']);
	$bookingBill = mysqli_fetch_assoc($bookingBillData);
	
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
				<dir class="col col-md-1"></dir>
				<div class="col col-md-10 ">
					<div class="table-responsive table-data3 p-b-10">
						<table class="table ">
							<tbody>
								<tr>
									<td>Nomor Tagihan</td>
									<td>:</td>
									<td><?php echo $bookingBill['tagihan_id']; ?></td>
								</tr>
								<tr>
									<td>Nomor Booking</td>
									<td>:</td>
									<td><?php echo $bookingBill['book_id']; ?></td>
								</tr>
								<tr>
									<td>Jumlah Tagihan</td>
									<td>:</td>
									<td>Rp. <?php echo number_format($bookingBill['tagihan_jumlah']); ?></td>
								</tr>
								<tr>
									<td>Jatuh Tempo</td>
									<td>:</td>
									<td><?php echo $bookingBill['tagihan_duedate']; ?></td>
								</tr>
								<tr>
									<td>Tanggal Pembayaran Diterima</td>
									<td>:</td>
									<td><?php
											if (is_null($bookingBill['tagihan_paiddate'])){
												echo "Belum dibayar";
											} else {
												echo $bookingBill['tagihan_paiddate'];
											}
										 ?></td>
								</tr>
								<tr>
									<td>Jatuh Tempo</td>
									<td>:</td>
									<td><?php
											if (is_null($bookingBill['tagihan_paymthd'])){
												echo "Belum dibayar";
											} else {
												echo $bookingBill['tagihan_paymthd'];
											}
										 ?></td>
								</tr>
								<tr>
									<td>Bukti Pembayaran</td>
									<td>:</td>
									<td>
										<?php
											if (is_null($bookingBill['tagihan_bukti_bayar'])){
												echo "Belum dibayar";
											}
										 ?>
										<img src="<?php echo @$bookingBill['tagihan_bukti_bayar'] ?>" style="width: 500px; height: auto;" >
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row m-t-10 p-b-15">
				<div class="col col-md-12">
					<center>
							<!-- <?php 
								if ($bookingBill['book_status']=='pending') {
									echo '<a href="data_input.php?category=tagihan&book_id='.$bookingBill['book_id'].'">
									<button class="btn btn-success">Konfirmasi</button></a>
									';

									echo '<a href="data_input.php?category=tagihan&book_id='.$bookingBill['book_id'].'&deny=yes">
									<button class="btn btn-warning">Tolak</button></a>';
								} else {
									echo '<button class="btn btn-success" disabled="disabled">Konfirmasi</button>';
								}
							?> -->
						<a href="index.php?category=view&module=tagihan">
							<button class="btn btn-danger">Kembali</button>
						</a>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
