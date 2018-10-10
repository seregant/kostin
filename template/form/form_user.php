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

    $action = '../../module/data_edit.php?category='.$category.'&id='.$_GET['user_id'];

  } else {
    $action = '../../module/data_input.php?category=user';
    $existingUser = getAllData("kostin_user","*");
    $buttonVal = "Tambah";
  }

  $userRoles = getAllData("kostin_user_role","*");
?>
<script src="../js/myScript.js"></script>

<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">Tambah User Baru</div>
            <div class="card-body card-block">
              <form ame="registrasi" onsubmit="return inputUserValidation()" action="<?php echo $action ?>" method="post" enctype="multipart/form-data" clas="form-horizontal">
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
                    <input type="text" name="email" class="form-control"
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
                          <input type="password" name="pass" class="form-control">
                        </div>
                      </div>
                      
                    ';
                  }
                ?>
                <div class="row from-group" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label class="form-control-label"></label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="" class="form-control">
                  </div>
                </div>
                <div class="row from-group" style="padding-top: 15px">
                  <div class="col col-md-3">
                    <label class="form-control-label"></label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" name="" class="form-control">
                  </div>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form name="registrasi" onsubmit="return inputUserValidation()" action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
  <table width="70%">
    <tr>
      <th colspan="3"><center><h2>Input Data User</h2></center></th>
    </tr>
    <tr>
      <td>Nama User</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="nama" 
        <?php  
          if (isset($_GET['edit'])) {
            echo 'value="'.$rows['user_fullname'].'"';
          }
        ?>>
      </td>
    </tr>
    <tr>
      <td>Username</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="username" 
        <?php  
          if (isset($_GET['edit'])) {
            echo 'value="'.$rows['user_name'].'"';
          }
        ?>>
      </td>
    </tr>
    <tr>
      <td>E-Mail</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="mail" 
        <?php  
          if (isset($_GET['edit'])) {
            echo 'value="'.$rows['user_email'].'"';
          }
        ?>>
      </td>
    </tr>
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
              <input type="password" name="pass" class="form-control">
            </div>
          </div>
          
        ';
      }
    ?>
    <tr>
      <td>Foto</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="file" name="foto"></td>
    </tr>
    <?php
      if (isset($_GET['edit'])){
        if ($rows['role_id']=='00001') {
          echo '
            <tr>
              <td>Hak Akses</td>
              <td>&nbsp;:&nbsp;</td>
              <td>
                <select name="priv">
          ';
            foreach ($userRoles as $roles) {
                  echo '<option value="'.$roles['role_id'].'">'.$roles['role_name'].'</option>';
            }
          echo '</select>
              </td>
            </tr>
          ';
        }
      } else if (!isset($_GET['edit'])) {
        echo '
            <tr>
              <td>Hak Akses</td>
              <td>&nbsp;:&nbsp;</td>
              <td>
                <select name="priv">
          ';
            foreach ($userRoles as $roles) {
                  echo '<option value="'.$roles['role_id'].'">'.$roles['role_name'].'</option>';
            }
          echo '</select>
              </td>
            </tr>
          ';
      } else {
        echo '';
      }
    ?>
      </center>
    </td>
    </tr>
      <td colspan="3">
        <center>
          <?php
            if (!isset($_GET['edit'])) {
              echo '<button type="reset" class="btn btn-sm btn-primary">Reset</button>';
            }
          ?>
          <button type="submit" class="btn btn-sm btn-primary"><?php echo $buttonVal; ?></button>
        </center>
      </td>
    </tr>
  </table>
</form>
