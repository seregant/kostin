<div class="row">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Apakah anda ingin menghapus data kamar nomor <strong><?php echo $_POST['room_id']; ?></strong> ?
			</div>
			<div class="card-footer">
				<form class="form-horizontal" action="module/opr_delete.php" method="post">
					<input type="hidden" name="room_id_delete" value="<?php echo $_POST['room_id'] ?>">
					<input type="hidden" name="data" value="kamar">
					<button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Ya
                      </button>
                      <a href="index.php?category=view&module=kamar">
                      	<button type="submit" class="btn btn-danger btn-sm">
	                          <i class="fa fa-ban"></i> Tidak
	                    </button>
                      </a>
				</form>
			</div>
		</div>
	</div>
</div>