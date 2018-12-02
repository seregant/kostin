<?php
	$userdata = getAllData('kostin_user','*', null, null);
?>
	<div class="row">
          <div class="col-md-12">
          	<?php
            if (isset($_COOKIE['isclear'])) {
              if ($_COOKIE['isclear']=="yes") {
                echo '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                      <span class="badge badge-pill badge-success">Success</span>
                      Simpan data berhasil
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
              }
            }
          ?>
              <div class="overview-wrap">
                  <h2 class="title-1">Data User</h2>
                  <a href="index.php?category=form&module=user">
                    <button class="btn btn-success">
                      Tambah User
                    </button>
                  </a>
              </div>
          </div>
      </div>
	<div class="row m-t-15">
        <div class="col-md-12">
          <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
              <thead>
                <tr>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Akses</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($userdata as $users) {
                    $sqlRole = "select * from kostin_user_role where role_id = ".$users['role_id'];
                    $roleName = mysqli_fetch_assoc(mysqli_query($conn, $sqlRole));
                    echo '
                      <tr class="row-click" data-href="index.php?category=detail&module=user&id='.$users['user_id'].'" >
                        <td class="table-row">'.$users['user_fullname'].'</td>
                        <td class="table-row">'.$users['user_name'].'</td>
                        <td class="table-row">'.$users['user_email'].'</td>
                        <td class="table-row">'.ucfirst($roleName['role_name']).'</td>
                        <td>
                            <div class="table-data-feature">
                                <a href="index.php?category=form&module=user&edit=1&user_id='.$users['user_id'].'"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i></a>
                                </button>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="del_opr" value="user">
                                    <input type="hidden" name="user_detail" value="'.$users['user_fullname'].'">
                                    <input type="hidden" name="user_id" value="'.$users['user_id'].'">
                                    <input type="hidden" name="user_image" value="'.$users['user_imagefile'].'">
                                    <input type="hidden" name="user_thumb" value="'.$users['user_imagethumb'].'">
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

