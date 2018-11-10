<?php
    include 'header.php';
?>
<div class="container ">
    <!-- FORM GET DATA BOOKING -->
    <form class="form-cust" method="get" action="index.php?page=konfirmasi_booking">
        <div class="col-md-6 mx-auto form-bg form-border" >
            <center style="padding-top: 1em;"><h4>Masukkan Nomor Invoice Anda</h4></center>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">No. Invoice</label><br>
                        <input type="text" class="form-control " id="usr" name="no_invoice" >
                    </div>                   
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary " style="max-width: 50%;">Cari</button>
                    </div>
        </div>   
    </form>

</div>

<?php
    include 'footer.php';
?>