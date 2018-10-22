<?php
  if(isset($_GET['id'])){
    $addonData = getAddonData($_GET['id']);
    $rows = mysqli_fetch_assoc($addonData);

    $action = "data_edit.php?category=addon&id=".$_GET['id'];
  } else {
    $action = "data_input.php?category=addon";
  }
?>

<div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header">
        <strong>
          <?php 
            if (isset($_GET['id'])) {
              echo "Edit Addon";
            } else {
              echo "Tambah Addon";
            }
          ?>
        </strong>
      </div>
      <div class="card-body card-block">
        <form name="addon" method="post" action="<?php echo $action; ?>" class="form-horizontal">
          <div class="row form-group">
            <div class="col col-md-4">
              <label class="form-control-label">
                Nama Addon
              </label>
            </div>
            <div class="col-12 col-md-8">
              <input type="text" name="nama" class="form-control" value="<?php echo @$rows['ao_name'] ?>">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4">
              <label class="form-control-label">
                Spesifikasi
              </label>
            </div>
            <div class="col-12 col-md-8">
              <textarea name="spec" id="textarea-input" rows="5" placeholder="Spesifikasi addon.." class="form-control">
                <?php  echo @$rows['ao_spec']; ?>
              </textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4">
              <label class="form-control-label">
                Harga
              </label>
            </div>
            <div class="col-12 col-md-8">
              <input type="text" name="price" class="form-control" value="<?php echo @$rows['ao_price'] ?>">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-4">
              <label class="form-control-label">
                Stok
              </label>
            </div>
            <div class="col-12 col-md-8">
              <input type="text" name="stock" class="form-control" value="<?php echo @$rows['ao_stock'] ?>">
            </div>
          </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Simpan
          </button>
         <?php
          if (!isset($_GET['id'])) {
            echo ' <button type="reset" class="btn btn-warning btn-sm">
            <i class="fa fa-refresh"></i> Reset
          </button>';
          } else {
            echo '<input type="hidden" name="aoId" value="'.$rows['ao_id'].'">';
          }
         ?>
          <a href="index.php?category=view&module=addon">
            <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Cancel</button>
          </a>
      </div>
      </form>
    </div>
  </div>
