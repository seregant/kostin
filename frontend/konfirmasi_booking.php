<?php
    include 'header.php';
    $tagihanBookingData = getTagihanData('booking', 'tagihan_id', $_GET['no_invoice'], null, null);
    $tagihanData = mysqli_fetch_assoc($tagihanBookingData);

    $bookingData = getBookingData($tagihanData['book_id']);
    $booking = mysqli_fetch_assoc($bookingData);

    $roomData = getRoomData($booking['kamar_id']);
    $room = mysqli_fetch_assoc($roomData);

    $addonsData = getBookAddonData($booking['book_id']);

    $aoPrice = 0;

    $dueDateCount = dueDateCounter($tagihanData['tagihan_duedate']);

    if ($tagihanData['tagihan_status']=='pending' AND $dueDateCount > 0) {
        $color = 'blue';
        $status = 'Belum Dibayar';
    } else if($tagihanData['tagihan_status']=='waiting') {
        $color = 'orange';
        $status = 'Menunggu Konfirmasi';
    } else if($tagihanData['tagihan_status']=='cancel' OR $dueDateCount < 0) {
        $color = 'red';
        $status = 'Batal';
        if ($tagihanData['tagihan_status']=='cancel') {
            $keterangan = '(Transaksi dibatalkan)';
        } else {
            $keterangan = '(Sudah melewati jatuh tempo)';
        }
    } else {
        $color = 'green';
        $status = 'Lunas';
    }    
?>
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
                        <input type="text" class="form-control " id="usr" name="no_invoice" value="<?php echo $tagihanData['tagihan_id'] ?>" readonly>
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
    <!-- DATA TAGIHAN BOOKING-->

    <div class="row">
        <div class="col col-md-12">
            <div class="card">
                <div class="row m-t-20">
                    <div class="col col-md-12">
                        <center>
                            <h3 class="title-1">Tagihan Booking</h3>
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
                                          No. Tagihan : <?php echo $tagihanData['tagihan_id'] ?><br>
                                          No. Booking : <?php echo $tagihanData['book_id']; ?><br>
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
                                <div class="table-responsive table-data3 m-b-15 m-t-10">
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
                                <div class="table-responsive table-data3 m-b-15 m-t-10">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($addonsData as $addon) {
                                                    $sqlAddon = "select * from kostin_addons where ao_id ='".$addon['ao_id']."'";
                                                    $addonData = mysqli_fetch_assoc(mysqli_query($conn,$sqlAddon));
                                                    echo '
                                                        <tr>
                                                            <td>'.$addonData['ao_name'].'</td>
                                                            <td>Rp. '.number_format($addonData['ao_price']).'</td>
                                                        </tr>
                                                    ';
                                                    $aoPrice += $addonData['ao_price'];
                                                }
                                                $totalPrice = $aoPrice + $room['kamar_harga'];
                                            ?>
                                            <tr>
                                                <td><h5 class="pb-2 display-5">Total Tagihan</h5></td>
                                                <td><h5 class="pb-2 display-5"><?php echo 'Rp. '.number_format($totalPrice); ?></h5></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h5 class="pb-2 display-5">Info Tagihan :</h5>
                                <div class="table-responsive table-data3 m-b-15 m-t-10">
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <td>Jatuh Tempo</td>
                                                <td><?php echo date('d F Y', strtotime($tagihanData['tagihan_duedate'])); ?></td>
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

</div>

<?php
    include 'footer.php';
?>