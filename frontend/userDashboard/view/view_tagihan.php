<?php
	 $sqlSewa = "SELECT
    `kostin_sewa`.*,
    `kostin_tagihan`.*
    FROM `kostin_sewa`
    INNER JOIN `kostin_tagihan` ON `kostin_sewa`.`sewa_id` = `kostin_tagihan`.`sewa_id`
    WHERE `kostin_sewa`.`user_id` = '".$_SESSION['user_id']."'";

    $dataSewa = mysqli_fetch_assoc(mysqli_query($conn,$sqlSewa));
	
	$allTagihanData = getTagihanData('sewa','sewa_id', $dataSewa['sewa_id'], null,null);

	$rows = mysqli_num_rows($allTagihanData);
	$pagination = array();
	$limitData = 10;
	$offset = 0;
	$pageNum = 1;
	 
	if (isset($_GET['keyword'])) {
		$sql = "SELECT * FROM `kostin_tagihan` WHERE `tagihan_id` LIKE '%".$_GET['keyword']."%' AND `sewa_id` ='".$dataSewa['sewa_id']."'";
		$allSearchRes= mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($allSearchRes);

		if ($rows > $limitData) {
		  while ($rows>=0) {
		    $pagination[] =  '<a href="index.php?category=view&module=tagihanBooking&keyword='.$_GET['keyword'].'&offset='.$offset.'"><button type="button" class="btn btn-primary btn-sm">'.$pageNum.'</button></a>';
		    $pageNum++;
		    $rows = $rows - $limitData;
		    $offset += $limitData;
		  }
		}

		if (isset($_GET['offset'])) {
			$sql = "SELECT * FROM `kostin_tagihan_booking` WHERE `tagihan_id` LIKE '%".$_GET['keyword']."%' AND `sewa_id` ='".$dataSewa['sewa_id']."' LIMIT ".$_GET['offset'].",$limitData";
		   	$tagihanData = mysqli_query($conn, $sql);
		} else {
		    $tagihanData = mysqli_query($conn, $sql);
		}
	} else {
		if ($rows > $limitData) {
		  while ($rows>=0) {
		    $pagination[] =  '<a href="index.php?category=view&get=tagihan&offset='.$offset.'"><button type="button" class="btn btn-primary btn-sm">'.$pageNum.'</button></a>';
		    $pageNum++;
		    $rows = $rows - $limitData;
		    $offset += $limitData;
		  }
		}
		                              
		if (isset($_GET['offset'])) {
		    $tagihanData = getTagihanData('sewa','sewa_id', $dataSewa['sewa_id'], $limitData, $_GET['offset']);
		} else {
		    $tagihanData = getTagihanData('sewa','sewa_id', $dataSewa['sewa_id'], $limitData, 0);
		}
	}
?>
<div class="row m-b-5">
			<div class="col col-lg-12">
				<?php
		            if (isset($_COOKIE['isclear'])) {
		               echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
		                      <span class="badge badge-pill badge-success">Success</span>
		                      '.$_COOKIE['message'].'
		                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                        <span aria-hidden="true">×</span>
		                      </button>
		                    </div>';
		            }
		        ?>
				<div class="overview-wrap">
	             	<h3 class="title-1">Tagihan Kamar</h3>
	             	<form method="get" class="form" action="">
		               	<div class="input-group">
		                    <input type="text" name="searchTagihan" placeholder="<?php 
		                       	if (isset($_GET['keyword'])){
		                    		echo($_GET['keyword']);
		                       	} else {
		                       		echo "Cari No. tagihan...";
		                       	}
			                     ?>" class="form-control" >
			                <div class="input-group-btn">&nbsp;
			                    <button class="btn btn-primary">
			                       <i class="fa fa-search"></i>
			                    </button>
			                </div>
			            </div>
				    </form>
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

										$dueDateCount = dueDateCounter($tagihan['tagihan_duedate']);

										if ($tagihan['tagihan_status']=='pending' AND $dueDateCount > 0) {
											$color = 'blue';
											$status = 'Belum Dibayar';
										} else if($tagihan['tagihan_status']=='waiting') {
											$color = 'orange';
											$status = 'Menunggu Verifikasi';
										} else if($tagihan['tagihan_status']=='paid' ) {
											$color = 'green';
											$status = 'Lunas';
										} else {
											$color = 'red';
											$status = 'Batal';
										}

										echo "
											<tr class='row-click' data-href='index.php?category=detail&get=tagihan&id=".$tagihan['tagihan_id']."'>
												<td>".$tagihan['tagihan_id']."</td>
												<td>".$getKamarID['kamar_id']."</td>
												<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												<td style='color:$color;'>".ucfirst($status)."</td>
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