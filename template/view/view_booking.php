<?php
	$bookingData = getAllData('kostin_booking','*', null, null);
?>
<script type="text/javascript" src="template/js/myScript.js"></script>
<div class="row">
	<div class="col-lg-1"></div>
	<div class="col-lg-10">
		<div class="row">
          <div class="col-md-12">
              <div class="overview-wrap">
                  <h3 class="title-1">Data Booking</h3>
              </div>
          </div>
      </div>
		<div class="table-responsive table--no-card m-b-30 m-t-20">
			<table class="table table-borderless table-data3" >
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
								$color = 'red';
							} else if ($booking['book_status']=='confirmed') {
								$color = 'orange';
							} else {
								$color = 'green';
							}

							echo "
								<tr>
									<td><a href='index.php?category=detail&module=booking&id=".$booking['book_id']."'>".$booking['book_id']."</a></td>
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