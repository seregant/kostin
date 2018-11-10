<?php
  $allAddon = getAllData('kostin_addons','*', null, null);	
?>

<div class="row">
          <div class="col-md-12">
              <div class="overview-wrap">
                  <h2 class="title-1">Data Addon</h2>
                  <a href="index.php?category=form&module=addon">
                    <button class="btn btn-success">
                      Tambah Addon
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
                        <th>ID Addon</th>
                        <th>Nama</th>
                        <th>Spesifikasi</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach ($allAddon as $addons) {
                          echo '
                            <tr>
                              <td>'.$addons['ao_id'].'</td>
                              <td>'.$addons['ao_name'].'</td>
                              <td>'.$addons['ao_spec'].'</td>
                              <td> Rp. '.number_format($addons['ao_price']).'</td>
                              <td>'.$addons['ao_stock'].'</td>
                              <td>
                                <div class="table-data-feature">
                                    <a href="index.php?category=form&module=addon&id='.$addons['ao_id'].'"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i></a>
                                    </button>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="del_opr" value="addon">
                                        <input type="hidden" name="addon_detail" value="'.$addons['ao_name'].'">
                                        <input type="hidden" name="addon_id" value="'.$addons['ao_id'].'">
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