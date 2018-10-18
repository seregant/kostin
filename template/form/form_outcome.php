
<?php
  $action = 'module/data_input.php?category=outcome';
?>

<div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header">
        <strong>
          Tambah Pengeluaran
        </strong>
      </div>
      <div class="card-body card-block">
        <form name="outcome" method="post" action="<?php echo $action ?>" class="form-horizontal">
          <div class="row form-group">
            <div class="col col-md-12">
              <label class="form-control-label">Nama Pengeluaran</label>
              <input type="text" name="nama" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-12">
              <label class="form-control-label">Nilai Pengeluaran</label>
              <input type="text" name="value" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-12">
              <label class="form-control-label">Jenis Pengeluaran</label>
              <select class="form-control" name="tag">
                <option value="bulanan">Bulanan</option>
                <option value="kondisional">Kondisional</option>
                <option value="belanja">Belanja</option>
                <option value="perbaikan">Perbaikan</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-12">
              <label class="form-control-label">Keterangan</label>
              <textarea name="keterangan" form="form-outcome" placeholder="Keterangan pengeluaran.." class="form-control" rows="5"></textarea>
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
          <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>