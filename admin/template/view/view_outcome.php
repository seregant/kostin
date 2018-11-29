<?php
	$allOutcomeData = getAllData('kostin_outcome','*', null, null);

  	$rows = mysqli_num_rows($allOutcomeData);
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
	    $outcomeData = getAllData('kostin_outcome','*', $limitData, $_GET['offset']);
	} else {
	    $outcomeData = getAllData('kostin_outcome','*', $limitData, 0);
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Data Pengeluaran</h2>
            <a href="index.php?category=form&module=outcome">
              <button class="btn btn-success">
                Tambah Pengeluaran
              </button>
            </a>
        </div>
    </div>
</div>

<div class="row m-t-30">
	<div class="col-lg-12">
		<div class="table-responsive table--no-card m-b-30">
			<table class="table table-borderless table-data3">
				<thead>
					<tr>
						<th>Keperluan</th>
						<th>Jenis Pengeluaran</th>
						<th>Waktu Input</th>
						<th>Jumlah</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<?php
					foreach ($outcomeData as $outcme) {
						echo '
							<tr>
								<td>'.$outcme['outcm_name'].'</td>
								<td>'.ucfirst($outcme['outcm_tag']).'</td>
								<td>'.$outcme['outcm_date'].'</td>
								<td>'.number_format($outcme['outcm_value']).'</td>
								<td>
                                <div class="table-data-feature">
                                        <form action="index.php" method="post">
                                        <input type="hidden" name="del_opr" value="outcome">
                                        <input type="hidden" name="outcome_id" value="'.$outcme['outcm_id'].'">
                                        <input type="hidden" name="outcome_detail" value="'.$outcme['outcm_name'].'">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                          <i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                </div>
                            </td>
							</tr>
						';		
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
			</table>		
		</div>
	</div>
</div>
