<?php
  
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";

  if(isset($_GET['room_id'])){
    $dataKamar = getRoomData($_GET['room_id']);
    $data = mysqli_fetch_assoc($dataKamar);
    $action = "module/data_edit.php?category=room&room_id=".$_GET['room_id'];
  } else {
    $action = "module/data_input.php?category=room";
  }

?>
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <strong>
              <?php 
                if (isset($_GET['room_id'])){
                  echo "Edit Kamar";
                } else {
                  echo "Tambah Kamar Baru";
                }
              ?>
            </strong>
            </div>
            <div class="card-body card-block">
              <form name="add_kamar" action="<?php echo $action ?>" method="post" class="form-horizontal">
                <div class="row form-group">
                  <div class="col col-md-4">
                    <label class="form-control-label">
                      Nomor Kamar
                    </label>
                  </div>
                  <div class="col-12 col-md-7">
                    <input type="text" name="nomor" class="form-control" value="<?php echo @$data['kamar_id'] ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-4">
                    <label class="form-control-label">
                      Panjang Kamar
                    </label>
                  </div>
                  <div class="col-12 col-md-7">
                    <input type="text" name="panjang" class="form-control" value="<?php echo @$data['kamar_panjang'] ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-4">
                    <label class="form-control-label">
                      Lebar Kamar
                    </label>
                  </div>
                  <div class="col-12 col-md-7">
                    <input type="text" name="lebar" class="form-control" value="<?php echo @$data['kamar_lebar'] ?>" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-4">
                    <label class="form-control-label">
                      Harga Sewa
                    </label>
                  </div>
                  <div class="col-12 col-md-7">
                    <input type="text" name="price" class="form-control" value="<?php echo @$data['kamar_harga'] ?>" required>
                    <small class="form-text text-muted">*Harga kamar per bulan</small>

                  </div>
                </div>

                <?php
                  if (isset($_GET['room_id'])) {
                    if ($data['kamar_status']=='kosong') {
                      $status1 = "kosong";
                      $status2 = "dihuni";
                    } else {
                      $status1 = "dihuni";
                      $status2 = "kosong";
                    }
                    echo '
                      <div class="row form-group">
                        <div class="col col-md-4">
                          <label class="form-control-label">
                            Status
                          </label>
                        </div>
                        <div class="col-12 col-md-7">
                          <select name="status" id="select" class="form-control">
                            <option value="'.$status1.'">'.$status1.'</option>
                            <option value="'.$status2.'">'.$status2.'</option>
                          </select>
                        </div>
                      </div>
                   ';
                  }
                ?>

                <div class="row form-group">
                  <div class="col col-md-4">
                    <label class="form-control-label">
                      Keterangan
                    </label>
                  </div>
                  <div class="col-12 col-md-7">
                    <textarea name="keterangan" id="textarea-input" rows="9" placeholder="Keterangan kamar..." class="form-control"><?php echo @$data['kamar_keterangan'] ?></textarea>
                  </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                  <i class="fa fa-dot-circle-o"></i> Simpan
                </button>
                <button type="reset" class="btn btn-warning btn-sm">
                  <i class="fa fa-refresh"></i> Reset
                </button>
                <a href="index.php?category=view&module=kamar">
                  <button type="reset" class="btn btn-danger btn-sm">
                  <i class="fa fa-ban"></i> Canel</button>
                </a>
            </div>
            </form>
          </div>
        </div>
      </div>
      
