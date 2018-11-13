<?php
	$bookingData = getBookingData($_GET['id']);
	$booking = mysqli_fetch_assoc($bookingData);
	
?>

<div class="row">
	<div class="col col-md-12">
		<div class="card">
			<div class="row m-t-20">
				<div class="col col-md-12">
					<center>
						<h3 class="title-1">Data Booking</h3>
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
									<td>Booking ID</td>
									<td>:</td>
									<td><?php echo $booking['book_id']; ?></td>
								</tr>
								<tr>
									<td>Pemesan</td>
									<td>:</td>
									<td><?php echo $booking['book_name']; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>:</td>
									<td><?php echo $booking['book_addr']; ?></td>
								</tr>
								<tr>
									<td>Nomor Identitas</td>
									<td>:</td>
									<td><?php echo $booking['book_idnty']; ?></td>
								</tr>
								<tr>
									<td>Email</td>
									<td>:</td>
									<td><?php echo $booking['book_email']; ?></td>
								</tr>
								<tr>
									<td>No. Telp</td>
									<td>:</td>
									<td><?php echo $booking['book_phone']; ?></td>
								</tr>
								<tr>
									<td>No Kamar</td>
									<td>:</td>
									<td><?php
											if ($booking['kamar_id']==null) {
												echo "-";
											} else {
												echo $booking['kamar_id'];
											}
									?></td>
								</tr>
								<tr>
									<td>Daftar Addon</td>
									<td>:</td>
									<td>
										<ul style="list-style: none;">
											<?php
												$sql = "SELECT `ao_name` FROM `kostin_addons` WHERE `ao_id` IN (SELECT `ao_id` FROM `kostin_booking_ao` WHERE`book_id`='".$booking['book_id']."')";
												$dataAddon = mysqli_query($conn, $sql);
												foreach ($dataAddon as $addon) {
												 	echo '<li>'.$addon['ao_name'].'</li>';
												 } 
											?>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Foto Identitas</td>
									<td>:</td>
									<td><img id="imgpopup" alt="<?php echo $booking['book_name'] ?>" src="<?php echo $booking['book_idntyfile'] ?>" style="width: 500px; height: auto;" >
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
							<?php 
								if ($booking['book_status']=='pending') {
									echo '<a href="index.php?category=form&module=kamarpilih&id='.$booking['book_id'].'">
									<button class="btn btn-success">Konfirmasi</button></a>
									';

									echo '<a href="data_input.php?category=tagihan&book_id='.$booking['book_id'].'&deny=yes">
									<button class="btn btn-warning">Tolak</button></a>';
								} else {
									echo '<button class="btn btn-success" disabled="disabled">Konfirmasi</button>';
								}
							?>
						<a href="index.php?category=view&module=booking">
							<button class="btn btn-danger">Kembali</button>
						</a>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>
