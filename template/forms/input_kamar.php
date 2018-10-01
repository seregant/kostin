<?php
  include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
  include $base_url."/module/data_get.php";

  if(isset($_GET['room_id'])){
    $dataKamar = getRoomData($_GET['room_id']);
    $data = mysqli_fetch_assoc($dataKamar);
    $action = "../../module/data_input.php?room_id=".$_GET['room_id'];
  } else {
    $action = "../../module/data_input.php";
  }

?>
<form name="registrasi" onsubmit="return regValidation()" action="<?php echo $action ?>" method="post" id="form-kamar">
  <table width="70%">
    <tr>
      <th colspan="3"><center><h2>Tambah Kamar</h2></center></th>
    </tr>
    <tr>
      <td>No Kamar</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="nama" 
        <?php 
          if(isset($_GET['edit'])){
            echo 'value="'.$data['kamar_id'].'"';
          }
        ?>
        "></td>
    </tr>
    <tr>
      <td>Panjang Kamar</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="panjang" 
        <?php 
          if(isset($_GET['edit'])){
            echo 'value="'.$data['kamar_panjang'].'"';
          }
        ?>
        "></td>
    </tr>
    <tr>
      <td>Lebar Kamar</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="lebar" 
        <?php 
          if(isset($_GET['edit'])){
            echo 'value="'.$data['kamar_lebar'].'"';
          }
        ?>
        "></td>
    </tr>
     <tr>
      <td>Harga Sewa</td>
      <td>&nbsp;:&nbsp;</td>
      <td>
        <input type="text" name="price" 
        <?php 
          if(isset($_GET['edit'])){
            echo 'value="'.$data['kamar_harga'].'"';
          }
        ?>
        >
      </td>
    </tr>              
      </center>
    </td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td>&nbsp;:&nbsp;</td>
      <td><textarea name="keterangan" form="form-kamar">
        <?php 
          if(isset($_GET['edit'])){
            echo $data['kamar_keterangan'];
          }
        ?>
      </textarea></td>
    </tr>
    <?php
      if (isset($_GET['room_id'])) {
        if ($data['kamar_status']=='kosong') {
          $status1 = "kosong";
          $status2 = "dihuni";
        } else {
          $status1 = "dihuni";
          $status2 = "kosong";
        }

        echo '
          <tr>
            <td>Status</td>
            <td>&nbsp;:&nbsp;</td>
            <td>
              <select name="status">
                <option value="'.$status1.'">'.$status1.'</option>
                <option value="'.$status2.'">'.$status2.'</option>
              </select>
            </td>
          </tr>
       ';
      }
    ?>
    </tr>
      <td colspan="3">
        <center>
          <?php
            if (!isset($_GET['edit'])) {
              echo '<button type="Reset" class="btn btn-sm btn-primary">Reset</button>';
            }
          ?>
          <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
        </center>
      </td>
    </tr>
  </table>
</form>
