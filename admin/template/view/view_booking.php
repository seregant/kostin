<?php
	if (isset($_GET['keyword'])) {
		$sql = "SELECT * FROM `kostin_booking` WHERE `book_id` LIKE '%".$_GET['keyword']."%' OR `book_name` LIKE '%".$_GET['keyword']."%' OR `book_addr` LIKE '%".$_GET['keyword']."%' OR `book_email` LIKE '%".$_GET['keyword']."%' OR `book_status` LIKE '%".$_GET['keyword']."%';";
		$bookingData = mysqli_query($conn, $sql);
	} else {
		$bookingData = getAllData('kostin_booking','*', null, null);
	}
?>
<script type="text/javascript" src="template/js/myScript.js"></script>
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<div class="row">
          <div class="col-md-12">
              <div class="overview-wrap">
                  <h3 class="title-1">Data Booking</h3>
                  <form method="get" class="form" action="">
                  	<div class="input-group">
                        <input type="text" name="searchBooking" placeholder="<?php 
                        	if (isset($_GET['keyword'])){
                        		echo($_GET['keyword']);
                        	} else {
                        		echo "Cari data booking...";
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
		<div class="table-responsive table--no-card m-b-30 m-t-20">
			<table class="table table-borderless table-tagihan" >
				<thead>
					<tr>
						<th>No. Booking</th>
						<th>Pemesan</th>
						<th>Tanggal</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($bookingData as $booking) {
							if ($booking['book_status']=='pending') {
								$color = 'blue';
							} else if ($booking['book_status']=='confirmed') {
								$color = 'green';
							} else if ($booking['book_status']=='denied'){
								$color = 'red';
							}

							echo "
								<tr class='row-click' data-href='index.php?category=detail&module=booking&id=".$booking['book_id']."'>
									<td>".$booking['book_id']."</td>
									<td>".$booking['book_name']."</td>
									<td>".$booking['book_date']."</td>
									<td style='color:".$color.";'>".ucfirst($booking['book_status'])."</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
