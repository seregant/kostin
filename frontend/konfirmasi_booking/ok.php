
<?php
    if (isset($_COOKIE['warning'])) {
        echo '
            <div class="col  mx-auto m-t-20">
          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
                '.$_COOKIE['warning'].'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
            <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
          </button>
          </div>  
         </div>
        ';
    }

    if ($bookingBill['tagihan_status'] == 'pending') {
        echo '
            <div class="container ">
                <!-- FORM BOOKING -->
            <form class="form-cust" method="post" action="data_input.php?category=tgbookUpdate" enctype="multipart/form-data">
                <div class="col-md-6 mx-auto form-bg form-border" >
                        <center style="padding-top: 1em;"><h4>Konfirmasi Pembayaran Booking</h4></center>
                            <div class="form-group">
                                <label for="usr" style="padding-top: 5px;">Nama Pengirim / Pemilik Rekening:</label><br>
                                <input type="text" class="form-control" id="usr" name="" >
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">No. Invoice</label><br>
                                <input type="text" class="form-control " id="usr" name="no_invoice" value="'.$_GET['no_invoice'].'" readonly>
                            </div>                   
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Bukti Bayar</label><br>
                                <input type="file" id="exampleInputFile" name="trf_proof">
                                <p class="help-block">Example block-level help text here.</p>                   
                            </div>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary " style="max-width: 50%;">Kirim</button>
                            </div>
                </div>   
            </form>
        ';
    } else if ($bookingBill['tagihan_status'] == 'paid'){
        $done = "Tagihan anda sudah lunas !";
    } else {
        $done = "Tagihan anda sedang diverifikasi...";
    }
?>
    <!-- DATA TAGIHAN BOOKING-->

    <div class="row m-t-20">
    <div class="col col-md-12">
        <div class="card">
            <div class="row m-t-20">
                <div class="col col-md-12">
                    <center>
                        <?php 
                            if (isset($done)) {
                                echo '<h3 class="title-1">'.$done.'</h3>';
                            } else {
                                echo '<h3 class="title-1">Detail Booking</h3>';
                            }
                        ?>
                    </center>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col col-md-1"></div>
                <div class="col col-md-10 ">
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="typo-articles">
                                      No. Tagihan : <?php echo $bookingBill['tagihan_id']; ?><br>
                                      No. Booking : <?php echo "<a href='index.php?category=detail&module=booking&id=".$booking['book_id']."' target='_blank'>".$booking['book_id']."</a>"; ?><br>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    Tanggal Booking<br>
                                    <h5 class="pb-2 display-5"><?php echo date('d F Y', strtotime($booking['book_date'])); ?></h5>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="pb-2 display-5">Kamar :</h5>
                            <div class="table-responsive table-detail m-b-15 m-t-10">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $booking['kamar_id']; ?></td>
                                            <td><?php echo 'Rp. '.number_format($room['kamar_harga']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="pb-2 display-5">Addon :</h5>
                            <div class="table-responsive table-detail m-b-15 m-t-10">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
                                            <th>Harga @</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($addonsData as $addon) {
                                                echo '
                                                    <tr>
                                                        <td>'.$addon['ao_name'].'</td>
                                                        <td>'.$addon['jumlah'].'</td>
                                                        <td>Rp. '.number_format($addon['ao_price']).'</td>
                                                        <td>Rp. '.number_format($addon['ao_price']*$addon['jumlah']).'</td>
                                                    </tr>
                                                ';
                                                $aoPrice += $addon['ao_price']*$addon['jumlah'];
                                            }
                                            $totalPrice = $aoPrice + $room['kamar_harga'];
                                        ?>
                                        <tr>
                                            <td colspan="3"><h5 class="pb-2 display-5">Total Tagihan</h5></td>
                                            <td><h5 class="pb-2 display-5"><?php echo 'Rp. '.number_format($totalPrice); ?></h5></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="pb-2 display-5">Info Tagihan :</h5>
                            <div class="table-responsive table-detail m-b-15 m-t-10">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <td>Jatuh Tempo</td>
                                            <td><?php echo date('d F Y', strtotime($bookingBill['tagihan_duedate'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td <?php echo "style = color:$color"; ?>><?php echo $status;
                                             ?>
                                                <div class="typo-articles">
                                                    <p>
                                                        <?php echo @$keterangan; ?>
                                                    </p>
                                                </div>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pembayaran</td>
                                            <td><?php
                                                    if (is_null($bookingBill['tagihan_paiddate'])){
                                                        echo "-";
                                                    } else {
                                                        echo $bookingBill['tagihan_paiddate'];
                                                    }
                                                 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Metode Pembayaran</td>
                                            <td><?php
                                                    if (is_null($bookingBill['tagihan_paymthd'])){
                                                        echo "-";
                                                    } else {
                                                        echo ucfirst( $bookingBill['tagihan_paymthd']);
                                                    }
                                                 ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bukti Pembayaran</td>
                                            <td>
                                                <?php
                                                    if (is_null($bookingBill['tagihan_bukti_bayar'])){
                                                        echo "-";
                                                    }
                                                 ?>
                                                <img src="<?php echo @$bookingBill['tagihan_bukti_bayar'] ?>" style="width: 500px; height: auto;" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            <div class="col col-md-1"></div>
            </div>
        </div>
    </div>
</div>