<?php
    include 'header.php';
?>
<div class="container ">

    <!-- FORM BOOKING -->
    <form class="form-cust">
        <div class="col-md-6 mx-auto form-bg form-border" >
                <center style="padding-top: 1em;"><h4>Konfirmasi Booking</h4></center>
                    <div class="form-group">
                        <label for="usr" style="padding-top: 5px;">Nama Pengirim / Pemilik Rekening:</label><br>
                        <input type="text" class="form-control" id="usr" name="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">No. Invoice</label><br>
                        <input type="text" class="form-control " id="usr" name="">
                    </div> 
                    <div class="form-group">
                        <label for="usr">Tanggal Transfer:</label><br>
                        <input type="date" class="form-control" id="usr" name="">
                    </div>
                    <div class="form-group">
                        <label for="usr">Jumlah Transfer</label><br>
                        <input type="text" class="form-control " id="usr" name="">
                    </div>                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Rekening Tujuan</label><br>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Bank Rakyat Indonesia (BRI)</option>
                            <option>Bank Central Asia (BCA)</option>
                            <option>Bank Mandiri</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputFile">Upload Bukti Bayar</label><br>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>                   
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary " style="max-width: 50%;">Kirim</button>
                    </div>
        </div>   
    </form>

</div>

<?php
    include 'footer.php';
?>