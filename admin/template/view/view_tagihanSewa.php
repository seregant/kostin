<?php
	$allTagihanData = getAllData('kostin_tagihan','*', null, null);

	$rows = mysqli_num_rows($allTagihanData);
	$pagination = array();
	$limitData = 10;
	$offset = 0;
	$pageNum = 1;
	 
	if ($rows > $limitData) {
	  while ($rows>=0) {
	    $pagination[] =  '<a href="index.php?category=view&module=tagihanSewa&offset='.$offset.'"><button type="button" class="btn btn-primary btn-sm">'.$pageNum.'</button></a>';
	    $pageNum++;
	    $rows = $rows - $limitData;
	    $offset += $limitData;
	  }
	}
	                              
	if (isset($_GET['offset'])) {
	    $tagihanData = getAllData('kostin_tagihan','*', $limitData, $_GET['offset']);
	} else {
	    $tagihanData = getAllData('kostin_tagihan','*', $limitData, 0);
	}
?>
<div class="row m-b-5">
			<div class="col col-lg-12">
				<div class="overview-wrap">
	             	<h3 class="title-1">Tagihan Kamar</h3>
	           	</div>
			</div>
		</div>
		<div class="row m-b-5">
			<div class="col col-lg-12">
				<div class="table-responsive table--no-card m-b-30 m-t-20">
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
							<tr>
		                        <td colspan="7" style="background-color: #333333; color: white;">
		                            <center>
		                              <?php
		                                if (!empty($pagination)) {
		                                	echo '<label style="color: white;">Pages : &nbsp;</label>';
		                                  	foreach ($pagination as $links) {
		                                    echo $links."&nbsp;";
		                                  }
		                                }
		                              ?>
		                            </center>
		                        </td>
		                    </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>