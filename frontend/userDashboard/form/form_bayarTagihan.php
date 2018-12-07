
<?php
  $allTagihanData = mysqli_fetch_assoc(getTagihanData('sewa','tagihan_id', $_GET['id'], null,null));
  $convertMonth = DateTime::createFromFormat('!m', date("m",strtotime($allTagihanData['tagihan_duedate'])));

  $action = 'data_input.php?category=tagihanUpdate&role=penghuni';

?>
<div class="row">
        <div class="col-lg-2">
          
        </div>
        <div class="col-lg-8">
          <?php
            if (isset($_COOKIE['warning'])) {
              echo '
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Warning</span>
                            '.$_COOKIE['warning'].'
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
              Bayar Tagihan
            </strong>
            </div>
            <div class="card-body card-block">
              <div class="row m-b-5">
                <div class="col col-sm-12">
                  <div class="table-responsive table--no-card">
                    <table class="table table-borderless table-detail">
                      <thead>
                        <tr>
                          <th>No. Tagihan</th>
                          <th>Tagihan Bulan</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo $allTagihanData['tagihan_id']; ?></td>
                          <td><?php echo $convertMonth->format('F'); ?></td>
                          <td><?php echo 'Rp. '.number_format($allTagihanData['tagihan_jumlah']); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <form name="input-user" onsubmit="return inputUserValidation()" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" clas="form-horizontal">
                <div class="row from-group m-b-10" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label for="file-input" class="form-control-label">Bukti Transfer</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="file" name="trf_proof" class="form-control-file">
                  </div>
                </div>
                <div class="card-footer">
                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Kirim
                      </button>
                      <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Kembali
                      </button>
  
                </div>
                <input type="hidden" name="no_invoice" value="<?php echo $allTagihanData['tagihan_id'] ?>">
              </form>
            </div>
          </div>
        </div>
      </div>  