<div class="row">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Apakah anda ingin menghapus data addon <strong><?php echo $_POST['addon_detail']; ?></strong> ?
			</div>
			<div class="card-footer">
				<form class="form-horizontal" action="module/opr_delete.php" method="post">
					<input type="hidden" name="addon_id_delete" value="<?php echo $_POST['addon_id'] ?>">
					<input type="hidden" name="data" value="addon">
					<button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Ya
                      </button>
                      <a href="index.php?category=view&module=addon">
                      	<button type="submit" class="btn btn-danger btn-sm">
	                          <i class="fa fa-ban"></i> Tidak
	                    </button>
                      </a>
				</form>
			</div>
		</div>
	</div>
</div>