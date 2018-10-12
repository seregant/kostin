<?php
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";

  if(isset($_GET['edit'])){
    $existingUser = getUserData('user_id',$_GET['user_id']);
    $rows = mysqli_fetch_assoc($existingUser);
    $buttonVal = "Simpan";

    if ($rows['role_id']=='00001'){
      $category = 'user_admin';
    } else {
      $category = 'user_admin';
    }

    $action = 'module/data_edit.php?category='.$category.'&id='.$_GET['user_id'];

  } else {
    $action = 'module/data_input.php?category=user';
    $existingUser = getAllData("kostin_user","*");
    $buttonVal = "Tambah";
  }

  $userRoles = getAllData("kostin_user_role","*");
?>
<script src="template/js/myScript.js"></script>
      <div class="row">
        <div class="col-lg-6">
          <?php
            if (isset($_GET['isclear'])) {
              if ($_GET['isclear']=="yes") {
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
          <div class="card">
            <div class="card-header">Tambah User Baru</div>
            <div class="card-body card-block">
              <form name="input-user" onsubmit="return inputUserValidation()" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" clas="form-horizontal">
                <div class="row from-group">
                  <div class="col col-md-3">
                    <label class="form-control-label">
                      Nama User
                    </label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="nama" class="form-control"
                      <?php  
                        if (isset($_GET['edit'])) {
                          echo 'value="'.$rows['user_fullname'].'"';
                        }
                      ?>
                    >
                  </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label class="form-control-label">Username</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="username" class="form-control" 
                      <?php  
                        if (isset($_GET['edit'])) {
                          echo 'value="'.$rows['user_name'].'"';
                        }
                      ?>>
                  </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label class="form-control-label">E-mail</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="mail" class="form-control"
                      <?php  
                        if (isset($_GET['edit'])) {
                          echo 'value="'.$rows['user_email'].'"';
                        }
                      ?>
                    >
                  </div>
                </div>
                <?php 
                  if (!isset($_GET['edit'])) {
                    echo '
                      <div class="row from-group" style="padding-top: 15px">
                        <div class="col col-md-3">
                          <label class="form-control-label">Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                          <input type="password" name="pass" class="form-control">
                        </div>
                      </div>
                      <div class="row from-group" style="padding-top: 15px">
                        <div class="col col-md-3">
                          <label class="form-control-label">Ulangi Password</label>
                        </div>
                        <div class="col-12 col-md-9">
                          <input type="password" name="retype-pass" class="form-control">
                        </div>
                      </div>
                      
                    ';
                  }
                ?>
                <div class="row from-group" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label for="file-input" class="form-control-label">Foto</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="file" name="foto" class="form-control-file">
                  </div>
                </div>
                  <?php
                    if (isset($_GET['edit'])){
                      echo ' <div class="row from-group" style="padding-top: 15px">';
                      if ($rows['role_id']=='00001') {
                        echo '
                          <div class="col col-md-3">
                            <label class="form-control-label">Hak Akses</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="priv" id="select" class="form-control">
                        ';
                          foreach ($userRoles as $roles) {
                                echo '<option value="'.$roles['role_id'].'">'.$roles['role_name'].'</option>';
                          }
                        echo '</select>
                            </div>';
                        echo '</div>';
                      }
                    } else if (!isset($_GET['edit'])) {
                      echo ' <div class="row from-group" style="padding-top: 15px">';
                      echo '
                          <div class="col col-md-3">
                            <label class="form-control-label">Hak Akses</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="priv" id="select" class="form-control">
                        ';
                          foreach ($userRoles as $roles) {
                                echo '<option value="'.$roles['role_id'].'">'.$roles['role_name'].'</option>';
                          }
                        echo '</select>
                            </div>';
                        echo '</div>';
                    } else {
                      echo '';
                    }
                  ?>
                </div>
                <div class="card-footer">
                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                      </button>
                      <?php
                        if (!isset($_GET['edit'])) {
                          echo '<button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                      </button>';
                        }
                      ?>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php include 'template/view/view_user.php'; ?>
      </div>