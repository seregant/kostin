<div class="row">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				Hapus data user <?php echo $_POST['user_detail']; ?>
			</div>
			<div class="card-footer">
				<form class="form-horizontal" action="module/opr_delete.php" method="post">
					<input type="hidden" name="user_id_delete" value="<?php echo $_POST['user_id'] ?>">
					<input type="hidden" name="user_image_delete" value="<?php echo $_POST['user_image'] ?>">
					<input type="hidden" name="user_thumb_delete" value="<?php echo $_POST['user_thumb'] ?>">
					<input type="hidden" name="data" value="user">
					<button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Ya
                      </button>
                      <a href="index.php?category=form&module=user">
                      	<button type="submit" class="btn btn-danger btn-sm">
	                          <i class="fa fa-ban"></i> Tidak
	                    </button>
                      </a>
				</form>
			</div>
		</div>
	</div>
</div>