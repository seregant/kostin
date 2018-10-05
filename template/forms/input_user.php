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
          <tr>
            <td>Password</td>
            <td>&nbsp;:&nbsp;</td>
            <td><input type="password" name="pass"></td>
          </tr>
          <tr>
            <td>Ulangi Password</td>
            <td>&nbsp;:&nbsp;</td>
            <td><input type="password" name="retype-pass"></td>
          </tr>
          
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
