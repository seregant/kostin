<?php
	$allBookingData = getAllData('kostin_tagihan_booking','*',null,null);
	
	$rows = mysqli_num_rows($allBookingData);
	$pagination = array();
	$limitData = 10;
	$offset = 0;
	$pageNum = 1;
	 
	if ($rows > $limitData) {
	  while ($rows>=0) {
	    $pagination[] =  '<a href="index.php?category=view&module=tagihanBooking&offset='.$offset.'"><button type="button" class="btn btn-primary btn-sm">'.$pageNum.'</button></a>';
	    $pageNum++;
	    $rows = $rows - $limitData;
	    $offset += $limitData;
	  }
	}
	                              
	if (isset($_GET['offset'])) {
	    $tagihanBookingData = getAllData('kostin_tagihan_booking','*', $limitData, $_GET['offset']);
	} else {
	    $tagihanBookingData = getAllData('kostin_tagihan_booking','*', $limitData, 0);
	}
?>

<div class="row">
	<div class="col-lg-12">
		<?php
            if (isset($_COOKIE['confirmed'])) {
              if ($_COOKIE['confirmed']=="yes") {
                echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                      <span class="badge badge-pill badge-success">Success</span>
                      '.$_COOKIE['message'].'
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
              }
            }
        ?>
		
		<div class="row m-b-5">
			<div class="col-lg-12">
				<div class="row m-b-5">
					<div class="col col-lg-12">
						<div class="overview-wrap">
			             	<h3 class="title-1">Tagihan Booking</h3>
			           	</div>
					</div>
				</div>
				<div class="table-responsive table--no-card m-b-30 m-t-20">
					<table class="table table-borderless table-data3">
						<thead>
							<tr>
								<th>No.</th>
								<th>ID Booking</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Jatuh Tempo</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($tagihanBookingData as $tagihan) {
									$sqlBookID = "SELECT `book_id` FROM `kostin_booking` WHERE `book_id` IN (SELECT `book_id` FROM `kostin_tagihan_booking` WHERE `tagihan_id` ='".$tagihan['tagihan_id']."')";

										$getBookID = mysqli_fetch_assoc(mysqli_query($conn, $sqlBookID));
										
										$dueDateCount = dueDateCounter($tagihan['tagihan_duedate']);

										if ($tagihan['tagihan_status']=='pending' AND $dueDateCount > 0) {
											$color = 'blue';
											$status = 'Belum Dibayar';
										} else if($tagihan['tagihan_status']=='waiting') {
											$color = 'orange';
											$status = 'Menunggu Konfirmasi';
										} else if($tagihan['tagihan_status']=='paid' ) {
											$color = 'green';
											$status = 'Lunas';
										} else {
											$color = 'red';
											$status = 'Batal';
										}

										echo "
											<tr>
												<td><a href='index.php?category=detail&module=tgbooking&id=".$tagihan['tagihan_id']."'><button class='btn btn-sm btn-link'>".$tagihan['tagihan_id']."</button></a></td>
												<td><a href='index.php?category=detail&module=booking&id=".$getBookID['book_id']."'><button class='btn btn-sm btn-link'>".$getBookID['book_id']."</button></a></td>
												<td>".number_format($tagihan['tagihan_jumlah'])."</td>
												<td style='color:$color;'>".$status."</td>
												<td>".$tagihan['tagihan_duedate']."</td>
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
	</div>
</div>