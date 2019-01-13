<?php
    $sqlUser = "SELECT
    `kostin_user`.*,
    `kostin_user_role`.*
    FROM `kostin_user`
    INNER JOIN `kostin_user_role` ON `kostin_user`.`role_id` = `kostin_user_role`.`role_id`
    WHERE `kostin_user`.`user_id` = '".$_SESSION['user_id']."'";
    
    $dataUser = mysqli_fetch_assoc(mysqli_query($conn,$sqlUser));

    $sqlSewa = "SELECT
    `kostin_sewa`.*,
    `kostin_tagihan`.*
    FROM `kostin_sewa`
    INNER JOIN `kostin_tagihan` ON `kostin_sewa`.`sewa_id` = `kostin_tagihan`.`sewa_id`
    WHERE `kostin_sewa`.`user_id` = '".$dataUser['user_id']."'";

    if ($dataUser['role_name']!='admin') {
        $dataSewa = mysqli_fetch_assoc(mysqli_query($conn,$sqlSewa));
    }
    $tagihanData = getTagihanData('sewa','sewa_id', $dataSewa['sewa_id'], 3, 0);


?>

   <div class="row m-b-5">
    <div class="col col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-lg-5">
                        <div class="mx-auto d-block">
                            <h5 class="text-sm-center mt-2 mb-1"><?php echo $dataUser['user_fullname']; ?></h5>
                            <div class="location text-sm-center">
                                <i class="fa fa-map-marker"></i> <?php 
                                    if (!is_null($dataUser['user_addr'])) {
                                        echo $dataUser['user_addr'];
                                    } else {
                                        echo "Alamat";
                                    }
                                ?>
                                <br>
                                <i class="fa fa-envelope"></i> 
                                <?php echo $dataUser['user_email']; ?>
                                <br>
                                <i class="fa fa-phone"></i> 
                                <?php echo $dataUser['user_phone']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-7">
                        <div class="table-responsive">
                            <table class="table table-borderless table-detail">
                                <thead>
                                    <tr>
                                        <th colspan="3"><center>Data Account</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tipe Account</td>
                                        <td>:</td>
                                        <td>Penghuni</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Check In</td>
                                        <td>:</td>
                                        <td><?php echo $dataSewa['sewa_in']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Kamar</td>
                                        <td>:</td>
                                        <td><?php echo $dataSewa['kamar_id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sisa Kuota Huni</td>
                                        <td>:</td>
                                        <td><?php echo $dataSewa['sewa_durasi']; ?> Hari</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <hr>
                        <center><h3>Tagihan Terakhir</h3></center>
                    </div>
                    <div class="col col-lg-12">
                        <div class="table-responsive m-t-15">
                            <table class="table table-borderless table-tagihan">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kamar</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($tagihanData as $tagihan) {
                                            $sqlKamarID = "SELECT `kamar_id` FROM `kostin_kamar` WHERE `kamar_id` IN (SELECT `kamar_id` FROM `kostin_sewa` WHERE `sewa_id` IN 
                                            (SELECT `sewa_id` FROM `kostin_tagihan` WHERE `tagihan_id` = '".$tagihan['tagihan_id']."' ))";

                                                $getKamarID = mysqli_fetch_assoc(mysqli_query($conn, $sqlKamarID));

                                                if ($tagihan['tagihan_status']=='pending') {
                                                    $color = 'blue';
                                                    $status = 'Belum Dibayar';
                                                } else if($tagihan['tagihan_status']=='waiting') {
                                                    $color = 'orange';
                                                    $status = 'Menunggu Verifikasi';
                                                } else if($tagihan['tagihan_status']=='paid' ) {
                                                    $color = 'green';
                                                    $status = 'Lunas';
                                                } else {
                                                    $color = 'red';
                                                    $status = 'Batal';
                                                }

                                                echo "
                                                    <tr class='row-click' data-href='index.php?category=detail&get=tagihan&id=".$tagihan['tagihan_id']."'>
                                                        <td>".$tagihan['tagihan_id']."</td>
                                                        <td>".$getKamarID['kamar_id']."</td>
                                                        <td>".number_format($tagihan['tagihan_jumlah'])."</td>
                                                        <td style='color:$color;'>".ucfirst($status)."</td>
                                                    </tr>
                                            ";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>      
        </div>