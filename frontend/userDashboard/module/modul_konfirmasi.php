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

<div class="row " >
  <div class="col-lg-6 mx-auto">
                                      <div class="card">
                                    <div class="card-header">Credit Card</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Konfirmasi Bayar</h3>
                                        </div>
                                        <hr>
          <form class="form-cust">
            <div class="form-group">
              <label for="usr">No. Kamar:</label><br>
              <input type="text" class="form-control form-width" id="usr" name="">
            </div>
            <div class="form-group">
              <label for="usr">Tanggal Transfer:</label><br>
              <input type="date" class="form-control form-width" id="usr" name="">
            </div>
            <div class="form-group">
              <label for="usr">Nama Pemilik Rekening:</label><br>
              <input type="text" class="form-control form-width" id="usr" name="">
            </div>
            <div class="form-group">
              <label for="usr">Jumlah Transfer</label><br>
              <input type="text" class="form-control form-width" id="usr" name="">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Rekening Tujuan</label><br>
              <select class="form-control form-width" id="exampleFormControlSelect1">
                <option>Bank Rakyat Indonesia (BRI)</option>
                <option>Bank Central Asia (BCA)</option>
                <option>Bank Mandiri</option>

              </select>
          </div> 
          <div class="form-group">
              <label for="exampleInputFile">Upload ukti Bayar</label><br>
              <input type="file" id="exampleInputFile">
              <p class="help-block">Example block-level help text here.</p>         
          </div>
          <button type="button" class="btn btn-primary" >Kirim</button>
          </form>
                                    </div>
                                </div>
  </div>

</div>

