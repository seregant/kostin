<?php
	$dataKamar = getAvailRoom();
	$dataBooking = getBookingData($_GET['id']);
	$bookingRow = mysqli_fetch_assoc($dataBooking);
	$action = 'data_input.php?category=tagihanBook&book_id='.$_GET['id'];
?>
<div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header">
          Pilih kamar untuk booking nomor <strong><?php echo $bookingRow['book_id']; ?></strong>
      </div>
      <div class="card-body card-block">
        <form name="addon" method="post" action="<?php echo $action; ?>" class="form-horizontal">
          <div class="row form-group">
            <div class="col col-md-4">
              <label class="form-control-label">
                Pilih Kamar 
              </label>
            </div>
            <div class="col col-md-9">
              <select name="kamar_id" id="SelectLm" class="form-control-sm form-control">
                   <option value="nan">Silakan pilih</option>
                   <?php
                   	foreach ($dataKamar as $kamar) {
                   		echo '<option value="'.$kamar['kamar_id'].'">'.$kamar['kamar_id'].'</option>';
                   	}
                   ?>
               </select>
            </div>
          </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Pilih
          </button>
          <a href="index.php?category=view&module=booking">
            <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Batal</button>
          </a>
      </div>
      </form>
    </div>
  </div>