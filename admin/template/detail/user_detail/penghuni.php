<?php
	$tagihanData = getTagihanData('sewa','sewa_id', $dataSewa['sewa_id'], 5, 0);
?>
					<div class="col col-lg-6">
	            		<div class="table-responsive">
	            			<table class="table table-borderless table-detail">
	            				<thead>
	            					<tr>
	            						<th colspan="3"><center><?php echo ucfirst($dataUser['role_name']); ?></center></th>
	            					</tr>
	            				</thead>
	            				<tbody>
									<tr>
										<td>Tanggal Check In</td>
										<td>:</td>
										<td><?php echo $dataSewa['sewa_in']; ?></td>
									</tr>
									<tr>
										<td>No. Kamar</td>
										<td>:</td>
										<td><?php echo $dataSewa['kamar_id']; ?></td>
									</tr>
									<tr>
										<td>Sisa Kuota Huni</td>
										<td>:</td>
										<td><?php echo $dataSewa['sewa_durasi']; ?> Hari</td>
									</tr>
								</tbody>
	            			</table>
	            		</div>
	            	</div>
	            	<div class="col col-lg-6">
	            		<div class="table-responsive">
	            			<center>Tagihan Terakhir</center>
	            			<table class="table table-borderless table-tagihan">
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
													<tr class='row-click' data-href='index.php?category=detail&module=tagihan&id=".$tagihan['tagihan_id']."'>
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



