<!DOCTYPE html>
<html>
<head>
  <title>Kostin Kamar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/ong" href="images/favicon.png">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>  
    <script type="text/javascript" src="js/myScript.js"></script>
</head>
<body>
       <!--Content--> 

      <div class="row">
        <div class="col-md-12">
        <div class="reg-form">
          <center>
            <form name="registrasi" onsubmit="return regValidation()" action="../module/input_data.php" method="post" id="form-outcome">
            <table width="70%">
              <tr>
                <th colspan="3"><center><h2>Tambah Pengeluaran</h2></center></th>
              </tr>
              <tr>
                <td>Nama Pengeluaran</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="nama"></td>
              </tr>
              <tr>
                <td>Nilai Pengeluaran</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="text" name="value"></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>&nbsp;:&nbsp;</td>
                <td><input type="date" name="date"></td>
              </tr>
               <tr>
                <td>Jenis Pengeluaran</td>
                <td>&nbsp;:&nbsp;</td>
                <td>
                  <select name="tag">
                    <option value="bulanan">Bulanan</option>
                    <option value="kondisional">Kondisional</option>
                    <option value="belanja">Belanja</option>
                    <option value="perbaikan">Perbaikan</option>
                  </select>
                </td>
              </tr>              
                </center>
              </td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>&nbsp;:&nbsp;</td>
                <td><textarea name="keterangan" form="form-outcome"></textarea></td>
              </tr>
                <td colspan="3">
                  <center>
                  <button type="Reset" class="btn btn-sm btn-primary">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                  </center>
                </td>
              </tr>
            </table>
          </form>
        </center>
        </div>
        </div>
    </div>
</body>
</html>