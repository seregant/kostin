<?php
	$tagihanData = getAllData('kostin_tagihan','*', null, null);
	$tagihanBookingData = getAllData('kostin_tagihan_booking','*', null, null);
	$totalPengeluaran = 0;
?>

<div class="row">
	<div class="col-lg-7">
		<div class="row m-b-5">
			<div class="col col-lg-12">
				<div class="overview-wrap">
	             	<h3 class="title-1">Tagihan Kamar</h3>
	           	</div>
			</div>
		</div>
		<div class="row m-b-5">
			<div class="col col-lg-12">
				<div class="table-responsive table--no-card m-b-30">
					<table class="table table-borderless table-data3">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kamar</th>
								<th>Amount</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($tagihanData as $tagihan) {
									$sqlKamarID = "SELECT `kamar_id` FROM `kostin_kamar` WHERE `kamar_id` IN (SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id` IN 
									(SELECT `sewa_id` FROM `kostin_tagihan` WHERE `tagihan_id` = '".$tagihan['tagihan_id']."' ))";

										$getKamarID = mysqli_fetch_assoc(mysqli_query($conn, $sqlKamarID));

										if ($tagihan['tagihan_status']=='pending') {
											$color = 'red';
										} else if($tagihan['tagihan_status']=='confirmed') {
											$color = 'orange';
										} else {
											$color = 'green';
										}

										echo "
											<tr>
												<td>".$tagihan['tagihan_id']."</td>
												<td>".$getKamarID['kamar_id']."</td>
												<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												<td style='color:$color;'>".ucfirst($tagihan['tagihan_status'])."</td>
											</tr>
									";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row m-b-5">
			<div class="col-lg-12">
				<div class="row m-b-5">
					<div class="col col-lg-12">
						<div class="overview-wrap">
			             	<h3 class="title-1">Tagihan Booking</h3>
			           	</div>
					</div>
				</div>
				<div class="table-responsive table--no-card m-b-30">
					<table class="table table-borderless table-data3">
						<thead>
							<tr>
								<th>No.</th>
								<th>ID Booking</th>
								<th>Amount</th>
								<th>Status</th>						</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($tagihanBookingData as $tagihan) {
									$sqlBookID = "SELECT `book_id` FROM `kostin_booking` WHERE `book_id` IN (SELECT `book_id` FROM `kostin_tagihan_booking` WHERE `tagihan_id` ='".$tagihan['tagihan_id']."')";

										$getBookID = mysqli_fetch_assoc(mysqli_query($conn, $sqlBookID));

										if ($tagihan['tagihan_status']=='pending') {
											$color = 'blue';
										} else if($tagihan['tagihan_status']=='confirmed') {
											$color = 'orange';
										} else if($tagihan['tagihan_status']=='paid') {
											$color = 'green';
										} else {
											$color = 'red';
										}

										echo "
											<tr>
												<td><a href='index.php?category=detail&module=tagihan&id=".$tagihan['tagihan_id']."'><button class='btn btn-sm btn-link'>".$tagihan['tagihan_id']."</button></a></td>
												<td><a href='index.php?category=detail&module=booking&id=".$getBookID['book_id']."'><button class='btn btn-sm btn-link'>".$getBookID['book_id']."</button></a></td>
												<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												<td style='color:$color;'>".ucfirst($tagihan['tagihan_status'])."</td>
											</tr>
									";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>