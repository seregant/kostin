<?php
	$bookingBillData = getBookingBillData($_GET['id']);
	$bookingBill = mysqli_fetch_assoc($bookingBillData);

	$dataBooking = getBookingData($bookingBill['book_id']);
	$booking = mysqli_fetch_assoc($dataBooking);
	$action = 'data_input.php?category=user&penghuni=yes';	
?>

<script src="template/js/myScript.js"></script>


      <div class="row">
        <div class="col-lg-3">
          
        </div>
        <div class="col-lg-6">
          <?php
            if (isset($_COOKIE['userinvalid'])) {
              echo '
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Warning</span>
                            '.$_COOKIE['userinvalid'].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
              ';
            }
          ?>
          <div class="card">
            <div class="card-header">
              <strong>
              	Tambah Penghuni
              </strong>
            </div>
            <div class="card-body card-block">
              <form name="input-user" onsubmit="return inputUserValidation()" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" clas="form-horizontal">
                <div class="row from-group">
                    <div class="col-12">
                    	<label class="form-control-label">Nama Penghuni</label>
	                    <input type="text" name="nama" class="form-control" readonly="readonly" value="<?php echo $booking['book_name'] ?>">
                    </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                    <div class="col-12">
                    	<label class="form-control-label">Username</label>
	                    <input type="text" name="username" class="form-control">
                    </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                   <div class="col-12">
                   		<label class="form-control-label">E-mail</label>
                    	<input type="text" name="mail" class="form-control" readonly="readonly" value="<?php echo $booking['book_email'] ?>">
                   </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                    <div class="col-12">
                    	<label class="form-control-label">Password</label>
                    	<input type="password" name="pass" class="form-control">
                    </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                    <div class="col-12">
                    	<label class="form-control-label">Ulangi Password</label>
                      	<input type="password" name="retype-pass" class="form-control">
                    </div>
                </div>
                </div>
                <div class="card-footer">
                		<input type="hidden" name="id" value="<?php echo $bookingBill['tagihan_id']; ?>">
                    <input type="hidden" name="addr" value="<?php echo $booking['book_addr']; ?>">
                		<input type="hidden" name="phone" value="<?php echo $booking['book_phone']; ?>">
                		<input type="hidden" name="idnty" value="<?php echo $booking['book_idnty']; ?>">
                		<input type="hidden" name="idntyfile" value="<?php echo $booking['book_idntyfile']; ?>">
                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                      </button>
                      <a href="index.php?category=detail&module=tgbooking&id=<?php echo $bookingBill['tagihan_id']; ?>"><button class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Kembali
                        </button></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>  