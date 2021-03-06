<?php
  if(isset($_GET['rent_id'])){
    $dataSewa = getRoomData($_GET['rent_id']);
    $data = mysqli_fetch_assoc($dataSewa);
    $action = "data_edit.php?category=rent&rent_id=".$_GET['rent_id'];
  } else {
    $action = "data_input.php?category=sewa";
  }

  $dataKamar = getAvailRoom();
  $dataAddOn = getAllData('kostin_addons', array('ao_id', 'ao_name'));

  if(mysqli_num_rows($dataKamar)==0){
    echo "Kamar penuh!";
  }
?>
<head>
  <script src="../vendor/ajax/jquery-3.3.1.min.js"></script>
  <script src="../vendor/ajax/jquery-autocomplete.js"></script>
  <script type="text/javascript" src="../js/myScript.js"></script>
  <link rel="stylesheet" type="text/css" href="../vendor/ajax/autocomplete.css">
</head>

<form name="sewa" onsubmit="return inputSewaValidation()" action="<?php echo $action ?>" method="post" id="form-kamar">
  <table width="70%">
    <tr>
      <th colspan="3"><center><h2>Tambah Data sewa</h2></center></th>
    </tr>
    <tr>
      <td>Username</td>
      <td>&nbsp;:&nbsp;</td>
      <td><input type="text" name="user" 
        <?php 
          if(isset($_GET['edit'])){
            echo 'value="'.$data['kamar_id'].'" readonly';
          }
        ?>
        " id="username_input"></td>
    </tr>
    <tr>
      <td>Nomor Kamar</td>
      <td>&nbsp;:&nbsp;</td>
      <td>
        <select name="kamar">
          <?php
            foreach ($dataKamar as $kamar) {
                  echo '<option value="'.$kamar['kamar_id'].'">'.$kamar['kamar_id'].'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Tanggal Check In</td>
      <td>&nbsp;:&nbsp;</td>
      <td>
        <input type="date" name="checkin">
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <center>
          <h3>Add ons : </h3>
          <table>
            <tr>
              <td>
                  <input type="checkbox" name="add-on[]" value="AO001"> Televisi <br>
                  <input type="checkbox" name="add-on[]" value="AO002"> Meja <br>
                  <input type="checkbox" name="add-on[]" value="AO003"> Kulkas <br>
              </td>
              <td>
                <input type="checkbox" name="add-on[]" value="AO004"> Kipas Angin <br>
                <input type="checkbox" name="add-on[]" value="AO005"> AC <br>
                <input type="checkbox" name="add-on[]" value="AO006"> Rice Cooker <br>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
    <tr>             
      <td colspan="3">
        <center>
          <button type="Reset" class="btn btn-sm btn-primary">Reset</button>
          <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
        </center>
      </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        // Selector input yang akan menampilkan autocomplete.
        $( "#username_input" ).autocomplete({
            serviceUrl: "ajax_processors/json_generator.php",   // Kode php untuk prosesing data
            dataType: "JSON",           // Tipe data JSON
            onSelect: function (suggestion) {
                $( "#username_input" ).val("" + suggestion.username);
            }
        });
    })
</script>