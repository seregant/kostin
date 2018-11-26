<?php
	$outcomeData = getAllData('kostin_outcome','*', null, null);
	$tagihanData = getTagihanData('sewa','tagihan_status','paid');
	$tagihanBookingData = getTagihanData('booking','tagihan_status','paid');
	$totalPengeluaran = 0;
	foreach ($outcomeData as $outcome) {
		$totalPengeluaran += $outcome['outcm_value'];
	}

?>
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Laporan Pemasukan</h2>
        </div>
    </div>
</div>
			<div class="row m-t-30">
				<div class="col-lg-6">
					<div class="table-responsive table--no-card m-b-30">
						<table class="table table-borderless table-striped table-earning">
							<thead>
								<tr>
									<th colspan="3">
											<h2 class="title-3 m-b-30" style="color: white;">Pemasukkan Sewa Kost</h2>
									</th>
								</tr>
								<tr>
									<th>No. Tagihan</th>
									<th>No. Kamar</th>
									<th>Pemasukan</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalPemasukan = 0; 
									foreach ($tagihanData as $tagihan) {
										$sqlKamarID = "SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id` IN (SELECT `sewa_id` FROM `kostin_tagihan` WHERE `tagihan_id` = '".$tagihan['tagihan_id']."')";

											$getKamarID = mysqli_fetch_assoc(mysqli_query($conn, $sqlKamarID));
											echo "
												<tr>
													<td>".$tagihan['tagihan_id']."</td>
													<td>".$getKamarID['kamar_id']."</td>
													<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												</tr>
										";
										$totalPemasukan += $tagihan['tagihan_jumlah'];
									}
								?>
								<tr>
									<td colspan="2">
										<b>Total pemasukan :</b>
									</td>
									<td>
										<b><?php echo number_format($totalPemasukan); ?></b>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="table-responsive table--no-card m-b-30">
						<table class="table table-borderless table-striped table-earning">
							<thead>
								<tr>
									<th colspan="3">
											<h2 class="title-3 m-b-30" style="color: white;">Pemasukkan Sewa Kost (Booking)</h2>
									</th>
								</tr>
								<tr>
									<th>No. Tagihan</th>
									<th>No. Booking</th>
									<th>Pemasukan</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$totalPemasukan = 0; 
									foreach ($tagihanBookingData as $tagihan) {
											echo "
												<tr>
													<td>".$tagihan['tagihan_id']."</td>
													<td>".$tagihan['book_id']."</td>
													<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												</tr>
										";
										$totalPemasukan += $tagihan['tagihan_jumlah'];
									}
								?>
								<tr>
									<td colspan="2">
										<b>Total pemasukan :</b>
									</td>
									<td>
										<b><?php echo number_format($totalPemasukan); ?></b>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="table-responsive table--no-card m-b-30">
						<table class="table table-borderless table-striped table-earning">
							<thead>
								<tr>
									<th colspan="2">
										Pengeluaran
									</th>
								</tr>
								<tr>
									<th>Keperluan</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							
							<?php
								foreach ($outcomeData as $outcme) {
									echo "
										<tr>
											
											<td>".$outcme['outcm_name']."</td>
											<td>".number_format($outcme['outcm_value'])."</td>
										</tr>
									";		
								}
							?>
							<tr>
								<td>
									<strong>Total pengeluaran :</strong> 
								</td>
								<td>
									<strong><?php echo number_format($totalPengeluaran) ?></strong>
								</td>
							</tr>
						</table>		
					</div>
				</div>
				<div class="col-lg-6">
					<div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
						<div class="au-card-inner">
							<div class="table-responsive">
								<table class="table table-top-countries">
									<tr>
										<td colspan="3">
											<h2 class="title-3 m-b-30" style="color: white;">Rekap Data :</h2>
										</td>
									</tr>
									<tr>
										<td>Total pemasukan</td>
										<td>&nbsp;:&nbsp;</td>
										<td><?php echo "Rp.".number_format($totalPemasukan) ?></td>
									</tr>
									<tr>
										<td>Total pengeluaran</td>
										<td>&nbsp;:&nbsp;</td>
										<td><?php echo "Rp.".number_format($totalPengeluaran); ?></td>
									</tr>
									<tr>
										<td>Pemasukan bersih</td>
										<td>&nbsp;:&nbsp;</td>
										<td><?php 
											$pemasukanBersih = $totalPemasukan-$totalPengeluaran;
											echo "Rp.".number_format($pemasukanBersih);
										?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		




