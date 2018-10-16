<?php
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";

  $allRoom = getAllData('kostin_kamar','*');
?>
<div class="row">
          <div class="col-md-12">
              <div class="overview-wrap">
                  <h2 class="title-1">Data Kamar</h2>
                  <a href="index.php?category=form&module=kamar">
                    <button class="btn btn-success">
                      Tambah Kamar
                    </button>
                  </a>
              </div>
          </div>
      </div>
      <div class="row m-t-30">
              <div class="col-md-12">
                <div class="table-responsive m-b-40">
                  <table class="table table-borderless table-data3">
                    <thead>
                      <tr>
                        <th>No. Kamar</th>
                        <th>Panjang</th>
                        <th>Lebar</th>
                        <th>Keterangan</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach ($allRoom as $room) {
                          echo '
                            <tr>
                              <td>'.$room['kamar_id'].'</td>
                              <td>'.$room['kamar_panjang'].'</td>
                              <td>'.$room['kamar_lebar'].'</td>
                              <td>'.$room['kamar_keterangan'].'</td>
                              <td> Rp. '.number_format($room['kamar_harga']).'</td>
                              <td>'.$room['kamar_status'].'</td>
                              <td>
                                <div class="table-data-feature">
                                    <a href="index.php?category=form&module=kamar&room_id='.$room['kamar_id'].'"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i></a>
                                    </button>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="del_opr" value="room">
                                        <input type="hidden" name="user_id" value="'.$room['kamar_id'].'">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                          <i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                          ';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>