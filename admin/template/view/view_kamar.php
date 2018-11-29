<?php
  $allRoomData = getAllData('kostin_kamar','*', null, null);
  $rows = mysqli_num_rows($allRoomData);
  $pagination = array();
  $limitData = 10;
  $offset = 0;
  $pageNum = 1;
  
  if ($rows > $limitData) {
    while ($rows>=0) {
      $pagination[] =  '<a href="index.php?category=view&module=kamar&offset='.$offset.'"><button type="button" class="btn btn-primary btn-sm">'.$pageNum.'</button></a>';
      $pageNum++;
      $rows = $rows - $limitData;
      $offset += $limitData;
    }
  }
                              
  if (isset($_GET['offset'])) {
     $allRoom = getAllData('kostin_kamar','*', $limitData, $_GET['offset']);
  } else {
    $allRoom = getAllData('kostin_kamar','*', $limitData, 0);
  }
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
                              <td>'.ucfirst($room['kamar_status']).'</td>
                              <td>
                                <div class="table-data-feature">
                                    <a href="index.php?category=form&module=kamar&room_id='.$room['kamar_id'].'"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i></a>
                                    </button>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="del_opr" value="room">
                                        <input type="hidden" name="room_id" value="'.$room['kamar_id'].'">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                          <i class="zmdi zmdi-delete"></i></button>
                                    </form>
                                </div>
                            </td>
                            </tr>
                          ';
                        }
                      ?>
                      <tr>
                        <td colspan="7" style="background-color: #333333; color: white;">
                            <center>
                              <?php
                                echo '<label style="color: white;">Pages : &nbsp;</label>';
                                if (!empty($pagination)) {
                                  foreach ($pagination as $links) {
                                    echo $links."&nbsp;";
                                  }
                                }
                              ?>
                            </center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>