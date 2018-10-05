<?php
	include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/app.php';
	include $base_url.'/config/database.php';
	include $base_url."/module/data_get.php";

	$outcomeData = getAllData('kostin_outcome','*');
	$tagihanData = getAllData('kostin_tagihan','*');
	$totalPengeluaran = 0;
	foreach ($outcomeData as $outcome) {
		$totalPengeluaran += $outcome['outcm_value'];
	}

?>
<center>
	<h1>Laporan Pmasukan</h1>
	<table>
		<tr>
			<td>
				<center>
					<h3>Pemasukan Sewa Kost</h3>
					<table border="1">
						<tr>
							<th>No. Tagihan</th>
							<th>No. Kamar</th>
							<th>Jumlah Pemasukan</th>
						</tr>

						<?php
							$totalPemasukan = 0; 
							foreach ($tagihanData as $tagihan) {
								$sqlKamarID = "SELECT `kamar_id` FROM `kostin_kamar` WHERE `kamar_id` IN (SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id` IN (		SELECT `sewa_id` FROM `kostin_tagihan` WHERE `tagihan_id` = '".$tagihan['tagihan_id']."' ))";

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
								Total pemasukan :
							</td>
							<td>
								<?php echo number_format($totalPemasukan); ?>
							</td>
						</tr>
					</table>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<center>
					<br>
					<h3>
						Pengeluaran
					</h3>
					<table border="1">
						<tr>
							<th>No. Pengeluaran</th>
							<th>Keperluan</th>
							<th>Jenis Pengeluaran</th>
							<th>Waktu Input</th>
							<th>Jumlah</th>
						</tr>

						<?php
							foreach ($outcomeData as $outcme) {
								echo "
									<tr>
										<td>".$outcme['outcm_id']."</td>
										<td>".$outcme['outcm_name']."</td>
										<td>".$outcme['outcm_tag']."</td>
										<td>".$outcme['outcm_date']."</td>
										<td>".number_format($outcme['outcm_value'])."</td>
									</tr>
								";		
							}
						?>
						<tr>
							<td colspan="4">
								Total pengeluaran : 
							</td>
							<td colspan="2">
								<?php echo number_format($totalPengeluaran) ?>
							</td>
						</tr>
					</table>
					<br><br>
					<h2>Rekap data :</h2>
					<table>
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
							<td colspan="3">
								---------------------------------------------  -
							</td>
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
				</center>
			</td>
		</tr>
	</table>
</center>