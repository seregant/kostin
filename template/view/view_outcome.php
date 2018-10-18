<?php
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";

  $outcomeData = getAllData('kostin_outcome','*');
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
			</table>		
		</div>
	</div>
</div>
