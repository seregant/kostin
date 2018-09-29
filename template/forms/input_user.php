<?php
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";
  $existingUser = getAllData("kostin_user","*");
  $userRoles = getAllData("kostin_user_role","*");
?>
<script src="a/js/myScript.js"></script>
<form name="registrasi" onsubmit="return inputUserValidation()" action="../../module/data_input.php" method="post" enctype="multipart/form-data">
  <table width="70%">
    <tr>
      <th colspan="3"><center><h2>Input Data User</h2></center></th>
    </tr>
    <tr>
      <td>Nama User</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="nama"></td>
    </tr>
    <tr>
      <td>Username</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="username"></td>
    </tr>
    <tr>
      <td>E-Mail</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="mail"></td>
    </tr>
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
    <tr>
      <td>Foto</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="file" name="foto"></td>
    </tr>
     <tr>
      <td>Hak Akses</td>
      <td>&nbsp;:&nbsp;</td>
      <td>
        <select name="priv">
          <?php 
            foreach ($userRoles as $roles) {
              echo '<option value="'.$roles['role_id'].'">'.$roles['role_name'].'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
      </center>
    </td>
    </tr>
      <td colspan="3">
        <center>
          <button type="reset" class="btn btn-sm btn-primary">Reset</button>
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </center>
      </td>
    </tr>
  </table>
</form>
